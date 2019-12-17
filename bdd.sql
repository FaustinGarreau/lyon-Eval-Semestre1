CREATE DATABASE eval_s1;

USE eval_s1;

CREATE TABLE books (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL unique,
    author VARCHAR(255) NOT NULL,
    description text(800),
    date DATE NOT NULL,
    PRIMARY KEY(id)
);