CREATE DATABASE IF NOT EXISTS mardb;
USE mardb;

CREATE TABLE IF NOT EXISTS users (
    user_id        INT AUTO_INCREMENT PRIMARY KEY,
    username       VARCHAR(50) NOT NULL,
    email          VARCHAR(100) NOT NULL,
    password       VARCHAR(255) NOT NULL,
    CONSTRAINT uk_users_email UNIQUE (email)
);

CREATE TABLE IF NOT EXISTS recomendations (
    recomendation_id    INT AUTO_INCREMENT PRIMARY KEY,
    user_id             INT NOT NULL,
    title               VARCHAR(50) NOT NULL,
    description         TEXT NOT NULL,
    image               VARCHAR(255),
    CONSTRAINT fk_recomendations_users FOREIGN KEY (user_id) REFERENCES users(user_id)
);