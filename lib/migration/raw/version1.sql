SET NAMES 'UTF8';
CREATE TABLE migration_version (version INT) ENGINE = INNODB;
ALTER TABLE blog_post ADD micropost TINYINT(1) DEFAULT '0';
INSERT INTO migration_version (version) VALUES (1);
