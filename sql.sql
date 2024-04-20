drop table if exists ejemplar;
drop table if exists libro;
drop table if exists editorial;
drop table if exists autor;

create table editorial(
    editorial_id int not null auto_increment,
    nombre varchar(500) not null,
    primary key(editorial_id)
);

create table autor(
    autor_id int not null auto_increment,
    nombre varchar(500) not null,
    primary key(autor_id)
);

/*
create table parametro(
    parametro_id int not null auto_increment,
    nombre varchar(500) not null,
    tipo enum('AUTOR', 'EDITORIAL', 'COLOR') NOT NULL,
    primary key(parametro_id)
);*/

create table libro(
    libro_id int not null auto_increment,
    titulo varchar(500) not null,
    isbn varchar(50) not null,
    editorial_id int not null,
    paginas varchar(100) not null,
    autor_id int not null,
    primary key(libro_id)
);

create table ejemplar(
    ejemplar_id int not null auto_increment,
    localizacion varchar(500) not null,
    libro_id int not null,
    primary key(ejemplar_id)
);

alter table libro add constraint fk_editorial_id foreign key (editorial_id)
references editorial(editorial_id);

alter table libro add constraint fk_autor_id foreign key (autor_id)
references autor(autor_id);

alter table ejemplar add constraint fk_libro_id foreign key (libro_id)
references libro(libro_id);

