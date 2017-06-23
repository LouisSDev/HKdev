CREATE TABLE effector
(
id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
effectorType INT(11) NOT NULL,
name VARCHAR(40),
room INT(11),
state TINYINT(4) NOT NULL,
auto TINYINT(4) NOT NULL,
value FLOAT DEFAULT '0',
CONSTRAINT effector_to_room FOREIGN KEY (room) REFERENCES room (id)
);
CREATE INDEX effectorType ON effector (effectorType);
CREATE INDEX effector_to_room ON effector (room);
CREATE TABLE effectortype
(
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(40) NOT NULL,
  ref VARCHAR(10) NOT NULL,
  chart TINYINT(1) DEFAULT '1',
  type VARCHAR(35) DEFAULT 'Chauffage',
  minVal FLOAT,
  maxVal FLOAT,
  selling TINYINT(1) DEFAULT '1'
);
CREATE TABLE home
(
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(40) NOT NULL,
  address VARCHAR(80),
  user INT(11) NOT NULL,
  building INT(11),
  city VARCHAR(40),
  country VARCHAR(30),
  hasHomes TINYINT(1) DEFAULT '0',
  CONSTRAINT home_owner FOREIGN KEY (user) REFERENCES user (id),
  CONSTRAINT home_to_building FOREIGN KEY (building) REFERENCES home (id)
);
CREATE INDEX home_owner ON home (user);
CREATE INDEX home_to_building ON home (building);
CREATE TABLE room
(
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(40) NOT NULL,
  home INT(11) NOT NULL,
  type VARCHAR(30) NOT NULL,
  CONSTRAINT room_to_home FOREIGN KEY (home) REFERENCES home (id)
);
CREATE INDEX room_to_home ON room (home);
CREATE TABLE sensor
(
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  sensorType INT(11) NOT NULL,
  room INT(11)
);
CREATE INDEX sensor_to_ ON sensor (sensorType);
CREATE INDEX sensor_to_room ON sensor (room);
CREATE TABLE sensortype
(
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(40) NOT NULL,
  ref VARCHAR(10) NOT NULL,
  chart TINYINT(4) NOT NULL,
  type VARCHAR(30) NOT NULL,
  price FLOAT DEFAULT '0',
  minVal FLOAT,
  maxVal FLOAT,
  selling TINYINT(1) DEFAULT '1'
);
CREATE TABLE sensorvalue
(
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  sensor INT(11) NOT NULL,
  value FLOAT NOT NULL,
  datetime DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
  state TINYINT(4) NOT NULL
);
CREATE TABLE user
(
  id INT(11) NOT NULL AUTO_INCREMENT,
  firstName VARCHAR(50),
  lastName VARCHAR(60),
  mail VARCHAR(60),
  cellPhoneNumber VARCHAR(20),
  address VARCHAR(100),
  country VARCHAR(30),
  password VARCHAR(70) NOT NULL,
  admin TINYINT(4) DEFAULT '0' NOT NULL,
  city VARCHAR(40) NOT NULL,
  validated TINYINT(4) DEFAULT '0' NOT NULL,
  quoteFilePath VARCHAR(100) NOT NULL,
  quoteTreated TINYINT(4) DEFAULT '2'
);
CREATE INDEX id ON user (id);
CREATE UNIQUE INDEX mail ON user (mail);


INSERT INTO user (
  firstName,
  lastName,
  mail,
  cellPhoneNumber,
  address,
  country,
  password,
  admin,
  city,
  validated,
  quoteFilePath,
  quoteTreated
)

VALUES (
  'CompteAdmin',
  'Test',
  'admin@homekeeper.fr',
  NULL,
  '14 rue de Vanves',
  'France',
  '469e6a43dbe93ab90e5487bdbf5c61acd6679614',
  1,
  'Paris',
  1,
  NULL,
  1
);