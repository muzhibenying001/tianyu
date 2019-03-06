<?php

namespace app\admin\model;

use think\Model;

class Games extends Model
{
    public static function games_tree(){
    	#查询副本表数据
    	$games = self::select();
    	$games = ( new \think\Collection($games) ) -> toArray();
    	#处理数据
    	$list = [];
    	foreach ($games as $value) {
    		#记录所有顶级分类
    		if( $value['parent_id'] == 0  ) $list[ $value['id'] ] = $value;
    		#将子类放入数组中的son
    		if( $value['parent_id'] > 0 ) $list[ $value['parent_id'] ]['son'][ $value['id'] ] = $value;
    	}

    	return $list;
    }

}
