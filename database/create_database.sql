create database if not exists ygd_photodigme;

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
	creationdate DATETIME,
	lastupdate DATETIME,
	published bool not null default true,
	publicationdate DATETIME default null,
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


/*==============================================
			PERMISSIONS REPLACED BY ARO_ACO
===============================================
DROP TABLE IF EXISTS ygd_photodigme.permissions;
CREATE TABLE ygd_photodigme.permissions
(
	id int unsigned not null auto_increment,
	name varchar(70) not null,
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO ygd_photodigme.permissions(id,name) VALUES
(1,'Free'),
(2,'Registered'),
(3,'Limited');
*/

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


/*==============================================
			ROLES REPLACED BY ARO_ACO
===============================================
DROP TABLE IF EXISTS ygd_photodigme.roles;
CREATE TABLE ygd_photodigme.roles
(
	id int unsigned not null auto_increment,
	name varchar(70) not null,
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO ygd_photodigme.roles(id,name) VALUES
(1,'user'),
(2,'member'),
(3,'administrator');
*/
/*==============================================
			GROUPS_USERS REPLACED BY ARO_ACO
===============================================
DROP TABLE IF EXISTS ygd_photodigme.groups_users;
CREATE TABLE ygd_photodigme.groups_users
(
	group_id int not null,
	user_id int not null
	
) ENGINE=INNODB DEFAULT CHARSET=utf8;
*/
/*==============================================
			CATEGORIES_USERS REPLACED BY ARO_ACO
===============================================
DROP TABLE IF EXISTS ygd_photodigme.categories_users;
CREATE TABLE ygd_photodigme.categories_users
(
	category_id int not null,
	user_id int not null
	
) ENGINE=INNODB DEFAULT CHARSET=utf8;
*/
/*==============================================
			CATEGORIES_GROUPS BY REPLACED ARO_ACO
===============================================
DROP TABLE IF EXISTS ygd_photodigme.categories_groups;
CREATE TABLE ygd_photodigme.categories_groups
(
	category_id int not null,
	group_id int not null
	
) ENGINE=INNODB DEFAULT CHARSET=utf8;
*/
/*==============================================
			PHOTOS
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.photos;
CREATE TABLE ygd_photodigme.photos
(
	id int unsigned not null auto_increment,
	secretkey varchar(20) not null,
	originalfileurl varchar(256),
	title varchar(100),
	description text,
	geocodes varchar(30),
	author varchar(70),
	takendate DATETIME,
	lastupdate DATETIME,
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*==============================================
			VIDEO
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.videos;
CREATE TABLE ygd_photodigme.videos
(
	id int unsigned not null auto_increment,
	secretkey varchar(100),
	title varchar(100),
	description text,
	geocodes varchar(30),
	author varchar(70),
	takendate DATETIME,
	lastupdate DATETIME,
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*==============================================
			TEXT
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.texts;
CREATE TABLE ygd_photodigme.texts
(
	id int unsigned not null auto_increment,
	title varchar(100),
	body text,
	lastupdate DATETIME,
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*==============================================
			ENTITY
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.entities;
CREATE TABLE ygd_photodigme.entities
(
	id int unsigned not null auto_increment,
	photo_id int,
	video_id int,
	text_id int,
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*==============================================
			CATEGORY ENTITY
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.categories_entities;
CREATE TABLE ygd_photodigme.categories_entities
(
	id int unsigned not null auto_increment,
	category_id int NOT NULL,
	entity_id int NOT NULL,
	ordernumber int NOT NULL,
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*==============================================
			COMMENTS
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.comments;
CREATE TABLE ygd_photodigme.comments
(
	id int unsigned not null auto_increment,
	user_id int NOT NULL,
	text text,
	rate int,
	timestamp DATETIME,
	
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*==============================================
			ENTITY COMMENTS
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.comments_entities;
CREATE TABLE ygd_photodigme.comments_entities
(
	entity_id int,
	comment_id int
	
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*==============================================
			COMMENTS CATEGORIES
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.categories_comments;
CREATE TABLE ygd_photodigme.categories_comments
(
	category_id int,
	comment_id int
	
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*==============================================
			Credentials Lost
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.credlost;
CREATE TABLE ygd_photodigme.credlost
(
	id int unsigned not null auto_increment,
	user_id int NOT NULL,
	secretkey varchar(256),
	timestamp DATETIME,
	
	PRIMARY KEY(id)
	
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*==============================================
			ACO
===============================================*/

DROP TABLE IF EXISTS ygd_photodigme.acos;
CREATE TABLE ygd_photodigme.acos (
  id INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  parent_id INTEGER(10) DEFAULT NULL,
  model VARCHAR(255) DEFAULT '',
  foreign_key INTEGER(10) UNSIGNED DEFAULT NULL,
  alias VARCHAR(255) DEFAULT '',
  lft INTEGER(10) DEFAULT NULL,
  rght INTEGER(10) DEFAULT NULL,
  PRIMARY KEY  (id)
);


/*==============================================
			ARO_ACO
===============================================*/

DROP TABLE IF EXISTS ygd_photodigme.aros_acos;
CREATE TABLE ygd_photodigme.aros_acos (
  id INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  aro_id INTEGER(10) UNSIGNED NOT NULL,
  aco_id INTEGER(10) UNSIGNED NOT NULL,
  _create CHAR(2) NOT NULL DEFAULT 0,
  _read CHAR(2) NOT NULL DEFAULT 0,
  _update CHAR(2) NOT NULL DEFAULT 0,
  _delete CHAR(2) NOT NULL DEFAULT 0,
  PRIMARY KEY(id)
);


/*==============================================
			ARO
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.aros;
CREATE TABLE ygd_photodigme.aros (
  id INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  parent_id INTEGER(10) DEFAULT NULL,
  model VARCHAR(255) DEFAULT '',
  foreign_key INTEGER(10) UNSIGNED DEFAULT NULL,
  alias VARCHAR(255) DEFAULT '',
  lft INTEGER(10) DEFAULT NULL,
  rght INTEGER(10) DEFAULT NULL,
  PRIMARY KEY  (id)
);
