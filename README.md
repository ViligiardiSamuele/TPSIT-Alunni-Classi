# Docker

- `docker run --rm --name myPhp -v ${PWD}:/var/www/html -p 8080:80 benvenuti/php-composer:1.1`

- `docker kill myPhp`

- `docker exec myPhp composer update`

# MySQL

```
drop database if exists test;
create database test;
use test;

create table Alunni(
	id int auto_increment not null,
	nome varchar(20) not null,
	cognome varchar(20) not null,
	eta int not null,
	primary key (id)
);
```