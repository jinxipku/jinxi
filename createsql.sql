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

	signature varchar(140) null comment '用户个性签名',
	visits int(11) not null default 0 comment '访问量',
	nick_color tinyint(1) not null default 0 comment '昵称颜色',
	
	sex tinyint(1) not null default 0 comment '性别，0兔星人，1汪星人，2猫星人',
	type smallint not null default 0 comment '账户类型(其他0,本科生1，硕士生2，博士生3，教职工4，校友5，校外合作者6)',

	year smallint null comment '学历年份',

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
	primary key(id)
)DEFAULT CHARSET=utf8 COMMENT='用户profile表';

drop table if exists jx_love;
create table jx_love(
	lover int(11) not null comment '关注者id',
	lovee int(11) not null comment '被关注者id'

)DEFAULT CHARSET=utf8 COMMENT='关注表';

drop table if exists jx_school_info;
create table jx_school_info(
	school_id int(11) not null comment '学校id',
	school_name varchar(30) comment '学校名称',
	school_region varchar(30) comment '所处省市',
	primary key(school_id)
)DEFAULT CHARSET=utf8 COMMENT='学校信息表';