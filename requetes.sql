
CREATE DATABASE eval_s1;

USE eval_s1;



CREATE TABLE book (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(80) NOT NULL,
    author VARCHAR(80) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    creation_date DATE NOT NULL,
    CONSTRAINT uq_book_title_author UNIQUE(title, author)
);

ALTER TABLE book
Change creation_date date DATE;

/*Finallement j'ai enlever la contrainte*/

ALTER TABLE book DROP INDEX uq_book_title_author;

CREATE TABLE user (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(80) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE category (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(80) NOT NULL UNIQUE,
    color VARCHAR(80) NOT NULL
);

ALTER TABLE book ADD category_id INT UNSIGNED NOT NULL;
ALTER TABLE book ADD CONSTRAINT FK_user_id_category_id FOREIGN KEY (category_id) REFERENCES category(id);
