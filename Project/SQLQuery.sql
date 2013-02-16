create table FP.PERSON (
	ID			integer identity(1,1),
	NAME			varchar(12) not null,
	FNAME			varchar(40) not null,
	EMAIL			varchar(60),
	PHONE_AC		char(3),
	PHONE			char(8) default(999-9999),
	PASS_WORD		varchar(20) not null,
	ROLE_ID		integer not null,
	constraint FP_PERSON_ID_PK primary key(ID)
)
go







create table FP.ROLE (
	ID			integer identity(1,1),
	NAME			varchar(12) not null,
	constraint FP_ROLE_ID_PK primary key(ID)
)
go







create table FP.CLASS (
    ID              integer identity(1,1),
    ROOM            varchar(40),
    GRADE_LEVEL_ID  integer not null,
    TERM_ID         integer null,
    MAIN_TEACHER    integer not null,
    constraint FP_CLASS_ID_PK primary key(ID)
)
go

alter table FP.CLASS
add constraint FP_CLASS_GRADE_LEVEL_ID_FK 
foreign key(GRADE_LEVEL_ID) 
references FP.GRADE(ID)

alter table FP.CLASS
add constraint FP_CLASS_TERM_ID_FK
foreign key(TERM_ID)
references FP.TERM(ID)

alter table FP.CLASS
add constraint FP_CLASS_MAIN_TEACHER_FK
foreign key(MAIN_TEACHER)
references FP.PERSON(ID)







create table FP.STUDENT (
    ID              integer identity(1,1),
	NAME			varchar(40) not null,
	FNAME			varchar(40) not null,
	EMAIL			varchar(60) null,
	PHONE_AC		char(3) null,
	PHONE			char(8) default(999-9999),
	CURRENT_CASS	integer null,
	CASE_WORKER		integer not null,
    constraint FP_STUDENT_ID_PK primary key(ID)
)
go

alter table FP.STUDENT
add constraint FP_STUDENT_CURRENT_CLASS_FK
foreign key(CURRENT_CLASS)
references FP.CLASS(ID)

alter table FP.STUDENT
add constraint FP_STUDENT_CASE_WORKER_FK
foreign key(CASE_WORKER)
references FP.PERSON(ID)







create table FP.GRADE (
    ID              integer identity(1,1),
    NAME            varchar(12) not null,
    constraint FP_GRADE_ID_PK primary key(ID)
)
go

