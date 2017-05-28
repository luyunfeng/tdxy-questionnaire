create database think_stu_questionsnaire;
use think_stu_questionsnaire;
create table think_student (idnumber varchar(32) PRIMARY KEY,##身份证号,
	iterm varchar(10),##学期
	iuser int(14) NOT NULL,##用户名（考号）
	passwd varchar(20),##密码（密码为身份证后六位）
	iname varchar(10),##姓名
	college varchar(15),##学院
	professional varchar(20),##专业
	istatus int(1),##0为未答题，1为已答题锁定
	logintime varchar(24),##登录时间
	finishtime varchar(24)##完成时间
	)ENGINE=InnoDB DEFAULT character set=utf8;
create table think_management (ID int(8) PRIMARY KEY,
	iuser varchar(10) NOT NULL,##用户名
	passwd varchar(20),#密码
	lastlogintime varchar(24),##最后登录时间
	logincount varchar(6))##登录次数 
	ENGINE=InnoDB DEFAULT character set=utf8;

create table think_questionsnaire_selected (iterm varchar(9) NOT NULL,
	inumber int(4) NOT NULL,##题号
	text1 varchar(100),##内容
	PRIMARY KEY(iterm,inumber)
	)ENGINE=InnoDB DEFAULT character set=utf8;
create table think_questionsnaire_option (iterm varchar(9) NOT NULL,
	inumber int(4) NOT NULL,
	ioption varchar(18),##选项
	text1 varchar(120),##内容
	PRIMARY KEY(iterm,inumber),
	FOREIGN KEY(iterm,inumber) REFERENCES think_questionsnaire_selected(iterm,inumber))ENGINE=InnoDB DEFAULT character set=utf8;
create table think_questionsnaire_sanswer (iterm varchar(9) NOT NULL,
	inumber int(4) NOT NULL,
	idnumber varchar(32) NOT NULL,
	answer varchar(20),##答案
	PRIMARY KEY(iterm,inumber),
	FOREIGN KEY(iterm,inumber) REFERENCES think_questionsnaire_selected(iterm,inumber),
	FOREIGN KEY(idnumber) REFERENCES think_student(idnumber))ENGINE=InnoDB DEFAULT character set=utf8;

create table think_questionsnaire_freesponce (iterm varchar(9) NOT NULL,
	inumber int(4),
	text1 varchar(100),
	PRIMARY KEY(iterm,inumber)
	)ENGINE=InnoDB DEFAULT character set=utf8;
create table think_questionsnaire_fanswer (iterm varchar(9) NOT NULL,
	inumber int(4) NOT NULL,
	idnumber varchar(32) NOT NULL,
	text1 varchar(100),
	PRIMARY KEY(iterm,inumber),
	FOREIGN KEY(iterm,inumber) REFERENCES think_questionsnaire_freesponce(iterm,inumber),
	FOREIGN KEY(idnumber) REFERENCES think_student(idnumber))ENGINE=InnoDB DEFAULT character set=utf8;