<?php 

namespace app\admin\controller;

use think\Controller;
use think\Request;

use app\admin\model\Order as om;
use app\admin\model\Games as gm;
use app\admin\model\Manager as mm;

class AjaxApi extends Controller
{
	#大区推荐
    public function selectarea(){
        #接收数据
        $data = request() -> param();
        #模糊查询
        $order = om::field('area') -> where('area','like','%'.$data['areaname'].'%') -> select();
        $order = array_unique( $order );
        $order = ( new \think\Collection($order) ) -> toArray();
        $res_order = [];
        foreach ($order as $value) {
            $res_order[] = $value['area'];
        }
        // dump($res_order);die;

        $res = [
            'code'  => 10000,
            'msg'   => 'success',
            'data'  => $res_order
        ];
        return json($res);

    }

    #副本列表子类显示
    public function gameread()
    {
        $param = request() -> param();
        $param = isset( $param['parent_id'] ) && !empty($param['parent_id']) ? intval($param['parent_id']) : 0 ;
        #跟据parent_id,查询副本表数据
        $games = gm::where('parent_id',$param) -> select();
        $games = ( new \think\Collection($games) ) -> toArray();

        $res = [
            'code'  => 10000,
            'msg'   => 'success',
            'data'  => $games
        ];

        return json($res);
    }

    #修改个人密码
    public function re_password(){
        #获取表单数据
        $param = request() -> param();
        #获取当前用户id
        $id = session('manager_info')['id'];
        #查询管理员信息
        $manager = mm::find($id);
        #判断表单数据合法性
        if( encrypt_password($param['oldpass']) !== $manager->password ){
            #返回结果
            $res = [
                'code' => 10002,
                'msg'  => '旧密码输入有误'
            ]; 
        }elseif ( $param['oldpass'] === $param['password'] ) {
            #返回结果
            $res = [
                'code' => 10003,
                'msg'  => '新旧密码输入一样，不用修改'
            ]; 
        }elseif ( $param['password'] !== $param['repassword'] ) {
            #返回结果
            $res = [
                'code' => 10002,
                'msg'  => '两次密码输入不相同'
            ]; 
        }else{            
            #数据入库
            $manager->password = encrypt_password($param['password']);
            $manager->save();
            #返回结果
            $res = [
                'code' => 10000,
                'msg'  => '修改成功'
            ]; 
            #清空session
            session(null);
        }       

        return json($res);
    }
}