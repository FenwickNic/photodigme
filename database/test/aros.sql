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
(1,null,null,null,'Free',1,12),
(2,null,null,null,'Limited',13,20),
(3,1,'Category',1,'Voyage',2,3),
(4,1,'Category',2,'Japon',4,5),
(5,1,'Category',3,'Wollongong',6,7),
(6,1,'Category',4,'Sydney',8,9),
(7,1,'Category',5,'Kakadu NP',10,11),
(8,2,'Category',6,'South Coast',14,15),
(9,2,'Category',7,'Categories',16,17),
(10,2,'Category',8,'Nature',18,19);
