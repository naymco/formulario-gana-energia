create database if not exists form_gana_energia;

use form_gana_energia;

create table if not exists users(
    id              int(255)auto_increment not null,
    nombre          varchar(100),
    apellidos       varchar(255),
    direccion       varchar(255),
    email           varchar(255),
    cod_postal      varchar(20),
    password        varchar(255),
    CONSTRAINT pk_users PRIMARY KEY (id)
)ENGINE = InnoDb;