drop table if exists jx_account;
create table jx_account(
	id int(11) not null AUTO_INCREMENT  comment '用户id',
	email varchar(30) comment '用户邮箱',
	school_id int(4) comment '学校id',
	nick varchar(30) comment '用户昵称',
	password varchar(128) not null comment '密码',
	is_verified tinyint(1) not null default 0 comment '是否验证',
	reg_ip varchar(30) comment '注册ip',
	last_ip varchar(30) comment '最后登录ip',
	last_login int(11) comment '最后登录时间',
	logins int(11) comment '连续登陆天数',
	points int(11) comment '分数',
	primary key(id),
	unique key(email)
);
drop table if exists jx_user;
create table jx_user(
	id int(11) not null comment '用户账户id',
	head varchar(200) null comment '用户头像',
	thumb varchar(200) null comment '用户头像缩略图',
	qq varchar(20) null comment 'qq',
	phone_number varchar(20) null comment '手机号',
	weixin varchar(30) null comment '微信号',
	primary key(id)
);