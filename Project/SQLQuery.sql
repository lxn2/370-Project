create table PERSON (
	ID			integer identity(1,1),
	NAME			varchar(12) not null,
	FNAME			varchar(40) not null,
	EMAIL			varchar(60),
	PHONE_AC		char(3),
	PHONE			char(8) default(999-9999),
	PASS_WORD		varchar(20) not null,
	ROLE_ID		integer not null,
	constraint PERSON_ID_PK primary key(ID)
)
go

create table ROLE (
	ID			integer identity(1,1),
	NAME			varchar(12) not null,
	constraint ROLE_ID_PK primary key(ID)
)
go

class table CLASS (
    ID              integer identity(1,1),
    ROOM            varchar(40),
    GRADE_LEVEL_ID  integer not null,
    TERM_ID         integer null,
    MAIN_TEACHER    integer not null,
    constraint CLASS_GRADE_LEVEL_ID_FK foreign key(GRADE_LEVEL_ID) references Grade(ID)
)
go