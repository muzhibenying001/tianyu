<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

use app\admin\model\Order as om;
use app\admin\model\Games as gm;
use app\admin\model\Manager as mm;
use app\admin\model\Salary as sm;
use app\admin\model\Bonus as bm;

class Order extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        #查询模型
        // $order = om::order('date desc,create_time desc') -> paginate(10);
        $order = om::alias('o')
            -> field('o.*,g.name game_name')
            -> join('games g','o.gameid=g.id','left')
            -> order('date desc,create_time desc')
            -> paginate(20);

        $manager = mm::select();
        $salary = sm::select();
        $bonus = bm::select();
        #整合数据
        #将manager数据整合为以id为下标的,nickname为值的二维数组
        $manager = ( new \think\Collection($manager) ) -> toArray();
        $person_name = [];
        foreach( $manager as $k => $v ){
            if($k == 0) continue;
            $person_name[$v['id']] = $v['nickname'];
        }unset($v);
        #将订单id做为工资表下标，值取对应的$person_name
        $salary = ( new \think\Collection($salary) ) -> toArray();
        $person = [];
        foreach( $salary as $v ){
            $v['manager_id'] = $person_name[ $v['manager_id'] ];
            $person[ $v['order_id'] ][] = $v['manager_id'];
        }unset($v);
        #将订单id做为提成表下标
        $bonus = ( new \think\Collection($bonus) ) -> toArray();
        $bonus_name = [];
        foreach( $bonus as $v ){
            $bonus_name[ $v['order_id'] ][] = $v['name']; 
        }
        #将整理好的数据放入订单数据中
        foreach( $order as &$v ){
            $v['person'] = implode(',',$person[ $v['id'] ]);
            $v['bonus_name'] = implode(',',$bonus_name[ $v['id'] ]);
        }unset($v);
        
        // dump(request()->param()['get_execl']);
        // dump($order->toArray());die;
        return view('index',['order'=>$order,'order_total'=>$order->toArray()['total']]);
    }

    #被软删除的列表
    public function redel(){
                #查询模型
        $order = om::onlyTrashed() -> order('date desc,create_time desc') -> paginate(10);
                $game = gm::select();
        $manager = mm::select();
        $salary = sm::select();
        $bonus = bm::select();
        #整合数据
        #将manager数据整合为以id为下标的,nickname为值的二维数组
        $manager = ( new \think\Collection($manager) ) -> toArray();
        $person_name = [];
        foreach( $manager as $k => $v ){
            if($k == 0) continue;
            $person_name[$v['id']] = $v['nickname'];
        }unset($v);
        #将订单id做为工资表下标，值取对应的$person_name
        $salary = ( new \think\Collection($salary) ) -> toArray();
        $person = [];
        foreach( $salary as $v ){
            $v['manager_id'] = $person_name[ $v['manager_id'] ];
            $person[ $v['order_id'] ][] = $v['manager_id'];
        }unset($v);
        #将订单id做为提成表下标
        $bonus = ( new \think\Collection($bonus) ) -> toArray();
        $bonus_name = [];
        foreach( $bonus as $v ){
            $bonus_name[ $v['order_id'] ][] = $v['name']; 
        }
        #将整理好的数据放入订单数据中
        foreach( $order as &$v ){
            $v['person'] = implode(',',$person[ $v['id'] ]);
            $v['bonus_name'] = implode(',',$bonus_name[ $v['id'] ]);
        }unset($v);

        return view('redel',['order'=>$order,'game'=>$game]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        #查询副本信息、成员信息
        $game = gm::games_tree();
        $manager = mm::select();
        #处理数据
        return view('add',['game'=>$game,'manager'=>$manager]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        #接收数据
        $data = request() -> param();

        #设置数据验证规则
        $rule = [
            'date'      => 'require|date|token',
            'gameid'    => 'require|number|egt:0',
            'total'     => 'require|float|egt:0',
            'rerealmoney' => 'require|float|egt:0',
            'resalary'  => 'require|float|egt:0'
        ];

        $msg = [
            'date.require'      => '没有填写日期',
            'date.token'      => '不要重复提交',
            'gameid.require'    => '没有选择副本',
            'total.require'     => '没有填写副本总金额',
            'rerealmoney.require' => '没有填写实收金额',
            'resalary.require'  => '没有填写平均工资',
        ];
        #执行验证
        $validate = new \think\Validate($rule,$msg);
        if( !$validate -> check($data) ){
            $error = $validate -> getError();
            $this -> error($error); return;
            /*$res = [
                'code' => 10001,
                'msg'  => $error
            ];

            echo json_encode($res);die;*/
        }
        #计算数据
        #1、计算参与人员数量
        $data['member'] = count( $data['person'] );
        if( empty($data['person']) || $data['member'] == 0 ){
            #没有选择参与人员
            $res = [
                'code'  => 10001,
                'msg'   => '没有选择参与人员'
            ];

            return json($res);
        }

        #2、计算平均工资，只取小数点后两位 实收金额/人员数量
        $data['salary'] = ( floor( ( $data['rerealmoney'] / $data['member'] ) * 100 ) ) / 100;

        if( $data['salary'] != $data['resalary'] ){
            $res = [
                'code'  => 10001,
                'msg'   => '平均工资计算有误，重新按正确格式填写表单'
            ];

            return json($res);
        }
        #定义变量，存储提成总额
        $data['bonus_tot'] = 0;
        #将实收金额下标转换与数据库字段对应
        $data['realmoney'] = $data['rerealmoney'];
        #处理提成数据
        $bonus_temp = [];
        foreach($data['bonus'] as $k => $v){
            $row = [];
            #整合数组
            $row = [
                'name' => $data['bonus_info'][$k],
                'money'=> $v
            ];
            #减少误差
            $v = $v * 100;
            #计算提成总额
            $data['bonus_tot'] += $v;

            $bonus_temp[] = $row;
        }
        $data['bonus_tot'] = $data['bonus_tot'] / 100;


        #将日期格式转成时间戳
        $data['date'] = strtotime($data['date']);
        #判断是否勾选 收款项
        $data['received'] = isset($data['received']) ? 0 : 1;

/*
Db::transaction(function(){
2.    Db::table('think_user')->find(1);
3.    Db::table('think_user')->delete(1);
4.});

Db::startTrans();
3.try{
4.    Db::table('think_user')->find(1);
5.    Db::table('think_user')->delete(1);
6.    // 提交事务
7.    Db::commit();    
8.} catch (\Exception $e) {
9.    // 回滚事务
10.    Db::rollback();
11.}

 */

        #开启事务
        \think\Db::startTrans();
        try{            
            #订单信息入库
            $order = om::create($data,true);
            #获得新增的订单id
            $order_id = $order->id;
            $realmoney = $order->realmoney;
            #整合工资信息
            $salary_data=[];
            foreach( $data['person'] as $k => $v ){
                $row=[];
                #人员id，person数组中下标即为id
                $row['manager_id'] = $k;
                #订单id
                $row['order_id'] = $order_id;
                #订单平均工资
                $row['salary'] = $data['salary'];

                $salary_data[] = $row;
            }
            #计算实收金额与工资总额是否合法
            $salary_tot = 0;
            foreach ($salary_data as $value) {
                $salary_tot += $value['salary'] * 100;
            }
            if( $realmoney < $salary_tot/100 ) throw new \Exception("发放失败，订单数有误");
            #整合提成信息
            $bonus_data = [];
            foreach( $bonus_temp as $v ){
                #为每一行数据加入id字段
                $v['order_id'] = $order_id;
                $bonus_data[] = $v;
            }
            #测试事务：
            #throw new \Exception("sunyue");
            
            #工资信息入库
            $salary = new sm();
            $salary->saveAll($salary_data);
            #提成信息入库
            $bonus = new bm();
            $bonus->saveAll($bonus_data);

            \think\Db::commit(); 

            $res = [
                    'code'  => 10000,
                    'msg'   => '添加成功',
                    'data'  => $order_id
            ];

        }catch( \Exception $e ){

            \think\Db::rollback();
            $res = [
                    'code'  => 10002,
                    'msg'   => $e -> getMessage()
            ];
        }

        return json($res);


    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        #查询$id的单子信息
        // SELECT o.*,g.name game_name FROM `orderinfo` o LEFT JOIN games g ON o.gameid = g.id;
        $order = om::alias('o')
            -> field('o.*,g.name game_name')
            -> join('games g','o.gameid=g.id','left')
            -> find($id);
        #查询提成信息
        $bonus = bm::where('order_id',$order->id) -> select();
        #查询工资信息
        $salary = sm::alias('s')
            -> field('s.*,m.nickname name')
            -> join('manager m','s.manager_id=m.id','left')
            -> where('order_id',$order->id)
            -> select();
        #计算未发放的工资金额
        $salary_surplus = 0;
        $salary_tot = 0;
        foreach ($salary as $value) {
            #计算全部工资
            $salary_tot += $value['salary'];
            if( $value['status'] == 0 ){
              $salary_surplus += $value['salary'];
            }
        }
        #关闭模板
        $this -> view -> engine -> layout(false);
        return view('read',['order'=>$order,'bonus'=>$bonus,'salary'=>$salary,'salary_surplus'=>$salary_surplus,'salary_tot'=>$salary_tot]);
    }
    #修改工资
    public function edit_salary_status()
    {
        #接收参数
        $data = request() -> param();
        #修改工资发放状态
        if( isset($data['status']) && $data['status'] == 0 ){

            #查询工资表
            $salary = sm::find($data['id']);
            if( !$salary ){
                $res = [
                    'code' => '10001',
                    'msg'  => '参数错误'
                ];
                return json($res);
            }

            $salary -> status = 1;
            $salary -> save();
            #返回结果
            $res = [
                'code' => '10000',
                'msg'  => '已发放'
            ];
            return json($res);
        }
        #计算未发放的工资剩余
        if( isset($data['surplus']) && $data['surplus'] == '20001' ){
            #查询工资信息
            $salary = sm::alias('s')
                -> field('s.*,m.nickname name')
                -> join('manager m','s.manager_id=m.id','left')
                -> where(['s.order_id'=>$data['order_id'],'s.status'=>0])
                -> select();
            #计算剩余工资总额            
            $salary_surplus = 0; #剩余工资变量
            $person_surplus = 0; #剩余人数变量
            $salary_data = [];   #需要修改入库的数据
            foreach ($salary as $v) {
                #计算剩余工资总额
                $salary_surplus += $v['salary'];
                $person_surplus++;               
            }
            $salary_surplus -= $data['new_salary'];
            $new_surplus = (floor( ($salary_surplus / ($person_surplus) ) * 100)) / 100;
            #如果参数中有surplus=20004
            if( isset($data['average']) && $data['average'] == '20004' ){
                #计算新的平均工资
                $person_temp = ($person_surplus-1) > 0 ? $person_surplus-1 : 1;
                $new_surplus = (floor( ($salary_surplus / ($person_temp) ) * 100)) / 100;
                #为salary_data添加数据
                $salary_data[] = ['id'=>$data['salary_id'],'salary'=>$data['new_salary']];
                foreach ($salary as $v) {
                    $salary_surplus += $v['salary'];
                    if( $v['id'] != $data['salary_id'] ){
                        $salary_data[] = ['id'=>$v['id'],'salary'=>$new_surplus];
                    }
                }
                #计算新的剩余工资
                $tot = 0;
                foreach ($salary_data as $value) {
                    $tot += $value['salary'];
                }
                $salary_surplus -= $tot;
                if( $salary_surplus < 0 ) $this->error('剩余工资金额不能为负');
            }
            #提单修改数据入库
            if( isset($data['edit']) && $data['edit'] == '20002' ){
                if( $data['new_salary'] > $salary_surplus ) $this->error('要修改的金额不能大于剩余工资总额！');
                if( empty( $salary_data ) && $salary_surplus < 0 ) return;
                $salary = new sm();
                $salary -> saveAll($salary_data);
            }

            #返回结果
            $res = [
                'code' => 10000,
                'data' => (floor($salary_surplus*100)) / 100,
                'data_new_surplus' => $new_surplus
            ];

            return json($res);
        }

    }

    /**
     * 导出excel.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {

        $this->view->engine->layout(false);
        #接收参数
        $data = request() -> param();
        
        if( isset($data['mouth']) && !empty($data['mouth']) ){

            $t = $data['mouth'] == 1 ? '' : "FROM_UNIXTIME(o.date,'%Y-%m') = '{$data['mouth']}'";
             #查询模型
            // $order = om::order('date desc,create_time desc') -> paginate(10);
            $order = om::alias('o')
                -> field('o.date,o.total,o.member,o.bonus_tot,o.salary,o.area,o.boss,o.received,o.remark,o.id,g.name game_name')
                -> join('games g','o.gameid=g.id','left')
                -> order('date asc,create_time asc')
                -> where($t)
                -> select();

            $manager = mm::select();
            $salary = sm::select();
            $bonus = bm::select();
            #整合数据
            #将manager数据整合为以id为下标的,nickname为值的二维数组
            $manager = ( new \think\Collection($manager) ) -> toArray();
            $person_name = [];
            foreach( $manager as $k => $v ){
                if($k == 0) continue;
                $person_name[$v['id']]['nickname'] = $v['nickname'];
                $person_name[$v['id']]['excel_id'] = $v['excel_id'];
            }unset($v);
            #将订单id做为工资表下标，值取对应的$person_name
            $salary = ( new \think\Collection($salary) ) -> toArray();
            $person = [];
            foreach( $salary as $v ){
                $v['manager'] = $person_name[ $v['manager_id'] ]['nickname'];
                #参与人员,下标为execl排序位置
                $person[ $v['order_id'] ][ $person_name[$v['manager_id']]['excel_id'] ][] = $v['manager'];
                #工资是否发放状态
                $person[ $v['order_id'] ][ $person_name[$v['manager_id']]['excel_id'] ][] = $v['status'];
            }unset($v);
            // dump($person);die;
            #将订单id做为提成表下标
            $bonus = ( new \think\Collection($bonus) ) -> toArray();
            $bonus_name = [];
            foreach( $bonus as $v ){
                $bonus_name[ $v['order_id'] ][] = $v['name']; 
            }
            // dump($person);die;
            #将整理好的数据放入订单数据中
            foreach( $order as &$v ){

                $v['date'] = date('m.d',$v['date']);

                foreach ($person[ $v['id'] ] as $k=>$value) {

                    $v['person'.$k.'status'] = $value[1];
                    $v['person'.$k] = $value[0];
                }

                $v['bonus_name'] = implode(',',$bonus_name[ $v['id'] ]);
            }unset($v);

            $order = ( new \think\Collection($order) ) -> toArray();
            // dump($order);die;
           
            $head = ['日期', '副本', '金额', '人数', '提成','' ,'工资','备注','参与人员'];
     
            //数据中对应的字段，用于读取相应数据：
            $keys = ['date', 'game_name', 'total', 'member','bonus_name', 
                    'bonus_tot', 'salary', 'area','boss','remark','person1','person2',
                    'person3','person4','person5','person6','person7',
                    'person8','person9','person10','person11','person12','person13','person14','person15','person16'];

            $ex_name = $order[0]['date'] .'-'.$order[count($order)-1]['date'].' 天谕-单子金额统计';
            // dump($order);die;
            excelOffice($ex_name, $order, $head, $keys);
        }

        #查询单子表信息 FROM_UNIXTIME(o.date,'%Y%m%d')

        $order_mouth = om::field("from_unixtime(date,'%Y-%m') as m,count('id')") -> group('m') ->select();

        return view('excelbutton',['order_mouth'=>$order_mouth]);

    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        #接收数据
        $data = request() -> param(); 
        // dump($data);die;
        $update = om::update($data,['orderid'=>$id],true)->toArray();

        $res = [
            'code' => 10000,
            'msg'  => '修改成功'
        ];
        echo json_encode($res);die;

    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $data = request() -> param();

        if( isset($data['delete']) && $data['delete'] == 1 ){
            om::destroy($id,true);
            sm::destroy(['order_id'=>$id]);
            bm::destroy(['order_id'=>$id]);
            $res = [
                'code'  => 10000,
                'msg'   => '删除成功！'
            ];
            return json($res);
        }
        om::destroy($id);

        $res = [
            'code'  => 10000,
            'msg'   => '删除成功，可在已删除列表查看！'
        ];

        return json($res);
    }

}
