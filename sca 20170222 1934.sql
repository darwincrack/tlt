﻿-- Script was generated by Devart dbForge Studio for MySQL, Version 6.0.128.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 22/02/2017 19:35:51
-- Server version: 5.5.5-10.1.8-MariaDB
-- Client version: 4.1

--
-- Definition for database sca
--
DROP DATABASE IF EXISTS sca;
CREATE DATABASE sca
	CHARACTER SET latin1
	COLLATE latin1_swedish_ci;

-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

-- 
-- Set default database
--
USE sca;

--
-- Definition for table migrations
--
CREATE TABLE migrations (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  migration VARCHAR(255) NOT NULL,
  batch INT(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Definition for table password_resets
--
CREATE TABLE password_resets (
  email VARCHAR(255) NOT NULL,
  token VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  INDEX password_resets_email_index (email),
  INDEX password_resets_token_index (token)
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Definition for table permissions
--
CREATE TABLE permissions (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  display_name VARCHAR(255) DEFAULT NULL,
  description VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX permissions_name_unique (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Definition for table roles
--
CREATE TABLE roles (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  display_name VARCHAR(255) DEFAULT NULL,
  description VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX roles_name_unique (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Definition for table users
--
CREATE TABLE users (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  remember_token VARCHAR(100) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX users_email_unique (email)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Definition for table permission_role
--
CREATE TABLE permission_role (
  permission_id INT(10) UNSIGNED NOT NULL,
  role_id INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (permission_id, role_id),
  CONSTRAINT permission_role_permission_id_foreign FOREIGN KEY (permission_id)
    REFERENCES permissions(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT permission_role_role_id_foreign FOREIGN KEY (role_id)
    REFERENCES roles(id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

--
-- Definition for table role_user
--
CREATE TABLE role_user (
  user_id INT(10) UNSIGNED NOT NULL,
  role_id INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (user_id, role_id),
  CONSTRAINT role_user_role_id_foreign FOREIGN KEY (role_id)
    REFERENCES roles(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT role_user_user_id_foreign FOREIGN KEY (user_id)
    REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8
COLLATE utf8_unicode_ci;

-- 
-- Dumping data for table migrations
--
INSERT INTO migrations VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_02_22_201658_entrust_setup_tables', 1);

-- 
-- Dumping data for table password_resets
--

-- Table sca.password_resets does not contain any data (it is empty)

-- 
-- Dumping data for table permissions
--
INSERT INTO permissions VALUES
(1, 'permiso', 'permiso', 'permiso', '2017-02-22 20:48:53', '2017-02-22 20:48:53');

-- 
-- Dumping data for table roles
--
INSERT INTO roles VALUES
(1, 'admin', 'admin', NULL, NULL, NULL),
(2, 'analista', 'analista', 'descripcion', '2017-02-22 20:47:29', '2017-02-22 20:47:29');

-- 
-- Dumping data for table users
--
INSERT INTO users VALUES
(1, 'Darwin Cedeno', 'erudito_good@hotmail.com', '$2y$10$7Ha53UK1VNxPOESwQ3EaVegp.1L3qUMDziejXBJbjP2QsOiGwZiRC', 'T2px4J5ifyCsQwMst6pnLHmasrZ7aMp92xhS9Dd1EUt1fVvhHh9JBfOj32DX', '2017-02-22 20:21:24', '2017-02-22 20:41:02'),
(2, 'jose', 'darwintherudito@gmail.com', '$2y$10$izqcXF.iPqfMn8SsFIph3OENdoejSM1QNVxWAfwxEMvXC4QA/xmC.', NULL, '2017-02-22 20:48:01', '2017-02-22 20:48:36');

-- 
-- Dumping data for table permission_role
--
INSERT INTO permission_role VALUES
(1, 1);

-- 
-- Dumping data for table role_user
--
INSERT INTO role_user VALUES
(1, 1),
(2, 2);

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;