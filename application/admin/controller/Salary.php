<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Salary as sm;
use app\admin\model\Manager as mm;
use app\admin\model\Salary_payoff as spm;

class Salary extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $salary = sm::alias('s')
            -> join('manager m','m.id=s.manager_id','inner')
            -> join('orderinfo o','o.id=s.order_id','inner')
            -> field('sum(s.salary) salary,count(s.salary) count,m.username,m.nickname,min(o.date) min,max(o.date) max')
            -> group('s.manager_id')
            -> where('o.delete_time',null)
            -> order('salary desc,count desc')
            -> select();
        return view('index',['salary'=>$salary]);
    }

    /**
     * 显示待发工资表单页.
     *
     * @return \think\Response
     */
    public function received()
    {
        $salary = sm::alias('s')
            -> join('manager m','m.id=s.manager_id','inner')
            -> join('orderinfo o','o.id=s.order_id','inner')
            -> field('sum(s.salary) salary,count(s.salary) count,m.username,m.nickname,min(o.date) min,max(o.date) max,s.manager_id')
            -> group('s.manager_id')
            -> where('s.status',0)
            -> where('o.received',1)
            -> where('o.delete_time',null)
            -> order('salary desc,count desc')
            -> select();
        // $salary = ( new \think\Collection($salary) ) -> toArray();
        #查询工资表数据
        return view('topay',['salary'=>$salary]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        #接收传递过来的金额数
        $param = request() -> param();
        $total = intval(floatval($param['total'])*100);
        #查询管理员表获取管理员名称
        $data['manager_name'] = $param['nickname'];
        #获取当前用户名
        $data['operator'] = session('manager_info.nickname');
        #存储订单ids
        $data['order_ids'] = '';
        #存储订单数
        $data['sum_order'] = (int) $param['sum_order'];
        #存储工资金额
        $data['sum_salary'] = 0;
        #开启事务
        \think\Db::startTrans();
        try{  
            #查询工资表信息
            $salary = sm::alias('s')
                -> join('orderinfo o','o.id=s.order_id','inner')
                -> where('o.received',1)
                -> where('o.delete_time',null)
                -> where('s.manager_id',$id)
                -> where('s.status',0)
                -> select();
            // dump($salary);die;
            $s = ( new \think\Collection($salary) ) -> toArray();
            #整理订单IDS，总金额
            foreach ($salary as $value) {
                $data['order_ids'] .= $value['order_id'] . ',';
                $data['sum_salary'] += $value['salary']*100;
            }
            #去掉整理后的字符串右边逗号
            $data['order_ids'] = rtrim($data['order_ids'],',');
            // dump( (int)$data['sum_salary'] === $total);dump($data['sum_salary']);dump($total);die;
            #判断计算后的金额
            if( (int)$data['sum_salary'] !== $total ) throw new \Exception("发放失败，应发金额与实际发放不一样");
            #总金额结果保留2位小数
            $data['sum_salary'] /= 100;
            #更新入库
            $salary = sm::alias('s')
                -> join('orderinfo o','o.id=s.order_id','inner')
                -> where('o.received',1)
                -> where('o.delete_time',null)
                -> where('s.manager_id',$id)
                -> where('s.status',0)
                -> update(['s.status'=>1]);
            #判断更新数量与订单数
            if( $data['sum_order'] != $salary ) throw new \Exception("发放失败，订单数有误");
            #工资发放信息入库
            $payoff = spm::create($data,true);

            \think\Db::commit();

            $res = [
                    'code'  => 10000,
                    'msg'   => '发放成功',
                    'data'  => $payoff
            ];

            return json($res);

        }catch( \Exception $e ){

            \think\Db::rollback();

            $res = [
                    'code'  => 10002,
                    'msg'   => $e -> getMessage()
            ];

            return json($res);
        }
    }

    #工资发放记录列表
    public function payoff(){
        #查询发放表数据
        $payoff = spm::select();
        $payoff = (new \think\Collection($payoff)) -> toArray();
        #统计每期发放数据
        $info = [];
        foreach ($payoff as $value) {
            #通过日期分组，每组下标为发放日
            $tem_time = date('Y年m月d日',strtotime($value['create_time']));
            $info[ $tem_time ][] = $value;
        }
        foreach ($info as $key => $value) {
            #将分好组的数据加入发放人数，和发放金额
            $info[$key]['count'] = count($value);
            $temp = 0;
            foreach ($value as $k => $v) {
                $temp += $v['sum_salary'] * 100;
            }
            $info[$key]['total'] = $temp/100;
        }

        return view('payoff',['info'=>$info]);
    } 

}
