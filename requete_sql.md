# Requete SQL

## creer BDD :

```SQL
CREATE DATABASE eval_s1;

USE eval_s1;
```

## creer table :

```SQL
CREATE TABLE book (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL UNIQUE,
    author VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    date DATE NOT NULL,
    PRIMARY KEY (id)
);
```

## Bonus

```SQL
CREATE TABLE users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE category (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    category VARCHAR(255) NOT NULL UNIQUE,
    slug VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY (id)
);

ALTER TABLE book ADD category_id INT UNSIGNED NOT NULL;

ALTER TABLE book ADD CONSTRAINT fk_book_category_id FOREIGN KEY (category_id) REFERENCES category(id);

```
