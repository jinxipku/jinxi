    <div id="body" class="row">
        <div id="main">
            <div id="slide_show" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#slide_show" data-slide-to="0" class="active"></li>
                    <li data-target="#slide_show" data-slide-to="1"></li>
                    <li data-target="#slide_show" data-slide-to="2"></li>
                    <li data-target="#slide_show" data-slide-to="3"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active"><a href="{$baseurl}account/register"><img src="{$baseurl}img/bg/1.jpg" alt="立即注册"/></a></div>
                    <div class="item"><a href="{$baseurl}user/profile/0"><img src="{$baseurl}img/bg/2.jpg" alt="前往个人中心"/></a></div>
                    <div class="item"><a href="{$baseurl}display/sell"><img src="{$baseurl}img/bg/3.jpg" alt="前往商品大厅"/></a></div>
                    <div class="item"><a href="{$baseurl}post/newpost"><img src="{$baseurl}img/bg/4.jpg" alt="前往信息发布"/></a></div>
                </div>
                <!-- Controls --> 
                <a class="left carousel-control" href="#slide_show" data-slide="prev"> 
                    <span class="glyphicon glyphicon-chevron-left"></span> 
                </a>
                <a class="right carousel-control" href="#slide_show" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span> 
                </a> 
            </div>

            {if isset($recommend)}
            <div class="main_title">我的推荐
                <a class="pull-right" href="{$baseurl}user/profile/{$login_user.id}/best">全部</a>
            </div>

            <div id="post_items_box" class="panel panel-default index_show">
              {foreach from = $recommend item = post}
              <hr/>
              <div class="post_item_box">
                <div class="post_item_img">
                  <a href="{$baseurl}post/viewpost/{if $post.type == 0}sell{else}buy{/if}/{$post.post_id}" target="_blank">
                    <img class="lazy" data-original="{$post.picture}" alt="{$post.plain_title}" />
                  </a>
                </div>
                <div class="post_item_content">
                  <div>
                    <a href="{$baseurl}post/viewpost/{if $post.type == 0}sell{else}buy{/if}/{$post.post_id}" title='{$post.plain_title}' target="_blank">
                      {$post.title}
                    </a>
                  </div>
                  <div class="post_item_description">
                    {$post.description}
                  </div>
                  <div>
                    <div>
                      <div class="post_item_user_nick">
                        <a href="{$baseurl}user/profile/{$post.user_id}" class="{$post.user.nick_color}" target="_blank">
                          <span class="fui-user"></span>{$post.user.nick} 
                        </a>
                      </div>
                      <div>
                        {if !isset($login_user)}
                        <a type="button" class="btn btn-xs btn-info pull-right" href="{$baseurl}account/loginfo"><span class="fui-plus"></span>收藏</a>
                        {elseif $post.user_id == $login_user.id}
                        <button type="button" class="btn btn-warning btn-xs pull-right" disabled>我 的</button>
                        {elseif $post.has_collect}
                        <button type="button" data-pid="{$post.post_id}" data-ptype="{$post.type}" class="btn1_post_item btn btn-xs btn-info pull-right">已收藏</button>
                        {else}
                        <button type="button" data-pid="{$post.post_id}" data-ptype="{$post.type}" class="btn2_post_item btn btn-xs btn-info pull-right"><span class="fui-plus"></span>收藏</button>
                        {/if}
                      </div>
                    </div>
                    <div>
                      <span class="fui-location">
                        {$post.user.school_name}
                      </span>
                      <span class="fui-time">
                        {$post.createat}
                      </span>
                      <span class="fui-new">
                        {$post.reply_num}
                      </span>
                      <span class="fui-heart">
                        {$post.favorite_num}
                      </span>
                    </div>
                  </div>
                </div>
                <div class="post_item_price">
                  <div>
                    <img class="lazy" data-original="{$baseurl}img/class/{$post.class}.png" alt="物品状态" />
                  </div>
                  <div>
                    {if $post.price == 0 && $post.deal == '面议'}面议{else}￥{$post.price}{/if}
                  </div>
                </div>
              </div>
              {/foreach}
            </div>
            {/if}

            <div class="main_title">电子数码
                <a class="pull-right" href="{$baseurl}display/sell/school/time/1">全部</a>
            </div>

            <div id="post_items_block" class="index_show">
              {foreach from = $digital item = post}
              <div class="post_item_block panel panel-default">
                <div class="post_item_block_user">
                  <div>
                    <a href="{$baseurl}user/profile/{$post.user_id}" target="_blank">
                      <img class="lazy" data-original="{$post.user.thumb}" alt="{$post.user.nick}" /> 
                    </a>
                  </div>
                  <div>
                    <p>
                      <a href="{$baseurl}user/profile/{$post.user_id}" class="{$post.user.nick_color}" target="_blank" title="{$post.user.school_name}">{$post.user.nick}</a><small  title="{$post.user.school_name}">{$post.user.school_name}</small>
                    </p>
                    <p>
                      <small>{$post.createat}</small>
                    </p>
                  </div>
                </div>

                <div class="post_item_block_img">
                  <a href="{$baseurl}post/viewpost/{if $post.type == 0}sell{else}buy{/if}/{$post.post_id}" target="_blank">
                    <div class="post_item_block_class_cover">
                    </div>
                    <div class="post_item_block_class_cont">
                      <div>
                        {if $post.price == 0 && $post.deal == '面议'}面议{else}￥{$post.price}{/if}
                      </div>
                      <div>
                        <img class="lazy passive" data-original="{$baseurl}img/class/{$post.class}.png" alt="物品状态" />
                      </div>
                    </div>
                    <img class="lazy" data-original="{$post.picture}" alt="{$post.plain_title}" />
                  </a>
                </div>
                <div class="post_item_block_title">
                  <a href="{$baseurl}post/viewpost/{if $post.type == 0}sell{else}buy{/if}/{$post.post_id}" title='{$post.plain_title}' target="_blank">
                    {$post.title}
                  </a>
                </div>
                <div class="post_item_block_others">
                  <div>
                    <span class="fui-new">
                      {$post.reply_num}
                    </span>
                    <span class="fui-heart">
                      {$post.favorite_num}
                    </span>
                  </div>
                  <div>
                    {if !isset($login_user)}
                    <a type="button" class="btn btn-sm btn-info" href="{$baseurl}account/loginfo"><span class="fui-plus"></span>收藏</a>
                    {elseif $post.user_id == $login_user.id}
                    <button type="button" class="btn btn-warning btn-sm" disabled>我 的</button>
                    {elseif $post.has_collect}
                    <button type="button" data-pid="{$post.post_id}" data-ptype="{$post.type}" class="btn1_post_item btn btn-sm btn-info">已收藏</button>
                    {else}
                    <button type="button" data-pid="{$post.post_id}" data-ptype="{$post.type}" class="btn2_post_item btn btn-info btn-sm"><span class="fui-plus"></span>收藏</button>
                    {/if}
                  </div>
                </div>
              </div>      
              {/foreach}
              <div class="clear"></div>
            </div>

            <div class="main_title">图书教材
                <a class="pull-right" href="{$baseurl}display/sell/school/time/5">全部</a>
            </div>

            <div id="post_items_block" class="index_show">
              {foreach from = $book item = post}
              <div class="post_item_block panel panel-default">
                <div class="post_item_block_user">
                  <div>
                    <a href="{$baseurl}user/profile/{$post.user_id}" target="_blank">
                      <img class="lazy" data-original="{$post.user.thumb}" alt="{$post.user.nick}" /> 
                    </a>
                  </div>
                  <div>
                    <p>
                      <a href="{$baseurl}user/profile/{$post.user_id}" class="{$post.user.nick_color}" target="_blank" title="{$post.user.school_name}">{$post.user.nick}</a><small  title="{$post.user.school_name}">{$post.user.school_name}</small>
                    </p>
                    <p>
                      <small>{$post.createat}</small>
                    </p>
                  </div>
                </div>

                <div class="post_item_block_img">
                  <a href="{$baseurl}post/viewpost/{if $post.type == 0}sell{else}buy{/if}/{$post.post_id}" target="_blank">
                    <div class="post_item_block_class_cover">
                    </div>
                    <div class="post_item_block_class_cont">
                      <div>
                        {if $post.price == 0 && $post.deal == '面议'}面议{else}￥{$post.price}{/if}
                      </div>
                      <div>
                        <img class="lazy passive" data-original="{$baseurl}img/class/{$post.class}.png" alt="物品状态" />
                      </div>
                    </div>
                    <img class="lazy" data-original="{$post.picture}" alt="{$post.plain_title}" />
                  </a>
                </div>
                <div class="post_item_block_title">
                  <a href="{$baseurl}post/viewpost/{if $post.type == 0}sell{else}buy{/if}/{$post.post_id}" title='{$post.plain_title}' target="_blank">
                    {$post.title}
                  </a>
                </div>
                <div class="post_item_block_others">
                  <div>
                    <span class="fui-new">
                      {$post.reply_num}
                    </span>
                    <span class="fui-heart">
                      {$post.favorite_num}
                    </span>
                  </div>
                  <div>
                    {if !isset($login_user)}
                    <a type="button" class="btn btn-sm btn-info" href="{$baseurl}account/loginfo"><span class="fui-plus"></span>收藏</a>
                    {elseif $post.user_id == $login_user.id}
                    <button type="button" class="btn btn-warning btn-sm" disabled>我 的</button>
                    {elseif $post.has_collect}
                    <button type="button" data-pid="{$post.post_id}" data-ptype="{$post.type}" class="btn1_post_item btn btn-sm btn-info">已收藏</button>
                    {else}
                    <button type="button" data-pid="{$post.post_id}" data-ptype="{$post.type}" class="btn2_post_item btn btn-info btn-sm"><span class="fui-plus"></span>收藏</button>
                    {/if}
                  </div>
                </div>
              </div>      
              {/foreach}
              <div class="clear"></div>
            </div>

            <script type="text/javascript" src="{$baseurl}js/collect_bind.js"></script>
<!--
    <div class="main_title">自动匹配 | 本站
        <a class=" text-muted switch btn-link">切换到绑定BBS</a>
        <a class=" text-primary all pull-right" href="#">全部</a>
    </div>

<div class="leftrow">
  <div class="postitembig">
    <img class="postimage" src="{$baseurl}img/jinxismall.jpg" alt=""/>
    
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
      <img class="quality" src="{$baseurl}img/class/2.png" alt=""/>
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
    <img class="postimage" src="{$baseurl}img/jinxismall.jpg" alt="" />

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
        <img class="quality" src="{$baseurl}img/class/2.png" alt="" />
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
    <img src="{$baseurl}img/textbook/gslc.jpg" alt="" style="width: 100%" />
    <p class="tbtitle">公司理财（罗斯著）</p>
    <p class="tbtitle">机械工业出版社</p>
    <p class="tbinfo">已有119人求购，300人转让</p>
  </div>
  <div class="textbookitem">
    <img src="{$baseurl}img/textbook/gslc.jpg" alt="" style="width: 100%" />
    <p class="tbtitle">公司理财（罗斯著）</p>
    <p class="tbtitle">机械工业出版社</p>
    <p class="tbinfo">已有119人求购，300人转让</p>
  </div>
  <div class="textbookitem">
    <img src="{$baseurl}img/textbook/gslc.jpg" alt="" style="width: 100%" />
    <p class="tbtitle">公司理财（罗斯著）</p>
    <p class="tbtitle">机械工业出版社</p>
    <p class="tbinfo">已有119人求购，300人转让</p>
  </div>
  <div class="textbookitem">
    <img src="{$baseurl}img/textbook/gslc.jpg" alt="" style="width: 100%" />
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
</div>