create table ROLE (
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
	constraint PERSON_ID_PK primary key(ID)
)
go