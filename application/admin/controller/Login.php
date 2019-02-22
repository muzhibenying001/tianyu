<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Manager as mm;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $this -> view -> engine -> layout(false);
         return view('index');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function login()
    {
        $data = request() -> param();

        $rule = [
            'username'  => 'require',
            'password'  => 'require|length:4,16',
            'captcha'      => 'require|length:4'
        ];
        $msg = [
            'username.require'  => '用户名不能为空',
            'password.require'  => '密码不能为空',
            'password.length'   => '密码长度在4-16之间',
            'captcha.require'      => '验证码不能为空',
            'captcha.length'       => '验证码长度必须是4位'
        ];
        $validate = new \think\Validate($rule,$msg);
        if( ! $validate -> check( $data ) ){

            $error = $validate -> getError();
            $res = [
                'code' => 10001,
                'msg'  => $error
            ];

            echo json_encode($res);die;
        }
        #检测验证码
        if( !captcha_check($data['captcha']) ){

            $res = [
                'code' => 10001,
                'msg'  => '验证码错误'
            ];

            echo json_encode($res);die;
        }


        $manager = mm::where('username',$data['username']) -> where('password',encrypt_password( $data['password']) ) -> find();

        if( $manager ){
            #存入session
            session('manager_info',$manager->toArray());
            #记录登陆时间
            $manager->last_login_time = time();
            #记录登录IP
            $info = GetIpBy360();
            $manager->last_login_ip = $info->ip;
            #记录登陆城市
            $manager->last_login_city = $info->location;
            #记录入库
            $manager->save();

            $res = [
                'code' => 10000,
                'msg'  => '登陆成功'
            ];
        }else{
            $res = [
                'code' => 10001,
                'msg'  => '用户名或密码有误'
            ];
        }
        return json($res);


    }

    #退出系统
    public function logout(){
        #清空session
        session(null);
        #跳转到登录页
        $this -> redirect('admin/login/index');
    }

    public function test(){
        // echo GetIpBy360();
        echo encrypt_password('12398700');
    }
}
