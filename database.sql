CREATE DATABASE eval_s1;
USE eval_s1;
CREATE TABLE book (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    `date` DATE NOT NULL,
    PRIMARY KEY(id),
    CONSTRAINT uq_book UNIQUE(title, author)
);
ALTER TABLE book DROP INDEX uq_book;
CREATE TABLE user (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);
