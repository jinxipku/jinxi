		<div id="side">
			<div id="login_box" class="side_content panel panel-default">
				<button type="button" class="close" onClick="pre_login()">&times;</button>
				<form method="post" id="login_form">
					<div class="form-group">
						<input id="email" name="email" type="mail" placeholder="校园邮箱" class="form-control flat" onblur="check_email(1)">
						<span class="danger" id="check_email"> </span>
					</div>
					<div class="form-group">
						<input id="password" name="password" type="password" placeholder="密码" class="form-control flat" onblur="check_pw()" onpaste="return false"> 
						<span class="danger" id="check_pw"> </span>
					</div>
					<button id="btn_login" type="button" class="btn btn-primary btn-block" onClick="login(0)">登录</button>
					<p class="p_info">还木有账号？</p>
					<a href="{$baseurl}account/register" type="button" class="btn btn-info btn-block">立即注册</a>
				</form>
			</div>

			<a href="{$baseurl}display/sell" type="button" class="btn btn-primary btn-hg btn-block">商品大厅</a>
			<a href="{$baseurl}post/newpost" type="button" class="btn btn-primary btn-hg btn-block">发布信息</a>

			<div id="side_tips">
				<blockquote>
					<p class="side_title">今昔贴士</p>
				</blockquote>
				<div class="side_content panel panel-default">
					<p class="p_song_title">{$tips.strtit}</p>
					<p class="p_song_content">&nbsp;&nbsp;{$tips.strcon}</p>
					<p class="p_song_content">&nbsp;&nbsp;精彩大学生活，今昔网将与您共同分享！</p>
					<p class="p_song_link">
						<a href="{$baseurl}info/about" class="text-info btn-link">关于今昔</a>
						<span> | </span>
						<a href="{$baseurl}info/help" class="text-info btn-link">帮助中心</a>
					</p>
				</div>
			</div>

			<div id="side_quality">
				<blockquote>
					<p class="side_title">物品品质</p>
				</blockquote>
				<div class="panel panel-default">
					<img class="passive" src="{$baseurl}img/quality.jpg" alt="quality.jpg"/>
				</div>
			</div>

			<div id="side_tags">
				<blockquote>
					<p class="side_title">物品标签</p>
				</blockquote>
				<div class="panel panel-default">
					<ul class="list-group">
						<li class="list-group-item">
							<p class="text-primary side_tag" data-toggle="collapse" data-target="#tag1"><span class="tag bg-primary">转让</span>：适用于待转物品</p>
							<p id="tag1" class="collapse side_tagcon">&nbsp;&nbsp;标明此物品为转让物品，有相关需求的用户可以收藏并回复此帖。</p>
						</li>
						<li class="list-group-item">
							<p class="text-info side_tag" data-toggle="collapse" data-target="#tag2"><span class="tag bg-info">求购</span>：适用于欲求物品</p>
							<p id="tag2" class="collapse side_tagcon">&nbsp;&nbsp;标明此物品为求购物品，有相关闲置的用户可以收藏并回复此帖。</p>
						</li>
						<li class="list-group-item">
							<p class="text-danger side_tag" data-toggle="collapse" data-target="#tag3"><span class="tag bg-danger">自制</span>：适用于待转物品</p>
							<p id="tag3" class="collapse side_tagcon">&nbsp;&nbsp;标明此物品为楼主手工自制品，物品品质为S级别。</p>
						</li>
						<li class="list-group-item">
							<p class="text-warning side_tag" data-toggle="collapse" data-target="#tag4"><span class="tag bg-warning">一元送</span>：适用于待转物品</p>
							<p id="tag4" class="collapse side_tagcon">&nbsp;&nbsp;标明此物品为福利赠送，只收一元钱。</p>
						</li>
						<li class="list-group-item">
							<p class="text-warning side_tag" data-toggle="collapse" data-target="#tag5"><span class="tag bg-warning">一口价</span>：适用于待转物品</p>
							<p id="tag5" class="collapse side_tagcon">&nbsp;&nbsp;标明此物品不接受讲价。</p>
						</li>
						<li class="list-group-item">
							<p class="text-purple side_tag" data-toggle="collapse" data-target="#tag6"><span class="tag bg-purple">图</span>：适用于待转物品</p>
							<p id="tag6" class="collapse side_tagcon">&nbsp;&nbsp;标明此物品附带展示图片。</p>
						</li>
					</ul>
				</div>
			</div>
			
			<img class="passive" id="side_icon" src="{$baseurl}img/jinxismall.jpg" alt="http://www.xn--wmqr18c.cn"/>

			<div id="info_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"></h4>
                  </div>
                  <div class="modal-body">
                    <p class="modal-cont"></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary">确认</button>
                  </div>
                </div>
              </div>
            </div>
            
		</div>
	</div>