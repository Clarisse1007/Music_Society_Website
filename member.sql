DROP SCHEMA IF EXISTS myAssignment2043;
CREATE SCHEMA myAssignment2043;         
USE myAssignment2043;


CREATE TABLE members (
	member_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	member_name VARCHAR (20) NOT NULL,
	member_password VARCHAR (20) NOT NULL,		
	member_login_status VARCHAR (2) NOT NULL
);

INSERT INTO members (member_id, member_name, member_password, member_login_status) 
VALUES ('1', 'member1', '123', 'M');
INSERT INTO members (member_id, member_name, member_password, member_login_status) 
VALUES ('2', 'admin1', '123', 'A');

