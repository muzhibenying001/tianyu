<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

use app\admin\model\Bonus as bm;

class Bonus extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $bonus = bm::alias('b')
            -> join('orderinfo o','o.id=b.order_id','inner')
            -> field('sum(b.money) money,count(b.money) count,b.name,min(o.date) min,max(o.date) max')
            -> group('b.name')
            -> order('money desc,count desc')
            -> select();
        return view('index',['bonus'=>$bonus]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
