<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Role as rm;
use app\admin\model\Auth as am;
use app\admin\model\Manager as mm;

class Manager extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        #查询管理员表数据
        $manager = mm::alias('m')
            -> field('m.*,r.name role_name')
            -> join('role r','m.role_id=r.id','left')
            -> where('m.id','>',0)
            -> select();
        return view('index',['manager'=>$manager]);
    }

    #权限管理列表页面
    public function auth(){
        #查询权限表中数据
        $list = am::select();
        #使用无限级分类处理数据
        $list = getTree($list);
        return view('auth',['list'=>$list]);
    }

    #权限添加页面
    public function auth_add(){
        #获取权限表中顶级权限数据
        $role = am::where('pid',0) -> select();
        #不使用模板
        $this -> view -> engine -> layout(false);
        return view('auth_add',['role'=>$role]);
    }

    #权限数据入库
    public function auth_insert(){
        #接收数据
        $data = request() -> param();
        #处理数据
        $data['auth_c'] = isset($data['auth_c']) ? ucfirst(strtolower($data['auth_c'])) : '';
        $data['auth_a'] = isset($data['auth_a']) ? strtolower($data['auth_a']) : '';
        #数据入库
        am::create($data,true);
        #返回结果
        $res = [
            'code'  => 10000,
            'msg'   => '添加成功'
        ];

        return json($res);
    }

    #角色管理列表页面
    public function role(){
        #查询角色表中数据
        $list = rm::select();
        #查询管理员表数据
        $manager = mm::select();

        $manager_list = [];
        foreach ($list as $key => $value) {
            $temp = '';
            foreach ($manager as $k => $v) {
                if( $value['id'] == $v['role_id'] ){
                    $temp .= $v['nickname'] . ',';
                }
                $manager_list[ $value['id'] ] = rtrim($temp,',');
            }
        }
        return view('role',['list'=>$list,'manager_list'=>$manager_list]);
    }

    public function role_edit($id){
        #跟据id查询角色信息
        $role = rm::find($id);
        #查询顶级权限
        $top_auth = am::where('pid',0) -> select();
        #查询二级权限
        $two_auth = am::where('pid','gt','0') -> select();


        $this -> view -> engine -> layout(false);
        return view('role_edit',['role'=>$role,'top_auth'=>$top_auth,'two_auth'=>$two_auth]);
    }

    #角色管理更新入库
    public function role_update($id){
        $data['id'] = intval($id);
        $data['name'] = request() -> param('name');
        $data['auth_ids'] = request() -> param('auth_ids/a');
        $data['auth_ids'] = implode(',',$data['auth_ids']);
        rm::update($data);
        $res = [
            'code' => 10000,
            'msg'  => '更新成功'
        ];
        return json($res);
    }

    #角色管理添加
    public function role_add(){
        #查询权限表数据
        $top_auth = am::where('pid',0) -> select();
        $two_auth = am::where('pid','gt',0) -> select();

        #不使用模板
        $this -> view -> engine -> layout(false);
        return view('role_add',['top_auth'=>$top_auth,'two_auth'=>$two_auth]);
    }

    #角色管理添加入库
    public function role_insert(){
        #接收数据
        $data = request() -> param();
        #处理数据
        $data['auth_ids'] = implode(',',$data['auth_ids']);
        #数据入库
        rm::create($data);
        #返回结果
        $res = [
            'code' => 10000,
            'msg'  => '添加成功'
        ];

        return json($res);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        #查询角色信息
        $role = rm::select();
        $this -> view -> engine -> layout(false);
        return view('add',['role'=>$role]);
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
        #设置验证规则
        $rule = [
            'username'  => 'require|alphaDash|token|unique:manager',
            'nickname'  => 'require',
            'role_id'   => 'require|number|egt:0',
            'status'    => 'require|number'
        ];
        #执行验证
        $validate = new \think\Validate($rule);
        if( !$validate -> check($data) ){
            #错误信息
            $error = $validate -> getError();

            $res = [
                'code' => 10001,
                'msg'  => $error
            ];

            echo json_encode($res);die;
        }

        #生成默认密码 123456
        $data['password'] = encrypt_password('123456');
        #生成默认excel排序位置，默认为11
        $data['excel_id'] = 11;
        #数据入库
        mm::create($data,true);
        #返回结果
        $res = [
            'code' => 10000,
            'msg'  => '添加成功'
        ];

        return json($res);
    }

    #分配角色页面显示
    public function manager_role_html(){
        #关闭模板布局
        $this -> view -> engine -> layout(false);
        #接收参数
        $data = request() -> param();
        #查询管理员信息
        $manager = mm::find($data['id']);
        #查询角色信息
        $role = rm::select();
        return view('manager_role',['manager'=>$manager,'role'=>$role]);
    }

    #修改管理员角色入库
    public function manager_role_update(){
        #接收参数
        $data = request() -> param();
        #查询管理员信息
        $manager = mm::find($data['id']);
        $manager -> role_id = $data['role_id'];
        $manager -> save();

        $this -> closelayer('修改成功');
    }
}
