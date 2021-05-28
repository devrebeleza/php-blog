CREATE DATABASE blog
    DEFAULT CHARACTER SET utf8;

use blog;

create table usuarios (
    id_usuario      INT NOT NULL AUTO_INCREMENT,
    nombre          VARCHAR(25) NOT NULL UNIQUE,    
    email           VARCHAR(255) NOT NULL UNIQUE,
    password        VARCHAR(255) NOT NULL UNIQUE,
    fecha_registro  DATETIME NOT NULL,
    activo          TINYINT NOT NULL,
    PRIMARY KEY (id_usuario)
);


create table entradas(
    id_entrada  INT NOT NULL AUTO_INCREMENT,
    id_autor INT NOT NULL,
    url varchar(255) NOT NULL UNIQUE,
    titulo VARCHAR(255) not NULL UNIQUE,
    texto TEXT CHARACTER SET utf8 not NULL,
    fecha DATETIME NOT NULL,
    activa TINYINT not null,

    PRIMARY KEY (id_entrada),
    foreign KEY (id_autor) REFERENCES usuarios (id_usuario) ON UPDATE CASCADE ON DELETE RESTRICT
);

create table comentarios(
    id_comentario INT NOT NULL AUTO_INCREMENT,
    id_autor INT not null,
    id_entrada int not null,
    titulo VARCHAR(255) not NULL,
    texto TEXT CHARACTER SET utf8 not NULL,
    fecha DATETIME NOT NULL,    

    PRIMARY KEY (id_comentario),
    foreign KEY (id_autor) REFERENCES usuarios (id_usuario) ON UPDATE CASCADE ON DELETE RESTRICT,
    foreign KEY (id_entrada) REFERENCES entradas (id_entrada) ON UPDATE CASCADE ON DELETE RESTRICT
);

create table recuperacion_clave(
    id_recuperacion INT NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    url_secreta VARCHAR(255) NOT NULL,
    fecha DATETIME NOT NULL,

    PRIMARY KEY(id_recuperacion),
    foreign key (id_usuario) REFERENCES usuarios (id_usuario) ON UPDATE CASCADE ON DELETE RESTRICT
);


