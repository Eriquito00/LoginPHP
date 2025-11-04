CREATE DATABASE IF NOT EXISTS articles_db;
USE articles_db;

CREATE TABLE IF NOT EXISTS users (
    user_id        INT AUTO_INCREMENT PRIMARY KEY,
    username       VARCHAR(50) NOT NULL,
    email          VARCHAR(100) NOT NULL,
    password       VARCHAR(255) NOT NULL,
    CONSTRAINT users_email UNIQUE (email)
);

CREATE TABLE IF NOT EXISTS articles (
    article_id      INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT NOT NULL,
    title           VARCHAR(50) NOT NULL,
    extract         TEXT NOT NULL,
    img             VARCHAR(255),
    CONSTRAINT fk_articles_users FOREIGN KEY (user_id) REFERENCES users(user_id)
);