use eitf05;
set foreign_key_checks = 0;
drop table if exists users,payment_info,products;
set foreign_key_checks = 1;

create table users(
email varchar(100),
password varchar(40),
primary key(email)
);

create table payment_info(
email varchar(100),
credit_card_number varchar(16),
credit_carc_cvc varchar(3),
credit_card_expiration date,
primary key(email),
foreign key(email) references users(email)
);

create table products(
product_id integer auto_increment,
product_name varchar(100),
product_image_path varchar(200),
product_cost integer default 100,
primary key(product_id)
);


insert into users(email,password) values ('test@test.se','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');
insert into users(email,password) values ('snurre@spratt.se','9528dde7c71e2e013ebd6028faefca86b22cae6f');
insert into users(email,password) values ('kalle@anka.nu','41ed375f1f14d77653036030a271be2faed91daf');

