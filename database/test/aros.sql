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
insert into ygd_photodigme.aros(id,parent_id,model,foreign_key,alias,lft,rght) VALUES
(1,null,'Group',1,'',1,2),
(2,null,'Group',2,'',3,4),
(3,null,'Group',3,'',5,8),
(4,3,'User',1,'',6,7);

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
insert into ygd_photodigme.acos(id,parent_id,model,foreign_key,alias,lft,rght) VALUES
(1,null,null,null,'Root',1,22),
(2,1,null,null,'Free',2,19),
(3,1,null,null,'Limited',20,21),
(4,2,'Category',1,'Voyage',3,4),
(5,2,'Category',2,'Japon',5,6),
(6,2,'Category',3,'Wollongong',7,8),
(7,2,'Category',4,'Sydney',9,10),
(8,2,'Category',5,'Kakadu NP',11,12),
(9,2,'Category',6,'South Coast',13,14),
(10,2,'Category',7,'Categories',15,16),
(11,2,'Category',8,'Nature',17,18);


/*==============================================
			ACO ARO
===============================================*/
DROP TABLE IF EXISTS ygd_photodigme.aros_acos;
CREATE TABLE ygd_photodigme.aros_acos (
  id INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  aro_id INTEGER(10) NOT NULL,
  aco_id INTEGER(10) NOT NULL,
  _create CHAR(2) NOT NULL DEFAULT 0,
  _read CHAR(2) NOT NULL DEFAULT 0,
  _update CHAR(2) NOT NULL DEFAULT 0,
  _delete CHAR(2) NOT NULL DEFAULT 0,
  PRIMARY KEY  (id)
);
insert into ygd_photodigme.aros_acos(id,aro_id,aco_id,_create,_read,_update,_delete) VALUES
(1,3,1,1,1,1,1);