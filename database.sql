CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)

-- CREATE TABLE photos (
--     id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     user_id INT NOT NULL,
--     file_name VARCHAR(50) NOT NULL,
--     image longblob NOT NULL
-- )