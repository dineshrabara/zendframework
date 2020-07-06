CREATE TABLE guestbook (
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(32) NOT NULL DEFAULT 'noemail@test.com',
  comment TEXT NULL,
  created DATETIME NOT NULL
);
