/* entity tables */
CREATE TABLE course (
    course_id varchar(6) NOT NULL,
    course_name varchar(255) NOT NULL,
    credit INT(3),
    PRIMARY KEY (course_id)
);
CREATE TABLE course_ob (
    course_id varchar(6) NOT NULL,
    description varchar(1000) NOT NULL,
    course_ob_no varchar(2) NOT NULL,
    PRIMARY KEY (course_ob_no),
    FOREIGN KEY (course_id) REFERENCES course(course_id)
);
CREATE TABLE department(
	dept_id varchar(10) NOT NULL,
    dept_name varchar(50) NOT NULL,
    PRIMARY KEY (dept_id)
);
CREATE TABLE programme(
	program_id varchar(10) NOT NULL,
    program_name varchar(100) NOT NULL,
    dept_id varchar(10) NOT NULL,
    PRIMARY KEY (program_id),
    FOREIGN KEY (dept_id) REFERENCES department(dept_id)
);
CREATE TABLE programme_ob(
	program_ob_no varchar(10) NOT NULL,
	program_ob_description varchar(1000) NOT NULL,
	PRIMARY KEY (program_ob_no)
);
CREATE TABLE faculty(
	faculty_id varchar(10) NOT NULL,
	f_name varchar(20) NOT NULL,
    l_name varchar(20) NOT NULL,
	PRIMARY KEY (faculty_id)
);
CREATE TABLE student(
	std_id varchar(8) NOT NULL,
	std_name varchar(50) NOT NULL,
    reg_no varchar(20) NOT NULL,
	PRIMARY KEY (std_id)
);
CREATE TABLE exam(
	exam_id varchar(20) NOT NULL,
	course_id varchar(6) NOT NULL,
    exam_name varchar(20) NOT NULL,
    exam_date date NOT NULL,
	PRIMARY KEY (exam_id),
    FOREIGN KEY (course_id) REFERENCES course(course_id)
);
CREATE TABLE question_paper(
	que_id varchar(3) NOT NULL,
	description varchar(1000) NOT NULL,
    answer varchar(1000) NOT NULL,
    exam_id varchar(20) NOT NULL,
    UNIQUE (que_id, exam_id),
    FOREIGN KEY (exam_id) REFERENCES exam(exam_id)
);
CREATE TABLE teaches_faculty_course(
	faculty_id varchar(10) NOT NULL,
	course_id varchar(6) NOT NULL,
    academaics varchar(10) NOT NULL,
    sessions varchar(10) NOT NULL,
    CONSTRAINT teaches_faculty_course_course foreign key (course_id) references course(course_id),
    CONSTRAINT teaches_faculty_course_faculty foreign key (faculty_id) references faculty(faculty_id),
    CONSTRAINT teaches_faculty_course_unique UNIQUE (course_id, faculty_id)
);

/* relationship tables */

CREATE TABLE has_programme_programme_ob(
	program_id varchar(10) NOT NULL,
	program_ob_no varchar(10) NOT NULL,
    CONSTRAINT has_programme_programme_ob_programme FOREIGN KEY (program_id) REFERENCES programme(program_id),
    CONSTRAINT has_programme_programme_ob_program_ob_no FOREIGN KEY (program_ob_no) REFERENCES programme_ob(program_ob_no),
    CONSTRAINT has_programme_programme_ob_unique UNIQUE (program_id, program_ob_no)
);
CREATE TABLE maps_to_programme_ob_course_ob(
	course_ob_no varchar(10) NOT NULL,
	program_ob_no varchar(10) NOT NULL,
    mapping_with varchar(10) NOT NULL,
    CONSTRAINT maps_to_programme_ob_course_ob_course_ob FOREIGN KEY (course_ob_no) REFERENCES course_ob(course_ob_no),
    CONSTRAINT maps_to_programme_ob_course_ob_programme_ob FOREIGN KEY (program_ob_no) REFERENCES programme_ob(program_ob_no),
    CONSTRAINT maps_to_programme_ob_course_ob_unique UNIQUE (course_ob_no, program_ob_no)

);
CREATE TABLE register_student_course(
	course_id varchar(6) NOT NULL,
	std_id varchar(8) NOT NULL,
    academaic_year varchar(10),
    session varchar(10),
    CONSTRAINT register_student_course_course FOREIGN KEY (course_id) REFERENCES course(course_id),
    CONSTRAINT register_student_course_student FOREIGN KEY (std_id) REFERENCES student(std_id),
    CONSTRAINT register_student_course_unique UNIQUE (course_id, std_id)
);
CREATE TABLE answers(
	std_id varchar(8) NOT NULL,
    que_id varchar(3) NOT NULL,
    exam_id varchar(20) NOT NULL,
    marks varchar(3),
    CONSTRAINT answers_exam FOREIGN KEY (exam_id) REFERENCES exam(exam_id),
    CONSTRAINT answers_student FOREIGN KEY (std_id) REFERENCES student(std_id),
    CONSTRAINT answers_question_paper FOREIGN KEY (que_id) REFERENCES question_paper(que_id),
    CONSTRAINT answers_unique UNIQUE (exam_id, std_id, que_id)
);
CREATE TABLE targets(
    que_id varchar(3) NOT NULL,
    course_ob_no varchar(10) NOT NULL,
    CONSTRAINT targets_question_paper FOREIGN KEY (que_id) REFERENCES question_paper(que_id),
    CONSTRAINT targets_course_ob FOREIGN KEY (course_ob_no) REFERENCES course_ob(course_ob_no),    
    CONSTRAINT targets_unique UNIQUE (que_id, course_ob_no)
);
CREATE TABLE appears_student_exam(
	std_id varchar(8) NOT NULL,
    exam_id varchar(20) NOT NULL,
    appearing_date date NOT NULL,
    CONSTRAINT appears_student_exam_exam FOREIGN KEY (exam_id) REFERENCES exam(exam_id),
    CONSTRAINT appears_student_exam_student FOREIGN KEY (std_id) REFERENCES student(std_id),
    CONSTRAINT appears_student_exam_unique UNIQUE (exam_id, std_id)
);
CREATE TABLE has_exam_question(
	que_id varchar(3) NOT NULL,
    exam_id varchar(20) NOT NULL,
    CONSTRAINT has_exam_question_question_paper FOREIGN KEY (que_id) REFERENCES question_paper(que_id),
    CONSTRAINT has_exam_question_exam FOREIGN KEY (exam_id) REFERENCES exam(exam_id),
    CONSTRAINT has_exam_question_unique UNIQUE (que_id, exam_id)
);    