<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-03-28 23:13:00
         compiled from "..\application\views\index\main.php" */ ?>
<?php /*%%SmartyHeaderCode:321825516c4fc0f47a1-06930136%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '431a4b36db41ba7b11d709abc26ffa3f7b3dd242' => 
    array (
      0 => '..\\application\\views\\index\\main.php',
      1 => 1427363575,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '321825516c4fc0f47a1-06930136',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'baseurl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5516c4fc322d98_01457314',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5516c4fc322d98_01457314')) {function content_5516c4fc322d98_01457314($_smarty_tpl) {?>    <div id="body" class="row">
        <div id="main">
            <div id="slide_show" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active"><img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/bg/1.jpg" alt=""/></div>
                    <div class="item"><img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/bg/2.jpg" alt=""/></div>
                    <div class="item"><img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/bg/3.jpg" alt=""/></div>
                    <div class="item"><img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/bg/4.jpg" alt=""/></div>
                </div>
                <!-- Controls --> 
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> 
                    <span class="glyphicon glyphicon-chevron-left"></span> 
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span> 
                </a> 
            </div>
<!--
    <div class="main_title">自动匹配 | 本站
        <a class=" text-muted switch btn-link">切换到绑定BBS</a>
        <a class=" text-primary all pull-right" href="#">全部</a>
    </div>

<div class="leftrow">
  <div class="postitembig">
    <img class="postimage" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/jinxismall.jpg" alt=""/>
    
    <div class="postinfo">
      <a href="#" class="posttitle text-primary">【求购】手机：诺基亚C6</a>
      <p class="postaddress">北京航天航空大学</p>
      <p class="postuser">
        <span class=" fui-user"><a href="#" class=" text-info">罗天航</a></span>
        <span class=" fui-time" style=" margin-left: 8px;">2013-11-19 20：00：00</span>
        <span class=" fui-new" style=" margin-left: 8px;">12</span>
        <span class=" fui-eye" style=" margin-left: 8px;">33</span>
      </p>
    </div>
    
    <div class="postquality">
      <img class="quality" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/class/2.png" alt=""/>
      <p class="postprice">￥800</p>
    </div>
  </div>
</div>

<div class="leftrow">
  <div style=" position: relative; float: left; width: 350px;">
    <a href="#" class="posttitlesm text-primary">【求购】手机：诺基亚C6</a>
  </div>
  <div style=" position: relative; float: left; width: 422px;">
    <p class="postusersm pull-right">
      <span class=" fui-user"><a href="#" class=" text-info">罗天航</a></span>
      <span class=" fui-time" style=" margin-left: 8px;">2013-11-19 20：00：00</span>
    </p>
  </div>
  
  <div style=" position: relative; float: left; width: 350px;">
    <a href="#" class="posttitlesm text-primary">【求购】手机：诺基亚C6</a>
  </div>
  <div style=" position: relative; float: left; width: 422px;">
    <p class="postusersm pull-right">
      <span class=" fui-user"><a href="#" class=" text-info">罗天航</a></span>
      <span class=" fui-time" style=" margin-left: 8px;">2013-11-19 20：00：00</span>
    </p>
  </div>
  
  <div style=" position: relative; float: left; width: 350px;">
    <a href="#" class="posttitlesm text-primary">【求购】手机：诺基亚C6</a>
  </div>
  <div style=" position: relative; float: left; width: 422px;">
    <p class="postusersm pull-right">
      <span class=" fui-user"><a href="#" class=" text-info">罗天航</a></span>
      <span class=" fui-time" style=" margin-left: 8px;">2013-11-19 20：00：00</span>
    </p>
  </div>
  
  <div style=" position: relative; float: left; width: 350px;">
    <a href="#" class="posttitlesm text-primary">【求购】手机：诺基亚C6</a>
  </div>
  <div style=" position: relative; float: left; width: 422px;">
    <p class="postusersm pull-right">
      <span class=" fui-user"><a href="#" class=" text-info">罗天航</a></span>
      <span class=" fui-time" style=" margin-left: 8px;">2013-11-19 20：00：00</span>
    </p>
  </div>
</div>

<div class="lefttitle">
  全站推荐 | 全站 <a class=" text-muted switch btn-link">切换到本校</a> <a
  class=" text-primary all pull-right" href="#">全部</a>
</div>

<div class="leftrow">
  <div class="postitembig">
    <img class="postimage" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/jinxismall.jpg" alt="" />

    <div class="postinfo">
      <a href="#" class="posttitle text-primary">【求购】手机：诺基亚C6</a>
      <p class="postaddress">北京航天航空大学</p>
      <p class="postuser">
        <span class=" fui-user"><a href="#" class=" text-info">罗天航</a></span>
        <span class=" fui-time" style="margin-left: 8px;">2013-11-19
          20：00：00</span> <span class=" fui-new" style="margin-left: 8px;">12</span>
          <span class=" fui-eye" style="margin-left: 8px;">33</span>
        </p>
      </div>

      <div class="postquality">
        <img class="quality" src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/class/2.png" alt="" />
        <p class="postprice">￥500</p>
      </div>
    </div>
  </div>

  <div class="leftrow">
    <div style="position: relative; float: left; width: 350px;">
      <a href="#" class="posttitlesm text-primary">【求购】手机：诺基亚C6</a>
    </div>
    <div style="position: relative; float: left; width: 422px;">
      <p class="postusersm pull-right">
        <span class=" fui-user"><a href="#" class=" text-info">罗天航</a></span>
        <span class=" fui-time" style="margin-left: 8px;">2013-11-19 20：00：00</span>
      </p>
    </div>

    <div style="position: relative; float: left; width: 350px;">
      <a href="#" class="posttitlesm text-primary">【求购】手机：诺基亚C6</a>
    </div>
    <div style="position: relative; float: left; width: 422px;">
      <p class="postusersm pull-right">
        <span class=" fui-user"><a href="#" class=" text-info">罗天航</a></span>
        <span class=" fui-time" style="margin-left: 8px;">2013-11-19 20：00：00</span>
      </p>
    </div>

    <div style="position: relative; float: left; width: 350px;">
      <a href="#" class="posttitlesm text-primary">【求购】手机：诺基亚C6</a>
    </div>
    <div style="position: relative; float: left; width: 422px;">
      <p class="postusersm pull-right">
        <span class=" fui-user"><a href="#" class=" text-info">罗天航</a></span>
        <span class=" fui-time" style="margin-left: 8px;">2013-11-19 20：00：00</span>
      </p>
    </div>

    <div style="position: relative; float: left; width: 350px;">
      <a href="#" class="posttitlesm text-primary">【求购】手机：诺基亚C6</a>
    </div>
    <div style="position: relative; float: left; width: 422px;">
      <p class="postusersm pull-right">
        <span class=" fui-user"><a href="#" class=" text-info">罗天航</a></span>
        <span class=" fui-time" style="margin-left: 8px;">2013-11-19 20：00：00</span>
      </p>
    </div>
  </div>


  <div class="lefttitle">
    教材专区 | 全站 <a class=" text-muted switch btn-link">切换到本校</a> <a
    class=" text-primary all pull-right" href="#">全部</a>
  </div>
  <div class="leftrow"
  style="width: 802px; margin-left: -15px; margin-top: 15px;">
  <div class="textbookitem">
    <img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/textbook/gslc.jpg" alt="" style="width: 100%" />
    <p class="tbtitle">公司理财（罗斯著）</p>
    <p class="tbtitle">机械工业出版社</p>
    <p class="tbinfo">已有119人求购，300人转让</p>
  </div>
  <div class="textbookitem">
    <img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/textbook/gslc.jpg" alt="" style="width: 100%" />
    <p class="tbtitle">公司理财（罗斯著）</p>
    <p class="tbtitle">机械工业出版社</p>
    <p class="tbinfo">已有119人求购，300人转让</p>
  </div>
  <div class="textbookitem">
    <img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/textbook/gslc.jpg" alt="" style="width: 100%" />
    <p class="tbtitle">公司理财（罗斯著）</p>
    <p class="tbtitle">机械工业出版社</p>
    <p class="tbinfo">已有119人求购，300人转让</p>
  </div>
  <div class="textbookitem">
    <img src="<?php echo $_smarty_tpl->tpl_vars['baseurl']->value;?>
img/textbook/gslc.jpg" alt="" style="width: 100%" />
    <p class="tbtitle">公司理财（罗斯著）</p>
    <p class="tbtitle">机械工业出版社</p>
    <p class="tbinfo">已有119人求购，300人转让</p>
  </div>
</div>


<div class="leftrow" style="margin-top: 15px;">
  <div class="panel panel-default"
  style="width: 378px; padding: 20px; position: relative; float: left;">
  常见问题<a class="text-info btn-link pull-right"
  style="font-size: 13px; font-family: 宋体;">查看全部</a>
  <ul>
    <li><a href="#" class="text-info" style="font-size: 14px;">常见问题</a></li>
    <li><a href="#" class="text-info" style="font-size: 14px;">常见问题</a></li>
    <li><a href="#" class="text-info" style="font-size: 14px;">常见问题</a></li>
    <li><a href="#" class="text-info" style="font-size: 14px;">常见问题</a></li>
    <li><a href="#" class="text-info" style="font-size: 14px;">常见问题</a></li>
  </ul>
</div>
<div class="panel panel-default"
style="margin-left: 16px; width: 378px; padding: 20px; position: relative; float: left;">
相关资讯
<ul>
  <li><a href="#" class="text-info" style="font-size: 14px;">相关资讯</a></li>
  <li><a href="#" class="text-info" style="font-size: 14px;">相关资讯</a></li>
  <li><a href="#" class="text-info" style="font-size: 14px;">相关资讯</a></li>
  <li><a href="#" class="text-info" style="font-size: 14px;">相关资讯</a></li>
  <li><a href="#" class="text-info" style="font-size: 14px;">相关资讯</a></li>
</ul>
</div>
</div>
<div class="leftrow">


  <div class="ujian-hook"></div>

  
</div>
-->
</div><?php }} ?>
