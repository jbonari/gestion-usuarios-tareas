create database if not exists actividad5;
use actividad5;

CREATE TABLE IF NOT EXISTS usuario(
                                      id int primary key auto_increment,
                                      nombre varchar(255),
                                      password varchar(255),
                                      tipo_usuario tinyint
);

CREATE TABLE IF NOT EXISTS proyecto(
                                       id int primary key auto_increment,
                                       nombre varchar(255)
);

CREATE TABLE IF NOT EXISTS tarea(
                                    id int primary key auto_increment,
                                    id_usuario int not null,
                                    id_proyecto int not null,
                                    nombre varchar(255),
                                    estado int,
                                    constraint fk_tarea_usuario foreign key (id_usuario) references usuario(id),
                                    constraint fk_tarea_proyecto foreign key(id_proyecto) references proyecto(id)
);

/*IMPORTANTE!! crear un usuario de tipo admin para gestionar*/
INSERT INTO usuario values(null,'admin','admin',0);
