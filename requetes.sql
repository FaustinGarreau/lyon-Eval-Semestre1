
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
