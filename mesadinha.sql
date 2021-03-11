create database mesadinha;
use mesadinha;

create table usuario (
id int unsigned auto_increment not null primary key,
nome varchar (80) not null,
endereco varchar (150) not null,
telefone char (15) not null,
email varchar (180) not null,
senha varchar (150) not null
)engine = innodb;

create table categoria (
id int unsigned auto_increment not null primary key,
nome varchar (80) not null
)engine = innodb;

create table conta (
id int unsigned auto_increment not null primary key,
nome varchar (80) not null,
tipo varchar (45) not null,
categoria_id int unsigned not null,
foreign key(categoria_id) references categoria(id)
)engine = innodb;

create table movimentacao (
id int unsigned auto_increment not null primary key,
valor double (9,2) unsigned not null,
conta_id int unsigned not null,
foreign key (conta_id) references conta(id)
)engine = innodb;

insert into usuario(id,nome,endereco,telefone,email,senha)
values (null,'Amanda','Rua 1','(31)99999-9999','amanda@amanda','123');