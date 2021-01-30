create table user
(
    id int not null auto_increment,
    name varchar(255),
    email varchar(255) unique not null,
    password varchar(255) not null,
    created_at DATETIME,
    updated_at DATETIME,

    primary key (id)
);

create table post
(
    id int not null auto_increment,
    title varchar(255) not null,
    content text,
    image varchar(255),

    primary key (id)
);