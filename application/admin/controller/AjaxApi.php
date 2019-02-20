<?php 

namespace app\admin\controller;

use think\Controller;
use think\Request;

use app\admin\model\Order as om;
use app\admin\model\Games as gm;

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
}