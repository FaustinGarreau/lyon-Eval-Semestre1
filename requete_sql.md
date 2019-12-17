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
