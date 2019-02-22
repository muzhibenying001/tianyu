<?php

namespace app\admin\controller;

use think\Request;
use app\admin\model\Manager as manager;
use app\admin\model\Order as order;
use app\admin\model\Salary as salary;
use app\admin\model\Salary_payoff as salary_payoff;
use app\admin\model\Bonus as bonus;

class Index extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        #查询成员表数据，用于主页显示
        $manager = manager::find(1);
        #近三个月时间戳 今天：2019.01.18 - 2018.10.18 
        $t_month = mktime( 0,0,0,date('m')-3,date('d'),date('y') );
        #查询订单表单子数量，实收总额
        $order= order::where('delete_time',null)-> where('date','>=',$t_month) -> select();
        #查询工资
        $salary = salary::alias('s')
            -> join('orderinfo o','o.id=s.order_id','inner')
            -> field('s.salary,s.status,o.date')
            -> where('o.delete_time',null)
            -> where('o.date','>=',$t_month)
            -> select();
        #近三十天时间戳
        $t_day = mktime( 0,0,0,date('m')-1,date('d'),date('y') );
        #本月时间戳
        $m_day = mktime( 0,0,0,date('m'),1,date('y') );
        #上个月时间戳
        $m_last_day = mktime( 0,0,0,date('m')-1,1,date('y') );
        #本周时间戳
        $w_day = strtotime('this week Monday',time());

        #计算全部需要的数据
        $order_all = [#无前缀表示近3个月，d_表示近1个月，w_表示本周，m_表示本月
            'all_tot' => 0, /*单子总额*/
            'all_count' => count($order), /*总子总数*/
            'all_salary'=>0, /*单子总工资*/
            'received_real' =>0, /*实收总金额*/
            'received_count'=> 0, /*实收单子数量*/
            'real_salary'=>0, /*应发工资*/
            'received_salary'=>0, /*已发工资*/

            'd_all_tot' => 0, /*单子总额*/
            'd_all_count' =>0, /*总子总数*/
            'd_all_salary'=>0, /*单子总工资*/
            'd_received_real' =>0, /*实收总金额*/
            'd_received_count'=> 0, /*实收单子数量*/
            'd_real_salary'=>0, /*应发工资*/
            'd_received_salary'=>0, /*已发工资*/

            'm_all_tot' => 0, /*单子总额*/
            'm_all_count' =>0, /*总子总数*/
            'm_all_salary'=>0, /*单子总工资*/
            'm_received_real' =>0, /*实收总金额*/
            'm_received_count'=> 0, /*实收单子数量*/
            'm_real_salary'=>0, /*应发工资*/
            'm_received_salary'=>0, /*已发工资*/

            'w_all_tot' => 0, /*单子总额*/
            'w_all_count' =>0, /*总子总数*/
            'w_all_salary'=>0, /*单子总工资*/
            'w_received_real' =>0, /*实收总金额*/
            'w_received_count'=> 0, /*实收单子数量*/
            'w_real_salary'=>0, /*应发工资*/
            'w_received_salary'=>0, /*已发工资*/
        ];
        foreach ($order as $value) {
            #近三个月单子统计
            $order_all['all_tot'] += $value['total'] * 100;
            if( $value['received'] == 1 ){
                $order_all['received_real'] += $value['realmoney'] * 100;
                $order_all['received_count'] ++ ;
            }
            #近一个月单子统计
            if( $value['date'] >= $t_day ){
                $order_all['d_all_tot'] += $value['total'] * 100;
                $order_all['d_all_count'] ++;
                if( $value['received'] == 1 ){
                    $order_all['d_received_real'] += $value['realmoney'] * 100;
                    $order_all['d_received_count'] ++ ;
                }
            }
            #本周单子统计
            if( $value['date'] >= $w_day ){
                $order_all['w_all_tot'] += $value['total'] * 100;
                $order_all['w_all_count'] ++;
                if( $value['received'] == 1 ){
                    $order_all['w_received_real'] += $value['realmoney'] * 100;
                    $order_all['w_received_count'] ++ ;
                }
            }

            #本月单子统计
            if( $value['date'] >= $m_day ){
                $order_all['m_all_tot'] += $value['total'] * 100;
                $order_all['m_all_count'] ++;
                if( $value['received'] == 1 ){
                    $order_all['m_received_real'] += $value['realmoney'] * 100;
                    $order_all['m_received_count'] ++ ;
                }
            }
        }

        foreach ($salary as $value) {
            #近三个月单子工资
            $order_all['all_salary'] += $value['salary'] * 100;
            if( $value['status'] == 1 ) {
                #已发工资
                $order_all['received_salary'] += $value['salary'] * 100;
            }else{
                #应发工资（未发放的工资）
                $order_all['real_salary'] += $value['salary'] * 100;
            }

            #近一个月单子统计
            if( $value['date'] >= $t_day ){
                $order_all['d_all_salary'] += $value['salary'] * 100;
                if( $value['status'] == 1 ) {
                    #已发工资
                    $order_all['d_received_salary'] += $value['salary'] * 100;
                }else{
                    #应发工资（未发放的工资）
                    $order_all['d_real_salary'] += $value['salary'] * 100;
                }
            }

            #本周单子统计
            if( $value['date'] >= $t_day ){
                $order_all['w_all_salary'] += $value['salary'] * 100;
                if( $value['status'] == 1 ) {
                    #已发工资
                    $order_all['w_received_salary'] += $value['salary'] * 100;
                }else{
                    #应发工资（未发放的工资）
                    $order_all['w_real_salary'] += $value['salary'] * 100;
                }
            }

            #本月单子统计
            if( $value['date'] >= $t_day ){
                $order_all['m_all_salary'] += $value['salary'] * 100;
                if( $value['status'] == 1 ) {
                    #已发工资
                    $order_all['m_received_salary'] += $value['salary'] * 100;
                }else{
                    #应发工资（未发放的工资）
                    $order_all['m_real_salary'] += $value['salary'] * 100;
                }
            }
        }
        #上次工资发放时间
        $last_grant = salary_payoff::field('max(create_time) u_time') -> find() -> u_time;
        #上个月工资最高
        $last_top_salary = salary::alias('s')
            -> join('manager m','m.id=s.manager_id','inner')
            -> join('orderinfo o','o.id=s.order_id','inner')
            -> field('sum(s.salary) salary,count(s.salary) count,m.nickname,min(o.date) min,max(o.date) max')
            -> group('s.manager_id')
            -> where('o.delete_time',null)
            -> where('o.date','>=',$m_last_day)
            -> where('o.date','<',$m_day)
            -> order('salary desc,count desc')
            -> find();
        #上个月提成最高 from_unixtime(pub_time,'%M %Y') = '{$data['month']}'
        $last_top_bonus = bonus::alias('b')
            -> join('orderinfo o','o.id=b.order_id','inner')
            -> field('sum(b.money) bonus,count(o.id) count,b.name name')
            -> group('b.name')
            -> where('o.delete_time',null)
            -> where('o.date',['>=',$m_last_day],['<',$m_day],'and')
            -> order('bonus desc,count desc')
            -> find();
        // dump($last_top_bonus);die;
        return view('index',[ 'manager' => $manager ,'order_all'=>$order_all,'last_grant'=>$last_grant,'last_top_salary'=>$last_top_salary,'last_top_bonus'=>$last_top_bonus]);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read()
    {
        #近三个月时间 今天：2019.01.18 - 2018.10.18 
        $t_month = mktime( 0,0,0,date('m')-3,date('d'),date('y') );
        #近三十天
        $t_day = mktime( 0,0,0,date('m')-1,date('d'),date('y') );
        $t_day = date('Y-m-d H:i:s',$t_day);
        echo "$t_day";
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {
        $head = ['订单id', '日期', '总额', '提成', '实收','是否收款','工资总额','成员','工资','大区','老板','备注','副本id','创建时间','修改时间','删除时间'];
 
        //数据中对应的字段，用于读取相应数据：
        $keys = ['id', 'date', 'total', 'bonus_tot', 'realmoney','received', 'salary_tot', 'member', 'salary', 'area','boss', 'remark', 'gameid', 'create_time', 'update_time','delete_time'];

        $order= order::where('delete_time',null)-> select();

        $order = ( new \think\Collection($order) ) -> toArray();

        // dump($order);die;   
 
        excelOffice('订单表', $order, $head, $keys);

    }

}
