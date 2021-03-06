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

//num   0~x   random   all
if (! function_exists ( 'show_tips' )) {
    function show_tips($num="random") {
        $quotes = array (
            "我们是谁？#我们是来自北京市海淀区若干所高校的烟酒僧，是一个致力于为广大同学们服务的高校团队，您的支持是我们不断改进的动力，我们将竭诚为您服务！",
            "今昔能干什么？#今昔网是一个高校二手物品信息中心，在这里你可以便捷地发布自己的二手信息或需求，也可以方便地获取丰富的二手信息！",
            "为什么叫今昔？#今昔意寓昔日的物品今天依然有价值！所以，小伙伴们快把你们的闲置物品都放上来吧~",
            "今昔网四大特色#1、精心制作的网页UI<br/>2、系统自动匹配需求<br/>3、手机扫码上传照片<br/>4、买卖分离，分类筛选",
            "物品品质是什么？#今昔网二手物品的四种品质S、A、B、C描述了物品的新旧程度、外观及功能现状。<br/>S：全新物品，手工自制或未拆分正品<br/>A：九成新物品，外观完好，功能正常<br/>B：七成新物品，外观稍有磨损，功能正常<br/>C：五成新物品，外观明显磨损，功能基本正常",            
            "怎样发布信息？#点击右侧“发布信息”按钮，然后通过以下几个步骤进行信息的发布即可。<br/>1：选择信息类别（转让或求购）<br/>2：选择物品所属类别<br/>3：填写物品基本信息<br/>4：选择成交方式，填写心理价格<br/>5：填写详细描述<br/>6：上传物品图片（仅转让类别）<br/>7：选择联系方式", 
            "商品大厅的帖子范围？#商品大厅中默认展示所有本校二手信息，可以点击右上角切换按钮切换到全站。",
            "商品大厅的展示模式？#商品大厅中有列表和块型两种展示模式，可以自由切换。",
            "什么是热度？#商品大厅所有二手信息可以按照时间和热度排序，热度与信息的发布时间、回复数以及收藏数相关。",
            "我的推荐是什么？#个人页面中我的推荐部分是根据您最近发布和收藏的信息推断您可能感兴趣的同一类别的物品。",
            "等级有什么用？#然而等级目前并没有什么用，不过将来会有的~作为对大家使用今昔网的鼓励~",
            "如何提升等级？#每天登录、发帖子、回复帖子都能增长积分，积分越多，等级越高~",
            "如何发私信？#在用户的个人页面可以点击“私信TA”按钮来发送私信；在自己的个人页面的私信部分，也可以点击私信内容进行回复。",
            "兔星人是什么鬼？#雄兔脚扑朔，雌兔眼迷离，两兔傍地走，安能辨我是雄雌！",
            );
        if($num=="random"){
            $str = random_element ( $quotes );
            $array = explode ( '#', $str );
            $ret ['strtit'] = $array[0];
            $ret ['strcon'] = $array[1];
            return $ret;
        }elseif($num=="all"){
            $rets = array();
            foreach ($quotes as $key => $value) {
                $array = explode ( '#', $value );
                $ret ['strtit'] = $array[0];
                $ret ['strcon'] = $array[1];
                $rets[] = $ret;
            }
            return $rets;
        }elseif(is_numeric($num) && is_int($num + 0)){
            if($num>=count($quotes)) return null;
            $str = $quotes[$num];
            $array = explode ( '#', $str );
            $ret ['strtit'] = $array[0];
            $ret ['strcon'] = $array[1];
            return $ret;
        }
        return null;
    }
}

function about_us(){
    return "我们是谁？#我们来自北京市海淀区三所高校，是一个致力于为大学生提供便利的高校创业团队，您的支持是我们不断改进的动力，我们将竭诚为您服务！";
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
                "耳机", 
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
    else if ($class <= 51)
        return get_category_name ( 51 );
}

function get_category1_name2($class) {
    if ($class == -1)
        return "全部";
    if ($class <= 1)
        return get_category_name ( 10 );
    else if ($class <= 2)
        return get_category_name ( 15 );
    else if ($class <= 3)
        return get_category_name ( 20 );
    else if ($class <= 4)
        return get_category_name ( 26 );
    else if ($class <= 5)
        return get_category_name ( 40 );
    else if ($class <= 6)
        return get_category_name ( 45 );
    else if ($class <= 7)
        return get_category_name ( 50 );
    else if ($class <= 8)
        return get_category_name ( 51 );
}


function get_category2_name($class) {
    if ($class == -1)
        return "全部";
    if ($class == 10 || $class == 15 || $class == 20 || $class == 26 || $class == 40 || $class == 45 || $class == 50 || $class == 51)
        return get_category_name ( 51 );
    else if ($class >= 0 && $class < 52)
        return get_category_name ( $class );
}

function map_to_cat1($class){
    if ($class <= 10)
        return 1;
    else if ($class <= 15)
        return 2;
    else if ($class <= 20)
        return 3;
    else if ($class <= 26)
        return 4;
    else if ($class <= 40)
        return 5;
    else if ($class <= 45)
        return 6;
    else if ($class <= 50)
        return 7;
    else if ($class <= 51)
        return 8;
}



/* 生成文件名 其中uniquedata为区别符 ext为后缀 time为指定一时间戳*/
function genFileName($uniquedata,$ext='',$time=null){
    $rand = '';
    $char_array = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwyz23456789';
    if($time!=null){
        $tmp = time() - $time;
        for($i = 0; $i < 8 - strlen($tmp+''); $i ++) {
            $rand = $rand . $char_array[mt_rand(0,54)];
        }
        $rand = $rand . $tmp;
    }else{
        for($i = 0; $i < 8; $i ++) {
            $rand = $rand . $char_array[mt_rand(0,54)];
        }
    }

    $rand = $rand.$uniquedata;    
    for($i = 0; $i < 8; $i ++) {
        $rand = $rand . $char_array[mt_rand(0,46)];
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

function turnToMars($str,$flag){
    if(!$flag) return $str;
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

function get_sphinx_index($type){
    if($type==0){
        return "seller_post_index";
    }elseif($type==1){
        return "buyer_post_index";
    }
    return null;
}

function get_heat_view($type){
    if($type==0){
        return "seller_post_heat";
    }elseif($type==1){
        return "buyer_post_heat";
    }
}

function parse_tag($text){
    return strip_tags($text);
    //return htmlentities($text);
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
    $delta = time()-$time;

    if($delta<3600){ //几十分钟前
        $minites = 10* intval(floor($delta/600)); 
        if($minites<10) return "刚刚"; 
        return $minites."分钟以前";
    }
    if($delta<86400){
        $hours = intval(floor($delta/3600));
        return $hours."小时前";
    }
    if($delta<86400*3){
        $day = intval(floor($delta/86400));
        return $day."天前";
    }

    return date('Y-m-d H:i:s',$time);
}
//1一口价，2接受砍价，3一元赠送，4面议
//1心理价位 2面议
function get_deal_name($type,$post_type=0){
    if($post_type==0){
        if($type==1) return "一口价";
        if($type==2) return "接受砍价";
        if($type==3) return "一元赠送";
        if($type==4) return "面议";
    }else if($post_type==1){
        if($type==1) return "心理价位";
        if($type==2) return "面议";
    }
    return "";
    
}

function get_class_name($type){
    if($type==0) return "S(正品)";
    if($type==1) return "S(自制)";
    if($type==2) return "A";
    if($type==3) return "B";
    if($type==4) return "C";
}

function get_title($type,$deal,$class,$hasimg,$cat1,$cat2,$brand,$model){
    $title = "";
    $t1 = $type==0? '<span class="tag bg-primary">转让</span>':'<span class="tag bg-info">求购</span>';  
    if ($deal == "一元赠送")
        $deal = "一元送";
    $t2 = '<span class="tag bg-warning">'.$deal.'</span>';                     // warning

    $t10 = $class=="1"? "<span class='tag bg-danger'>自制</span>":"";
    if ($deal != "一元送" && $deal != "一口价")
        $t2 = "";
    $t10 = $class=="S(自制)"? "<span class='tag bg-danger'>自制</span>":"";
    $t3 = $hasimg ? "<span class='tag bg-purple'>图</span>":"";    //purple
    $t4 = " ".$cat1;
    $t5 = " > ";
    $t6 = $cat2;
    $t7 = " : ";
    if($cat1=='图书'){
        $t8 = "《".$brand."》 ";
    }
    else $t8 = $brand." ";
    $t9 = $model." ";
    return $title.$t1.$t2.$t10.$t3.$t4.$t5.$t6.$t7.$t8.$t9;
}

function get_plain_title($type,$deal,$class,$hasimg,$cat1,$cat2,$brand,$model){
    $title = "";
    $t1 = $type==0? "[转让]":"[求购]";    
    if ($deal == "一元赠送")
        $deal = "一元送";
    $t2 = '['.$deal.']';                     // warning
    if ($deal != "一元送" && $deal != "一口价")
        $t2 = "";
    $t10 = $class=="1"? "[自制]":"";
    $t3 = $hasimg ? "[图]":"";    //purple
    $t4 = " ".$cat1;
    $t5 = " > ";
    $t6 = $cat2;
    $t7 = " : ";
    if($cat1=='图书'){
        $t8 = "《".$brand."》 ";
    }
    else $t8 = $brand." ";
    $t9 = $model." ";
    return $title.$t1.$t2.$t10.$t3.$t4.$t5.$t6.$t7.$t8.$t9;
}

function checkCategory($cat1,$cat2){
    if(!(is_numeric($cat1)&&is_int($cat1+0)) || !(is_numeric($cat2)&&is_int($cat2+0))){
        return false;
    }elseif($cat1<0||$cat1>8||$cat2<-1||$cat2>51){
        return false;
    }
    return true;
}

function cutString($str,$num=50){
    if(mb_strlen($str)<=$num) return $str;
    else{
        return mb_substr($str, 0, $num).'......';
    }
}



?>