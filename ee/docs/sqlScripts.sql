CREATE TABLE guestbook (
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(32) NOT NULL DEFAULT 'noemail@test.com',
  comment TEXT NULL,
  created DATETIME NOT NULL
);

DROP TABLE IF EXISTS users;
CREATE TABLE users (
      id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
      first_name VARCHAR(50) NOT NULL,
      last_name VARCHAR(50) NOT NULL,
      email VARCHAR(50) NOT NULL unique,
      password VARCHAR(255) NOT NULL,
      password_salt VARCHAR(255) NULL,
      created_at DATETIME NOT NULL
    );