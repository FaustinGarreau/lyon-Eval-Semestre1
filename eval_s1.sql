create database eval_s1;

CREATE TABLE book (
    id int(10) UNSIGNED NOT NULL,
    title varchar(255) UNIQUE NOT NULL,
    author varchar(255) NOT NULL,
    slug varchar(255) UNIQUE NOT NULL,
    description text NOT NULL,
    date date NOT NULL,
    PRIMARY KEY (id)
);