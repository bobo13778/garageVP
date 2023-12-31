CREATE TABLE employes (
  id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  firstname VARCHAR(250) NOT NULL,
  lastname VARCHAR(250) NOT NULL,
  email VARCHAR(250) NOT NULL UNIQUE,
  password VARCHAR(60) NOT NULL,
  moderator VARCHAR(10),
  poste VARCHAR(250)
);

CREATE TABLE administrateurs (
  id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  firstname VARCHAR(250) NOT NULL,
  lastname VARCHAR(250) NOT NULL,
  email VARCHAR(250) NOT NULL UNIQUE,
  password VARCHAR(60) NOT NULL   
);

CREATE TABLE horaires (
  id INT(10) NOT NULL PRIMARY KEY,
  day VARCHAR(50) UNIQUE NOT NULL,
  morningStart TIME,
  morningEnd TIME,
  morningIsClosed VARCHAR(10),
  afternoonStart TIME,
  afternoonEnd TIME,
  afternoonIsClosed VARCHAR(10)
);

CREATE TABLE services (
  id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(250) NOT NULL,
  description TEXT NOT NULL,
  picture VARCHAR(500) NOT NULL
);

CREATE TABLE temoignages (
  id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(250) NOT NULL,
  content TEXT NOT NULL,
  grade INT(5) NOT NULL,
  toValidate VARCHAR(10) NOT NULL,
  createdAt DATETIME NOT NULL
);

CREATE TABLE messageContacts (
  id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  firstname VARCHAR(250) NOT NULL,
  lastname VARCHAR(250) NOT NULL,
  email VARCHAR(250) NOT NULL,
  phoneNumber VARCHAR(250) NOT NULL,
  message TEXT NOT NULL,
  subject VARCHAR(500),
  createdAt DATETIME NOT NULL
);

CREATE TABLE photos (
  id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  src VARCHAR(500) NOT NULL
);

CREATE TABLE vehicules (
  id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(500) NOT NULL,
  description TEXT,
  price FLOAT(8,2) NOT NULL,
  mainpictureId INT(10) NOT NULL,
  year INT(4) NOT NULL,
  mileage INT(10) NOT NULL,
  gearbox VARCHAR(250),
  color VARCHAR(250),
  doors INT(10),
  seats INT(10),
  width FLOAT(5,3),
  height FLOAT(5,3),
  length FLOAT(5,3),
  trunkVolume INT(10),
  power INT(10),
  fiscalPower INT(10),
  co2Emission INT(10),
  fuel VARCHAR(250) NOT NULL,
  FOREIGN KEY(mainpictureId) REFERENCES photos(id)
);

ALTER TABLE photos ADD vehiculeId INT(10);
ALTER TABLE photos ADD CONSTRAINT FOREIGN KEY(vehiculeId) REFERENCES vehicules(id);