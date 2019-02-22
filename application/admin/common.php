<?php

if (!function_exists('remove_xss')) {
    //使用htmlpurifier防范xss攻击
    function remove_xss($string){
        //composer安装的，不需要此步骤。相对index.php入口文件，引入HTMLPurifier.auto.php核心文件
        // require_once './plugins/htmlpurifier/HTMLPurifier.auto.php';
        // 生成配置对象
        $cfg = HTMLPurifier_Config::createDefault();
        // 以下就是配置：
        $cfg -> set('Core.Encoding', 'UTF-8');
        // 设置允许使用的HTML标签
        $cfg -> set('HTML.Allowed','div,b,strong,i,em,a[href|title],ul,ol,li,br,p[style],span[style],img[width|height|alt|src]');
        // 设置允许出现的CSS样式属性
        $cfg -> set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
        // 设置a标签上是否允许使用target="_blank"
        $cfg -> set('HTML.TargetBlank', TRUE);
        // 使用配置生成过滤用的对象
        $obj = new HTMLPurifier($cfg);
        // 过滤字符串
        return $obj -> purify($string);
    }
}

if( !function_exists('encrypt_password') ){
    #密码加密函数
    function encrypt_password( $password ){
        #加盐方式
        $salt = 'asdfjl.+-soi/*,*1o34ukl2q349012..,';

        return md5( md5($password) . md5($salt) );
    }
}

if (!function_exists('getTree')) {
    //递归方法实现无限极分类
    function getTree($list,$pid=0,$level=0) {
        static $tree = array();
        foreach($list as $row) {
            if($row['pid']==$pid) {
                $row['level'] = $level;
                $tree[] = $row;
                getTree($list, $row['id'], $level + 1);
            }
        }
        return $tree;
    }
}

    /**
     * 导出excel表
     * $data：要导出excel表的数据，接受一个二维数组
     * $name：excel表的表名
     * $head：excel表的表头，接受一个一维数组
     * $key：$data中对应表头的键的数组，接受一个一维数组
     * 备注：表头（对应列数）不能超过26；
     * 循环不够灵活，一个单元格中不方便存放两个数据库字段的值,仅供生成订单表使用
     */

if( !function_exists('excelOffice') ){
    #导出excel文件
    function excelOffice( $name,$data,$head,$keys ){
        #计算表头数据
        $count_header = count($head);

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('template.xlsx');
        // $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet -> getActiveSheet();
        #循环设置表头
        for( $i=65; $i<$count_header+65; $i++ ){
            $sheet -> setCellValue( strtoupper(chr($i)) . '1' , $head[$i - 65] );
        }
        #遍历传入的数据
        foreach ($data as $key => $value) {
            # $key + 2 ，因为第一行是表头，所以从第二行开始写入
            for( $i=65; $i<count($keys)+65; $i++ ){
                #如果$data中不存在指定的键,则跳过此次循环,主要用于参与人员排序
                if( !isset($value[ $keys[$i-65] ]) ) continue;
                #如果data中received=0 表示此单未收款
                if( $value['received'] == 0 ){
                    #设置此行字体颜色为红色
                    $sheet -> getStyle( strtoupper(chr($i)) . ($key+2) )
                           -> getFont()
                           -> getColor()
                           -> setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
                }
                #如果data中person1status存在并且等于0,表示未发工资
                            // dump ( $value[ $keys[$i-65].'status' ] );
                if( !empty( $value[ $keys[$i-65].'status' ] ) &&  $value[ $keys[$i-65].'status' ] == 1 ){
                            // echo $value[ $keys[$i-65].'status' ];
                    #设置此行背景色为深灰绿色
                    $sheet  -> getStyle( strtoupper(chr($i)) . ($key+2) )
                            ->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setARGB('FCE4D6');
                }
                
                $sheet -> setCellValue( strtoupper(chr($i)) . ($key+2) , $value[ $keys[$i-65] ] );
                // dump($value[ $keys[$i-65] ]);
            }
        }
// die;/\
        #设置请求头
        header( 'Content-Type:application/vnd.ms-execl' );
        header( 'Content-Disposition:attachment; filename="'.$name.'.xlsx"' );
        header( 'Cache-Control:max-age=0' );

        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx( $spreadsheet );
        $writer -> save( 'php://output' );

        #删除清空
        $spreadsheet -> disconnectWorksheets();

        unset( $spreadsheet );
    }
}

if( !function_exists( 'GetIp' ) ){
    #获取外网IP
    function GetIp(){
        # 初始化curl
        $ch = curl_init('http://tool.huixiang360.com/zhanzhang/ipaddress.php');
        # 配置curl 获取结果以字符类型返回
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        # 设置超时时间，5秒中无响应，返回false
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        # 执行
        $a  = curl_exec($ch);
        # 关闭连接
        curl_close($ch);
        # 处理返回结果
        if( $a ){
            # 将结果字符串处理为数组
            preg_match('/\[(.*)\]/', $a, $ip);
            return $ip[1];
        }

        return false;

    }
}

if( !function_exists( 'GetIpLookup' ) ){
    #通过IP获取城市信息
    function GetIpLookup($ip = ''){

        if(empty($ip)) return false;

        $ch = curl_init('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $ip_info = curl_exec($ch);

        #未完...
    }
}

