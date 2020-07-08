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
ALTER TABLE users ADD role varchar(20) default "normal" AFTER id;
DROP TABLE IF EXISTS purchases; CREATE TABLE purchases (
                       id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       ledger_id integer NULL,
                       created_user_id integer NULL,
                       last_updated_user_id integer NULL,
                       purchase_date date NOT NULL,
                       total_qty integer NULL,
                       total_amount float NULL,
                       note text NULL,
                       created_at DATETIME NOT NULL,
                       updated_at DATETIME NULL
);
DROP TABLE IF EXISTS purchases_items; CREATE TABLE purchases_items (
                                                           id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                                           purchase_id integer NULL,
                                                           item_id integer NOT NULL,
                                                           item_description text NULL,
                                                           qty integer not null,
                                                           rate float not null,
                                                           total float not null
);
#Please find below table structure for purchase
/*purchases
- id integer primary key
- ledger_id int reference key from ledgers table
- created_user_id int reference key from users table
- last_updated_user_id int reference key from users table
- purchase_date date
- total_qty [sum base on child table[purchases_items] qty column]
- total_amount [sum base on child table[purchases_items] total column]
- note text optional field
- created_at datetime created time
- updated_at datetime updated time [will update every time when purchase update]

purchases_items
- id integer primary key
- purchase_id int reference from parent table purchases
- item_id int reference from items table
- item_description text and option fields if require to add remark base on items
- qty int and require fields
- rate float/double and auto fill from item master rate column [user can change]
- total float/double auto calculate qty*rate=total
 */