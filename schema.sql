CREATE DATABASE deals_allright
DEFAULT CHARACTER SET utf8 
DEFAULT COLLATE  utf8_general_ci;
 
USE deals_allright;

CREATE TABLE project (
id       INT AUTO_INCREMENT PRIMARY KEY,
name     CHAR(128) UNIQUE
);

CREATE TABLE task (
id       	   INT AUTO_INCREMENT PRIMARY KEY,
creation_date  DATETIME,
execution_date DATETIME,
status          INT DEFAULT 0,
name           CHAR(64) UNIQUE,
file_link      TEXT(1000),
timeline       DATETIME  
);

CREATE TABLE users (
id       	       INT AUTO_INCREMENT PRIMARY KEY,
registration_date  DATETIME,
email              CHAR(128) UNIQUE,
name               CHAR(64) UNIQUE,
pass               CHAR(64)
);
CREATE INDEX name_project ON project(name);
CREATE INDEX name_task ON task(name);
CREATE INDEX status_task ON task(status);
CREATE INDEX name_users ON users(name);
CREATE INDEX email_usersusers ON users(email);