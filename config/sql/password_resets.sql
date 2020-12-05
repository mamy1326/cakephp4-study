CREATE TABLE password_resets (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  email varchar(255) NOT NULL,
  selector varchar(255)  NOT NULL,
  token varchar(255) NOT NULL,
  expire datetime NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
)

alter table users modify id int(11) unsigned NOT NULL AUTO_INCREMENT;
