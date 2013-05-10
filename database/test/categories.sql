/*==============================================
			CATEGORY
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.categories;
CREATE TABLE ygd_photodigme.categories
(
	id int unsigned not null auto_increment,
	name varchar(70) not null,
	parent_id varchar(70) default null,
	lft INTEGER(10) DEFAULT NULL,
    rght INTEGER(10) DEFAULT NULL,
	permission_id int not null default 1,
	creationdate DATETIME,
	lastupdate DATETIME,
	slug_url varchar(200) default '/',
	published bool not null default true,
	publicationdate DATETIME default null,
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

insert into ygd_photodigme.categories(id,name,parent_id,lft,rght,creationdate,lastupdate) VALUES
(1,'Voyage',null,1,12,'2013-05-06 20:48:50','2013-05-06 20:48:50'),
(2,'Japon',1,2,3,'2013-05-06 20:48:50','2013-05-06 20:48:50'),
(3,'Wollongong',1,4,5,'2013-05-06 20:48:50','2013-05-06 20:48:50'),
(4,'Sydney',1,6,7,'2013-05-06 20:48:50','2013-05-06 20:48:50'),
(5,'Kakadu NP',1,8,9,'2013-05-06 20:48:50','2013-05-06 20:48:50'),
(6,'South Coast',1,10,11,'2013-05-06 20:48:50','2013-05-06 20:48:50'),
(7,'Categories',null,13,16,'2013-05-06 20:48:50','2013-05-06 20:48:50'),
(8,'Nature',7,14,15,'2013-05-06 20:48:50','2013-05-06 20:48:50');