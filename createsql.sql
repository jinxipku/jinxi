drop table if exists jx_account;
create table jx_account(
	id int(11) not null AUTO_INCREMENT  comment '用户id',
	email varchar(30) comment '用户邮箱',
	password varchar(128) not null comment '密码',
	is_verified tinyint(1) not null default 0 comment '是否验证',
	reg_ip varchar(30) comment '注册ip',
	last_ip varchar(30) comment '最后登录ip',
	last_login int(11) comment '最后登录时间',
	logins int(11) comment '连续登陆天数',
	primary key(id),
	unique key(email)
)DEFAULT CHARSET=utf8 COMMENT='账户表';
drop table if exists jx_user;
create table jx_user(
	id int(11) not null comment '用户账户id',
	nick varchar(30) comment '用户昵称',
	school_id int(4) comment '学校id',
	points int(11) comment '分数',
	head varchar(200) null comment '用户头像',
	thumb varchar(200) null comment '用户头像缩略图',

	signature varchar(140) null default '我是一只快乐的今昔兔~' comment '用户个性签名',
	visits int(11) not null default 0 comment '访问量',
	nick_color tinyint(1) not null default 0 comment '昵称颜色',
	
	sex tinyint(1) not null default 0 comment '性别，0兔星人，1汪星人，2猫星人',
	type smallint not null default 0 comment '账户类型(未选择0,本科生1，硕士生2，博士生3，教职工4，校友5，校外合作者6)',

	year smallint null default 0 comment '学历年份（未选择0，其他1）',

	email varchar(30) null default '未填写' comment '用户常用邮箱',
	qq varchar(20) null default '未填写' comment 'qq',
	phone varchar(20) null default '未填写' comment '手机号',
	weixin varchar(30) null default '未填写' comment '微信号',
	is_email_public tinyint(1) unsigned not null default 0 comment '是否开放邮箱',
	is_phone_public tinyint(1) unsigned not null default 0 comment '是否开放手机',
	is_qq_public tinyint(1) unsigned not null default 0 comment '是否开放qq',
	is_weixin_public tinyint(1) unsigned not null default 0 comment '是否开放微信',
	post_number int(11) not null default 0 comment '总帖子数量',
	active_post_number int(11) not null default 0 comment '活跃帖子数量',

	is_sign_public tinyint(1) unsigned not null default 0 comment '回复时是否带签名',
	is_mars tinyint(1) unsigned not null default 0 comment '手机或qq是否转成火星文',
	primary key(id)
)DEFAULT CHARSET=utf8 COMMENT='用户profile表';

drop table if exists jx_love;
create table jx_love(
	lover int(11) not null comment '关注者id',
	lovee int(11) not null comment '被关注者id'

)DEFAULT CHARSET=utf8 COMMENT='关注表';
create index lover_index on jx_love(lover);
create index lovee_index on jx_love(lovee);

drop table if exists jx_favorites;
create table jx_favorites(
	user_id int(11) not null comment '收藏者',
	post_id int(11) not null comment '被收藏帖子id',
	type tinyint(1) not null comment '被收藏帖子类别,1为卖家的，2为买家的',
	addat int(11) not null comment '收藏时间'
)DEFAULT CHARSET=utf8 COMMENT='收藏表';

create index user_index on jx_favorites(user_id);
create index post_index on jx_favorites(post_id);
create index type_index on jx_favorites(type);

drop table if exists jx_school_info;
create table jx_school_info(
	school_id int(11) not null comment '学校id',
	school_name varchar(30) comment '学校名称',
	school_region varchar(30) comment '所处省市',
	primary key(school_id)
)DEFAULT CHARSET=utf8 COMMENT='学校信息表';


drop table if exists jx_seller_post;
create table jx_seller_post(
	post_id int(11) not null AUTO_INCREMENT comment '帖子id',
	user_id int(11) not null comment '发帖用户id',
	category1 smallint not null comment '一级分类',
	category2 smallint not null comment '二级分类',
	brand varchar(20) null comment '品牌',
	model varchar(40) null comment '型号',
	class smallint not null comment '商品级别(0-S正品  1-S自制 2-A 3-B 4-C',
	createat int(11) not null comment '创建时间',
	updateat int(11) not null comment '最后更新时间',
	description text null comment '商品描述',
	first_picture tinyint not null default 0 comment '首图位置',
	picture text null comment '图片列表(json序列化对象)',
	price int(11) null comment '预期出售价格(1赠送，0面议)',
	deal int(11) not null default 0 comment '成交方式(1一口价，2接受砍价，3一元赠送，4面议)',
	contactby varchar(20) null comment '期望的联系方式（1邮箱，4手机，2qq，3微信，0站内），可多选，以逗号分隔',
	active tinyint not null default 1 comment '帖子状态(1,正常，2，关闭）',
	favorite_num int(11) not null default 0 comment '收藏数量',
	reply_num int(11) not null default 0 comment '回复数量',
	primary key(post_id)
)DEFAULT CHARSET=utf8 COMMENT='卖家帖子';
create index user_index on jx_seller_post(user_id);
create index active_index on jx_seller_post(active);

drop table if exists jx_buyer_post;
create table jx_buyer_post(
	post_id int(11) not null AUTO_INCREMENT comment '帖子id',
	user_id int(11) not null comment '发帖用户id',
	category1 smallint not null comment '一级分类',
	category2 smallint not null comment '二级分类',
	brand varchar(20) null comment '品牌',
	model varchar(40) null comment '型号',
	class smallint not null comment '商品级别',
	createat int(11) not null comment '创建时间',
	updateat int(11) not null comment '最后更新时间',
	description text null comment '描述',
	price int(11) null comment '预期买入价格(1赠送，0面议)',
	deal int(11) not null default 0 comment '成交方式(1心理价位，2,面议)',
	contactby varchar(20) null comment '期望的联系方式（1邮箱，4手机，2qq，3微信，0站内），可多选，以逗号分隔',
	active tinyint not null default 1 comment '帖子状态(1,正常，2，关闭）',
	favorite_num int(11) not null default 0 comment '收藏数量',
	reply_num int(11) not null default 0 comment '回复数量',
	primary key(post_id)
)DEFAULT CHARSET=utf8 COMMENT='买家帖子';
create index user_index on jx_buyer_post(user_id);
create index active_index on jx_buyer_post(active);

drop table if exists jx_reply;
create table jx_reply(
	id int(11) not null AUTO_INCREMENT comment 'id',
	post_id int(11) not null comment '帖子id',
	type tinyint not null comment '帖子类型',
	floor int(11) not null comment '楼层',
	reply_from int(11) not null comment '回复者id',
	reply_to int(11) not null comment '被回复者id',
	reply_to_floor int(11) not null comment '回复楼层',
	content text null comment '回复内容',
	createat int(11) comment '创建时间',
	primary key(id),
	unique(post_id,type,floor)
)DEFAULT CHARSET=utf8 COMMENT='帖子回复';

drop table if exists jx_report;
create table jx_report(
	report_id int(11) not null AUTO_INCREMENT comment 'id',
	reason varchar(30) not null default 0 comment '举报原因',
	other_reason text null comment '举报的其他原因',
	reply_id int(11) comment '被举报回复的id',
	primary key(report_id)
)DEFAULT CHARSET=utf8 COMMENT='举报表';

drop table if exists jx_admin;
create table jx_admin(
	id int(11) not null AUTO_INCREMENT comment 'id',
	admin_name text not null,
	password varchar(128) not null,
	primary key(id)
)DEFAULT CHARSET=utf8 COMMENT='后台admin表';
insert into jx_admin values(1,'jx_admin','H6eBqhiZJyg2KESRqKwuh3BY8qGeSkMW1YDO54KzR67wNSOmWgszWuzuV/dr1lOHSa8aE0yxSYDBcEI0or347w==');

drop table if exists jx_advice;
create table jx_advice(
	id int(11) not null AUTO_INCREMENT comment 'id',
	content text null comment '建议内容',
	user_id int(11) not null default 0 comment '用户id，若无，默认为0',
	addat int(11) comment '创建时间',
	primary key(id)
)DEFAULT CHARSET=utf8 COMMENT='用户建议';

drop table if exists jx_visit;
create table jx_visit(
	visitor int(11) comment '看的人',
	visitee int(11) comment '被看的人',
	unique(visitor,visitee)
)DEFAULT CHARSET=utf8 COMMENT='拜访表';
create index visit_index on jx_visit(visitee);
-- drop view if exists seller_post_heat;
-- create view seller_post_heat as select jx_seller_post.post_id,(jx_seller_post.createat-unix_timestamp())/86400 as daypass,count(jx_reply.id) as count from jx_seller_post left join jx_reply on jx_reply.post_id=jx_seller_post.post_id and jx_reply.type=0 group by jx_seller_post.post_id;
-- select * from seller_post_heat;

-- drop view if exists buyer_post_heat;
-- create view buyer_post_heat as select jx_buyer_post.post_id,(jx_buyer_post.createat-unix_timestamp())/86400 as daypass,count(jx_reply.id) as count from jx_buyer_post left join jx_reply on jx_reply.post_id=jx_buyer_post.post_id and jx_reply.type=1 group by jx_buyer_post.post_id;
