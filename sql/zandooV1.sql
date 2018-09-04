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

ALTER TABLE `annonce` ADD generateur_id varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL;
ALTER TABLE `annonce` ADD urgent tinyint(1) DEFAULT NULL;
-- modifie ville utilisateur existant ---
UPDATE utilisateur set Ville = '10';
ALTER TABLE utilisateur CHANGE COLUMN ville ville_id varchar(255)
