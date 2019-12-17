
    CREATE TABLE book (
    -> id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    -> title VARCHAR(255) NOT NULL UNIQUE,
    -> author VARCHAR(255) NOT NULL UNIQUE,                                         -> slug VARCHAR(255) NOT NULL UNIQUE,
    -> description TEXT NOT NULL,
    -> date DATE NOT NULL,
    -> PRIMARY KEY (id));

    ALTER TABLE book DROP COLUMN author;
    ALTER TABLE book ADD author VARCHAR(255) NOT NULL;