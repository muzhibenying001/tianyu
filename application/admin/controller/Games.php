<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Games as gm;

class Games extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $games = gm::where('parent_id',0) -> select();

        return view('index',['games'=>$games]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $games = gm::games_tree();
        return view('add',['games'=>$games]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $param = request() -> param();
        if( empty($param['name']) || !isset( $param['name'] ) ) $this -> error('副本名称没有填写！');
        if( !is_numeric($param['parent_id']) ) $this -> error('请选择正确的副本分类');
        #数据入库
        gm::create($param,true);
        $this -> success('添加成功','admin/games/index');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        return view('edit');
    }

}
