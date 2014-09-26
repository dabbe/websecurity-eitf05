use eitf05;
set foreign_key_checks = 0;
drop table if exists users,payment_info;
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
