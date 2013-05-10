/*==============================================
			USER
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.users;
CREATE TABLE ygd_photodigme.users
(
	id int unsigned not null auto_increment,
	title varchar(10),
	firstname varchar(70) not null,
	lastname varchar(70) not null,
	loginfacebook varchar(200),
	username varchar(70) not null,
	address_id int,
	email varchar(100) not null,
	group_id int default 1,
	pictureurl varchar(256),
	password varchar(100),
	accountcreationdate datetime,
	lastlogin datetime,
	
	UNIQUE (username),
	UNIQUE(email),
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;
insert into ygd_photodigme.users(id,title,firstname,lastname,loginfacebook,username,address_id,email,group_id,pictureurl,password,accountcreationdate,lastlogin) VALUES
(1,'M','Nicolas','Fenwick','nicolas.fenwick','nicolas.fenwick',1,'nicolas.fenwick@gmail.com',3,null,'','2013-05-06 20:48:50','2013-05-06 20:48:50');

/*==============================================
			ADDRESS
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.address;
CREATE TABLE ygd_photodigme.address
(
	id int unsigned not null auto_increment,
	line1 varchar(70) not null,
	line2 varchar(70),
	line3 varchar(70),
	postcode varchar(10) not null,
	city varchar(30) not null,
	country varchar(30),
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

insert into ygd_photodigme.address(id,line1,line2,line3,postcode,city,country) VALUES
(1,'4/ 105-107 Church Street',null,null,'2500','Wollongong','Australia');