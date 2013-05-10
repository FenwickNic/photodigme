/*==============================================
			GROUPS
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.groups;
CREATE TABLE ygd_photodigme.groups
(
	id int unsigned not null auto_increment,
	name varchar(100) not null,
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

insert into ygd_photodigme.groups(id,name) VALUES
(1,'Users'),
(2,'Members'),
(3,'Admin');