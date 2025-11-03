DELIMITER //

drop table if exists user;

create table user(
                     uuid varchar(60),
                     username varchar(64),
                     password varchar(255),
                     email varchar(255),
                     edad integer,
                     type enum('Admin', 'Premium', 'Freemium')

);

//

alter table user add constraint pk_user primary key(uuid);
alter table user add constraint uk_user_username unique (username);
alter table user add constraint uk_user_email unique(email);