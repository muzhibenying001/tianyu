<?php

namespace app\admin\model;

use think\Model;

class Auth extends Model
{
    #使用获取器对isNav字段进行转化
    public function getIsNavAttr($value){
    	# 1 是，0 否
    	return $value ? '是' : '否';
    }
}
