<?php

date_default_timezone_set("PRC");

function getDay($timestamp){
    return date("d",$timestamp);
}

function getClientIp() {
    $ip = NULL;
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos =  array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip   =  trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0';
    return $ip;
}


if (! function_exists ( 'show_tips' )) {
    function show_tips() {
        $quotes = array (
            "我们是谁？#我们来自北京市海淀区三所高校，是一个致力于为大学生提供便利的高校创业团队，您的支持是我们不断改进的动力，我们将竭诚为您服务！",
            "今昔能干什么？#今昔网致力于为您提供最全面的校园二手信息。",
            "新版今昔有哪些新功能？#新版今昔网强化了自动匹配功能，提供了教材专区并强力推出绑定校园BBS跳蚤版面功能，更好的界面，更多功能，更多便利！小伙伴们快去尝试吧！",
            "商品品质是什么？#今昔网商品四种品质S、A、B、C描述了商品的新旧程度、外观及功能现状。",
            "今昔网四大特色#1、系统自动匹配；<br/>&nbsp;&nbsp;&nbsp;&nbsp;2、教材专区；<br/>&nbsp;&nbsp;&nbsp;&nbsp;3、绑定本校BBS；<br/>&nbsp;&nbsp;&nbsp;&nbsp;4、精心制作的网页UI" 
            );
        $str = random_element ( $quotes );
        $array = explode ( '#', $str );
        $ret ['strtit'] = $array[0];
        $ret ['strcon'] = $array[1];
        return $ret;
    }
}

if (! function_exists ( 'get_sex' )) {
    function get_sex($sexint) {
        $sex = array (
            "兔星人",
            "汪星人",
            "喵星人" 
            );
        return $sex [$sexint];
    }
}

if (! function_exists ( 'get_namecolor' )) {
    function get_namecolor($clr) {
        $color = array (
            "text-primary",
            "text-info",
            "text-danger",
            "text-warning",
            "text-purple" 
            );
        return $color [$clr];
    }
}

if(!function_exists('get_user_type')){
    function get_user_type($type){
        $types = array(
            "未选择",
            "本科生",
            "硕士生",
            "博士生",
            "教职工",
            "校友",
            "校外合作者"
            );
        return $types[$type];
    }
}

if (! function_exists ( 'ld_score' )) {
    function ld_score($ld) {
        if ($ld <= 3)
            return 1;
        else if ($ld <= 10)
            return 4;
        else if ($ld <= 50)
            return 20;
        else if ($ld <= 200)
            return 40;
        else if ($ld <= 500)
            return 80;
        else
            return 120;
    }
}

if (! function_exists ( 'po_score' )) {
    function po_score($po) {
        if ($po <= 3)
            return 20;
        else if ($po <= 8)
            return 50;
        else if ($po <= 20)
            return 100;
        else if ($po <= 50)
            return 150;
        else
            return 200;
    }
}

if (! function_exists ( 'get_level' )) {
    function get_level($score) {
        if ($score <= 5)
            return 0;
        else if ($score <= 20)
            return 1;
        else if ($score <= 50)
            return 2;
        else if ($score <= 90)
            return 3;
        else if ($score <= 150)
            return 4;
        else if ($score <= 240)
            return 5;
        else if ($score <= 350)
            return 6;
        else if ($score <= 480)
            return 7;
        else if ($score <= 560)
            return 8;
        else if ($score <= 800)
            return 9;
        else if ($score <= 990)
            return 10;
        else if ($score <= 1830)
            return 11;
        else if ($score <= 3000)
            return 12;
        else if ($score <= 5000)
            return 13;
        else if ($score <= 8000)
            return 14;
        else if ($score <= 12000)
            return 15;
        else if ($score <= 20000)
            return 16;
        else if ($score <= 30000)
            return 17;
        else if ($score <= 50000)
            return 18;
        else if ($score <= 100000)
            return 19;
        else if ($score <= 300000)
            return 20;
        else
            return 21;
    }
}

function get_category_name($class) {
    $allclass = array (
                "手机", // 0
                "数码相机",
                "电子词典",
                "数码录音笔",
                "电子书",
                "耳机", // 5
                "移动硬盘",
                "笔记本",
                "平板",
                "电脑配件",
                "电脑数码", // 10
                "小家电",
                "居家小物",
                "杯壶",
                "个人乐器",
                "日用百货", // 15
                "男装",
                "女装",
                "配饰",
                "箱包",
                "服饰箱包", // 20
                "自行车",
                "瑜伽垫",
                "护具",
                "球类",
                "泳衣泳镜", // 25
                "运动户外",
                "公共课图书",
                "计算机图书",
                "经济管理图书",
                "工科技术图书", // 30
                "语言学习图书",
                "教育考试图书",
                "人文社科图书",
                "艺术生活图书",
                "文学小说", // 35
                "法律政治图书",
                "医学卫生图书",
                "原版小说",
                "工具书",
                "图书", // 40
                "大陆音像",
                "港台音像",
                "欧美音像",
                "日韩音像",
                "音像", // 45
                "面部护理",
                "面部彩妆",
                "身体护理",
                "护肤工具",
                "美容化妆", // 50
                "其他" 
                );
return $allclass [$class];
}



function get_category1_name($class) {
    if ($class <= 10)
        return get_category_name ( 10 );
    else if ($class <= 15)
        return get_category_name ( 15 );
    else if ($class <= 20)
        return get_category_name ( 20 );
    else if ($class <= 26)
        return get_category_name ( 26 );
    else if ($class <= 40)
        return get_category_name ( 40 );
    else if ($class <= 45)
        return get_category_name ( 45 );
    else if ($class <= 50)
        return get_category_name ( 50 );
    else
        return get_category_name ( 51 );
}


function get_category2_name($class) {
    if ($class == 10 || $class == 15 || $class == 20 || $class == 26 || $class == 40 || $class == 45 || $class == 50 || $class == 51)
        return get_category_name ( 51 );
    else
        return get_category_name ( $class );
}


if (! function_exists ( 'get_title_str' )) {
    function get_title_str($ptype, $pgtype, $pstype, $class, $brand, $modal, $pimage) {
        $titlestr = '';
        if ($ptype == 0)
            $titlestr .= '[转让]';
        else if ($ptype == 1)
            $titlestr .= '[求购]';
        if ($pgtype == 1)
            $titlestr .= '[自制]';
        else if ($pgtype == 2)
            $titlestr .= '[正品]';
        if ($pstype == 1)
            $titlestr .= '[多]';
        else if ($pstype == 2)
            $titlestr .= '[特]';
        if ($pimage > 0)
            $titlestr .= '[图]';
        $titlestr .= get_class_name ( $class );
        $titlestr .= '：';
        $titlestr .= $brand . $modal;
        return $titlestr;
    }
}

if (! function_exists ( 'get_title_full' )) {
    function get_title_full($ptype, $pgtype, $pstype, $class, $brand, $modal, $pimage) {
        $titlestr = '';
        if ($ptype == 0)
            $titlestr .= '<span class="text-primary">[转让]</span>';
        else if ($ptype == 1)
            $titlestr .= '<span class="text-primary">[求购]</span>';
        if ($pgtype == 1)
            $titlestr .= '<span class="text-warning">[自制]</span>';
        else if ($pgtype == 2)
            $titlestr .= '<span class="text-warning">[正品]</span>';
        if ($pstype == 1)
            $titlestr .= '<span class="text-warning">[多]</span>';
        else if ($pstype == 2)
            $titlestr .= '<span class="text-warning">[特]</span>';
        if ($pimage > 0)
            $titlestr .= '<span class="text-purple">[图]</span>';
        $titlestr .= get_class_name ( $class );
        $titlestr .= '：';
        $titlestr .= $brand . $modal;
        return $titlestr;
    }
}

/* 生成文件名 其中uniquedata为区别符 ext为后缀 time为指定一时间戳*/
function genFileName($uniquedata,$ext='',$time=null){
    $rand = '';
    $char_array = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789';
    if($time!=null){
        $tmp = time() - $time;
        for($i = 0; $i < 8 - strlen($tmp+''); $i ++) {
            $rand = $rand . $char_array[mt_rand(0,55)];
        }
        $rand = $rand . $tmp;
    }else{
        for($i = 0; $i < 8; $i ++) {
            $rand = $rand . $char_array[mt_rand(0,55)];
        }
    }

    $rand = $rand.$uniquedata;    
    for($i = 0; $i < 8; $i ++) {
        $rand = $rand . $char_array[mt_rand(0,47)];
    }
    if($time == null){
        $rand = $rand. time();
    }
    else $rand = $rand. $time;
    
    if(!empty($ext)) $rand = $rand. '.' . $ext;
    return $rand;
}

function getFileExt($file_name){
    $extend =explode("." , $file_name); 
    $va=count($extend)-1; 
    return $extend[$va]; 
}

function turnToMars($str){
    $dict = array(
        "0123456789",
        "零壹贰叁肆伍陆柒捌玖",
        "〇①②③④⑤⑥⑦⑧⑨",
        );

    $array = str_split($str,1);
    foreach ($array as $key => $value) {
        $r = rand(0,2);
        $n = 1;
        if($r != 0) $n = 3;
        $array[$key] = is_numeric($value)? substr($dict[$r],$n*$value,$n) : $value;
    }

    return implode($array,'');
}

function get_post_table($type){
    if($type==0){
        return "jx_seller_post";
    }elseif($type==1){
        return "jx_buyer_post";
    }

}

function parse_tag($text){
    //return strip_tags($text);
    return htmlentities($text);
}

function get_thumb($picture){
    $array = explode("/",$picture);
    if(count($array)==0) return $picture;
    else{
        $array[count($array)-1] = "thumb_".$array[count($array)-1];
        return implode($array, "/");
    }
}

function format_time($time){
    return date('Y-m-d H:i:s',$time);

}

function get_deal_name($type){//1一口价，2接受砍价，3一元赠送，4面议
    if($type==1) return "一口价";
    if($type==2) return "接受砍价";
    if($type==3) return "一元赠送";
    if($type==4) return "面议";
}

function get_class_name($type){
    if($type==1) return "S(正品)";
    if($type==2) return "S(自制)";
    if($type==3) return "A";
    if($type==4) return "B";
    if($type==5) return "C";
}

function get_title($type,$deal,$class,$hasimg,$cat1,$cat2,$brand,$model){
    $title = "";
    $t1 = $type==0? "卖":"买";  
    $t1 = '<span class="tag bg-primary">'.$t1.'</span>';   
    $t2 = '<span class="tag bg-warning>'.$deal.'</span>';                     // warning
    $t10 = $class=="S(自制)"? "<span class='tag bg-danger'>自制</span>":"";
    $t3 = $hasimg ? "<span class='tag bg-purple'>图</span>":"";    //purple
    $t4 = " ".$cat1;
    $t5 = " > ";
    $t6 = $cat2;
    $t7 = " : ";
    $t8 = $brand." ";
    $t9 = $model." ";
    return $title.$t1.$t2.$t10.$t3.$t4.$t5.$t6.$t7.$t8.$t9;
}

function get_plain_title($type,$deal,$class,$hasimg,$cat1,$cat2,$brand,$model){
    $title = "";
    $t1 = $type==0? "[卖]":"[买]";    
    $t2 = '['.$deal.']';                     // warning
    $t10 = $class=="S(自制)"? "[自制]":"";
    $t3 = $hasimg ? "[图]":"";    //purple
    $t4 = " ".$cat1;
    $t5 = " > ";
    $t6 = $cat2;
    $t7 = " : ";
    $t8 = $brand." ";
    $t9 = $model." ";
    return $title.$t1.$t2.$t10.$t3.$t4.$t5.$t6.$t7.$t8.$t9;
}



?>