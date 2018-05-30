create table reminder_clients
(
  client_identifier varchar(50)     not null
    primary key,
  message_level     int default '0' not null
)
  engine = InnoDB
  charset = utf8;

create table reminder_messages
(
  id        int auto_increment
    primary key,
  message   varchar(1024) charset latin1        not null,
  timestamp timestamp default CURRENT_TIMESTAMP not null
)
  engine = InnoDB
  charset = utf8;

create table reminder_user
(
  user_id  int auto_increment
    primary key,
  username varchar(255) null,
  password varchar(255) null
)
  engine = InnoDB;


