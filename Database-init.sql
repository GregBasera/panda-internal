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
  contract_execution      date             not null,

  constraint primary key (partner_ID)
);

CREATE TABLE TRANSACTIONS (
  transaction_ID              varchar(15)      not null,
  date_encoded                datetime         DEFAULT CURRENT_TIMESTAMP,
  encoded_by                  varchar(20)      not null,
  order_number                int              not null,
  dispatched_by               varchar(20)      not null,
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

  constraint primary key (transaction_ID, order_number),
  constraint foreign key (partner_ID) REFERENCES PARTNERS (partner_ID) ON DELETE CASCADE
);

CREATE TABLE ORDERS (
  transaction_ID    varchar(15)       not null,
  item_name         varchar(80)       not null,
  quantity          int               not null,
  price             float             not null,

  constraint foreign key (transaction_ID) REFERENCES TRANSACTIONS (transaction_ID) ON DELETE CASCADE
);


INSERT INTO PARTNERS (partner_ID, partner_name, partner_address, partner_contact, partner_email, owner_name, owner_contact, owner_email, contract_percentage, contract_execution) VALUES
("pt5da6e9f413834", "resturanSIA", "sa bulsa ko", "09123456789", "resturanSIA@gmail.com", "Justin Sia", "09123456789", "owner@gmail.com", 0.30, "2019-10-16");

INSERT INTO TRANSACTIONS (transaction_ID, encoded_by, order_number, dispatched_by, transaction_date, customer_fname, customer_lname, customer_contact, delivery_address, landmark_directions, partner_ID, subtotal, delivery_charge, total_transaction_price) VALUES
("5da6e5901e167", "Gweg", 1, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 2, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 3, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 4, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 5, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 6, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 7, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 8, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 9, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 10, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 11, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 12, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 13, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 14, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 15, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 16, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 17, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 18, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 19, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 20, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 21, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 22, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 23, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 24, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 25, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 26, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 27, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 28, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 29, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 30, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 31, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 32, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 33, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 34, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 35, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 36, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 37, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 38, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 39, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 40, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 41, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 42, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 43, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 44, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 45, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 46, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 47, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 48, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 49, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655),
("5da6e5901e167", "Gweg", 50, "Gweg", "2019-10-16", "Jude", "Buelva", "09123456789", "Somewhere over the rainbow", "Look for the leprechaun he will take you there", "pt5da6e9f413834", 600, 55, 655);

INSERT INTO ORDERS (transaction_ID, item_name, quantity, price) VALUES
("5da6e5901e167", "hotsilog", 2, 200),
("5da6e5901e167", "tapsilog", 1, 200),
("5da6e5901e167", "Mei Goreng", 1, 200);

COMMIT;
