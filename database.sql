CREATE DATABASE User_Data;

USE User_Data;

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

desc users;

INSERT INTO users (first_name, last_name, username, password) VALUES
("John", "Nguyen", "njohn", "john1"),
("Maia", "Nguyen", "nmaia", "maia1")

SELECT * FROM users;


CREATE TABLE photos (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    file_name VARCHAR(50) NOT NULL,
    photo_type VARCHAR(50) NOT NULL
    -- image longblob NOT NULL
);

desc photos;

INSERT INTO photos (user_id, file_name, photo_type) VALUES
(8, "good_job.png", "background"),
(8, "good_job.png", "collage")

SELECT * FROM photos;