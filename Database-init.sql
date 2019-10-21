CREATE DATABASE IF NOT EXISTS pandalivery;

use pandalivery;

CREATE TABLE PARTNERS (
  partner_ID              varchar(15)      not null,
  partner_name            varchar(80)      not null,
  partner_address         text             not null,
  partner_contact         varchar(15)      not null,
  partner_email           varchar(50)      not null,
  owner_name              varchar(50)      not null,
  owner_contact           varchar(15)      not null,
  owner_email             varchar(50)      not null,
  contract_percentage     float            not null,

  constraint primary key (partner_ID)
);

CREATE TABLE TRANSACTIONS (
  transaction_ID              varchar(15)      not null,
  date_encoded                datetime         DEFAULT CURRENT_TIMESTAMP,
  order_number                int              not null,
  encoded_by                  varchar(20)      not null,
  transaction_date            datetime         not null,
  customer_fname              varchar(25)      not null,
  customer_lname              varchar(25)      not null,
  customer_contact            varchar(15)      not null,
  delivery_address            text             not null,
  landmark_directions         text,
  partner_ID                  varchar(15)      not null,
  subtotal                    float            not null,
  delivery_charge             float            not null,
  total_transaction_price     float            not null,

  constraint primary key (transaction_ID),
  constraint foreign key (partner_ID) REFERENCES PARTNERS (partner_ID)
);

CREATE TABLE ORDERS (
  transaction_ID    varchar(15)       not null,
  item_name         varchar(80)       not null,
  quantity          int               not null,
  price             float             not null,

  constraint foreign key (transaction_ID) REFERENCES TRANSACTIONS (transaction_ID)
);


INSERT INTO PARTNERS (partner_ID, partner_name, partner_address, partner_contact, partner_email, owner_name, owner_contact, owner_email, contract_percentage) VALUES
("pt5da6e9f413834", "resturanSIA", "sa bulsa ko", "09123456789", "resturanSIA@gmail.com", "Justin Sia", "09123456789", "owner@gmail.com", 30);

INSERT INTO TRANSACTIONS (transaction_ID, order_number, encoded_by, transaction_date, customer_fname, customer_lname, customer_contact, delivery_address, landmark_directions, partner_ID, subtotal, delivery_charge, total_transaction_price) VALUES
("5da6e5901e167", 1, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655);

INSERT INTO ORDERS (transaction_ID, item_name, quantity, price) VALUES
("5da6e5901e167", "hotsilog", 2, 200),
("5da6e5901e167", "tapsilog", 1, 200),
("5da6e5901e167", "Mei Goreng", 1, 200);

COMMIT;