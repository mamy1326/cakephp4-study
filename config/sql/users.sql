CREATE TABLE users (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  created  datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO users
  (id, username, password, email, created, modified)
VALUES
  (1, 'member', '$2y$10$chRR/dnRQgyJ4gVlscsIc.aiDsFs1QUT/.AiCfPf.Rru5LixtAfP6', 'mamy1326@gmail.com', NOW(), NOW());