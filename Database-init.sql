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
  date_encoded                date             not null,
  transaction_date            date             not null,
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

COMMIT;
