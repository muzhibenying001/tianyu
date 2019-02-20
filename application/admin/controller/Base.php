<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Auth as am;
use app\admin\model\Role as rm;

class Base extends Controller
{
   public function __construct( Request $request ){
        parent::__construct($request);

        if(!session('manager_info'))
        {
        	$this -> redirect('Login/index');
        }
        #调用权限菜单方法
        $this -> getNav();
        #调用越权访问方法
        $this -> checkAuth();
   }

   #生成权限菜单
   private function getNav(){
    #跟据session中的roleid判断所显示的数据
    $role_id = session('manager_info.role_id');
    if( $role_id == 0 ){
        #session中roleid 为0 表示超级管理员，拥有所有权限      
        #查询权限表中顶级权限数据
        $top_auth = am::where('pid',0) -> select();
        #查询权限表中二级权限数据
        $two_auth = am::where(['pid'=>['gt',0],'is_nav'=>1 ]) -> select();
        // $two_auth['auth_c'] = strtolower($two_auth['auth_c']);
    }else{
      #不是超级超管理员
      #跟据session中的roleid查询角色表,获得数据中的权限ids
      $role_ids = rm::find($role_id)['auth_ids'];
      #查询权限表中id在roleids中的权限数据
      $top_auth = am::where(['pid'=>0,'is_nav'=>1,'id'=>['in',$role_ids] ]) -> select();
      $two_auth = am::where(['pid'=>['gt',0],'is_nav'=>1,'id'=>['in',$role_ids]]) -> select();
      // $two_auth['auth_c'] = strtolower($two_auth['auth_c']);
    }
      #分配数据
      $this -> assign('top_auth',$top_auth);
      $this -> assign('two_auth',$two_auth);
   }

   	protected function closelayer($msg){
		echo "<script>window.parent.location.reload();</script>";
		die;
	}

  #防止越权访问
  private function checkAuth(){
    #取得session中的角色id
    $role_id = session('manager_info.role_id');
    #取得要访问的控制器与方法名
    $controller = request() -> controller();
    $action = request() -> action();
    #如果当前角色id为0或是控制器为index，则不做处理
    if( $role_id == 0 || strtolower($controller) == 'index' ) return;

    #跟据角色id查询角色表中的ids
    $role_ids = rm::find($role_id)['auth_ids'];
    $role_ids = explode(',',$role_ids);
    #跟据控制器名与方法名取得权限id
    $auth_id = am::where(['auth_c'=>$controller,'auth_a'=>$action]) -> find()['id'];
    #判断权限id是否在角色ids中
    if( !in_array($auth_id,$role_ids) ){
      $this -> error('没有权限','admin/index/index');
    }
  } 
   
}
