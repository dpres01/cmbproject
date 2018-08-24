CREATE TABLE ville 
  ( 
     id        INT auto_increment NOT NULL, 
     actif     TINYINT(1) NOT NULL, 
     code_postal VARCHAR(255) NOT NULL, 
     libelle   VARCHAR(255) NOT NULL, 
     PRIMARY KEY(id) 
  ) 
DEFAULT CHARACTER SET utf8 
COLLATE utf8_unicode_ci 
engine = innodb; 

ALTER TABLE `annonce` ADD ville_id varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL;
ALTER TABLE `annonce` ADD date_modif date DEFAULT NULL;