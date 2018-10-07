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

CREATE TABLE MOTIF (id INT AUTO_INCREMENT NOT NULL, actif TINYINT(1) NOT NULL, date_creation DATE NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE SIGNALEMENT (id INT AUTO_INCREMENT NOT NULL, motif_id INT NOT NULL, annonce_id INT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(2000) NOT NULL, INDEX IDX_79B6C3FCD0EEB819 (motif_id), INDEX IDX_79B6C3FC8805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE SIGNALEMENT ADD CONSTRAINT FK_79B6C3FCD0EEB819 FOREIGN KEY (motif_id) REFERENCES MOTIF (id);
ALTER TABLE SIGNALEMENT ADD CONSTRAINT FK_79B6C3FC8805AB2F FOREIGN KEY (annonce_id) REFERENCES ANNONCE (id);
