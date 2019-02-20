<?php

namespace app\admin\model;

use think\Model;

class Order extends Model
{
	#设置表名
    protected $table = 'orderinfo';
    #引入traits
    use \traits\model\SoftDelete;
    #设置软删除
    protected $deleteTime = 'delete_time';

    // #设置获取器 对received 进行转换
    // public function getReceivedAttr($value){
    // 	return $value ? '已收款' : '未收款';
    // }
    
}
