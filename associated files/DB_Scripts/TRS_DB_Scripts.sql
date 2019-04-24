create database TRS;

use TRS;

create table role
(
RoleID int not null primary key auto_increment,
Description varchar(100) not null,
isActive tinyint(1)
);

create table gender
(
GenderID int primary key auto_increment,
Description varchar(20) not null,
isActive tinyint(1) not null
);

create table users
(
UserID int auto_increment primary key,
FK_RoleID int not null,
FirstName varchar(100) not null,
LastName varchar(100) null,
Email varchar(200) not null,
FK_GenderID int not null,
ContactNo varchar(50) null,
DOB date not null,
Password nvarchar(300) not null,
LastLoginDate date null,
FailedLoginAttempt int not null default '0',
FailedLoginDate date,
AccountVerified tinyint(1) not null default '0',
isLocked tinyint(1),
isActive tinyint(1),
foreign key(FK_RoleID) references role(RoleID),
foreign key(FK_GenderID) references gender(GenderID)

);
