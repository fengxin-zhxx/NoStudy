BEGIN;
DROP DATABASE IF EXISTS website_xixifu;
CREATE DATABASE website_xixifu;
use website_xixifu;

CREATE TABLE user(
	id int primary key auto_increment,
	register_method varchar(115),
	register_school varchar(110),
	student_id INT NOT NULL,
	student_name varchar(140),
	contact varchar(140),
	password varchar(140)
);
CREATE TABLE notice(
	id int primary key auto_increment,
	source varchar(120),
	topic varchar(150),
	date varchar(120),
	content varchar(1500)
);
CREATE TABLE checkin(
	id int primary key auto_increment,
	course varchar(120),
	teacher varchar(120),
	time varchar(120),
	endtime varchar(120)
);
CREATE TABLE checkin_record(
	id int primary key auto_increment,
	checkin_id varchar(120),
	student_id varchar(120),
	time varchar(120)
);
CREATE TABLE discuss(
	id int primary key auto_increment,
	from_teacher int,
	source varchar(120),
	topic varchar(150),
	date varchar(120),
	content varchar(1500)
);
CREATE TABLE discuss_record(
	id int primary key auto_increment,
	discuss_id int,
	source varchar(120),
	content varchar(1500)
);
CREATE TABLE exam(
	id int primary key auto_increment,
	course varchar(120),
	name varchar(150),
	date int
);
CREATE TABLE exam_record(
	id int primary key auto_increment,
	exam_id int,
	student_id int,
	date int,
	score int
);
CREATE TABLE exam_question(
	id int primary key auto_increment,
	exam_id int,
	question_id int,
	content varchar(150)
);
CREATE TABLE exam_content(
	id int primary key auto_increment,
	exam_id int,
	question_id int,
	optionX varchar(15),
	is_correct int,
	content varchar(150)
);
CREATE TABLE exam_detail(
	id int primary key auto_increment,
	record_id int,
	question_id int,
	student_option varchar(15)
);
CREATE TABLE homework(
	id int primary key auto_increment,
	course varchar(120),
	content varchar(1500)
);
CREATE TABLE homework_record(
	id int primary key auto_increment,
	homework_id int,
	student_id int,
	content varchar(12000),
	existfile int,
	filename varchar(130)
);
CREATE TABLE material(
	id int primary key auto_increment,
	course varchar(120),
	name varchar(150)
);
CREATE TABLE courses(
	id int primary key auto_increment,
	course varchar(120),
	teacher varchar(120)
);
CREATE TABLE teachers(
	id int primary key auto_increment,
	teacher_school varchar(120),
	teacher_id varchar(120),
    teacher_name varchar(120),
    password varchar(120)
);
INSERT INTO teachers (teacher_school,teacher_id,teacher_name,password) 
	VALUES ('吉林大学','21201106','胡嘉仪','hjyteacher');
INSERT INTO teachers (teacher_school,teacher_id,teacher_name,password) 
	VALUES ('吉林大学','123','刘淼','lmteacher');
INSERT INTO teachers (teacher_school,teacher_id,teacher_name,password) 
	VALUES ('北京大学','123','张三','zsteacher');
INSERT INTO teachers (teacher_school,teacher_id,teacher_name,password) 
	VALUES ('清华大学','123','李四','lsteacher');

INSERT INTO courses (teacher,course) 
	VALUES ('胡嘉仪','爱情心理学');
INSERT INTO courses (teacher,course) 
	VALUES ('胡嘉仪','气人必修课');
INSERT INTO courses (teacher,course) 
	VALUES ('刘淼','web程序设计');
INSERT INTO courses (teacher,course) 
	VALUES ('刘淼','ACM程序设计竞赛');
    


COMMIT;