CREATE DATABASE IF NOT EXISTS mardb;
USE mardb;

CREATE TABLE IF NOT EXISTS roles (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    role_name   VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS users (
    id              BIGINT AUTO_INCREMENT PRIMARY KEY,
    username        VARCHAR(50) NOT NULL,
    email           VARCHAR(100) NOT NULL,
    role_id         INT NOT NULL,
    password_hash   VARCHAR(255) NOT NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    last_login_at   TIMESTAMP NULL DEFAULT NULL,
    is_active       TINYINT(1) NOT NULL DEFAULT 1,
    CONSTRAINT uk_users_email UNIQUE (email),
    CONSTRAINT uk_users_username UNIQUE (username),
    CONSTRAINT fk_users_roles FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE IF NOT EXISTS recomendations (
    id                  BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id             BIGINT NOT NULL,
    title               VARCHAR(50) NOT NULL,
    description         TEXT NOT NULL,
    image_url           VARCHAR(255),
    created_at          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_recomendations_users FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS refresh_tokens (
    id              BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id         BIGINT NOT NULL,
    token_hash      CHAR(64) NOT NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    expires_at      TIMESTAMP NOT NULL,
    revoked_at      TIMESTAMP NULL,
    ip              VARCHAR(45) NULL,
    user_agent      VARCHAR(255) NULL,
    CONSTRAINT fk_rt_user FOREIGN KEY (user_id) REFERENCES users(id),
    INDEX idx_rt_user (user_id),
    INDEX idx_rt_valid (user_id, revoked_at, expires_at)
);

CREATE TABLE IF NOT EXISTS oauth_accounts (
    id              BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id         BIGINT NOT NULL,
    provider        VARCHAR(50) NOT NULL,
    provider_user_id     INT NOT NULL,
    access_token    VARCHAR(200) NOT NULL,
    CONSTRAINT fk_oauth_accounts_users FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS animes (
        id              BIGINT AUTO_INCREMENT PRIMARY KEY,
        mal_id          BIGINT NOT NULL,
        title           VARCHAR(255) NOT NULL,
        image_url       VARCHAR(255) NULL,
        synopsis        TEXT NULL,
        score           DECIMAL(4,2) NULL,
        episodes        INT NULL,
        created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at      TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
        CONSTRAINT uk_animes_mal_id UNIQUE (mal_id)
);

CREATE INDEX IF NOT EXISTS idx_recomendations_user_created
  ON recomendations (user_id, created_at DESC, id);

CREATE INDEX IF NOT EXISTS idx_animes_mal_id
    ON animes (mal_id);