--CREATE DATABASE taskforce_67 DEFAULT CHARACTER SET UTF8 DEFAULT COLLATE UTF8_GENERAL_CI;

--USE taskforce_67;

CREATE TABLE cities
(
  id        INT AUTO_INCREMENT PRIMARY KEY,
  name      VARCHAR(255)   NOT NULL UNIQUE,
  latitude  decimal(10, 7) NOT NULL,
  longitude decimal(10, 7) NOT NULL
);

CREATE TABLE users
(
  id          INT AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(255)  NOT NULL,
  email       VARCHAR(50)   NOT NULL UNIQUE,
  password    varchar(60)   NOT NULL,
  birthday    DATETIME,
  phone       VARCHAR(20),
  rating      INT,
  telegram    VARCHAR(50),
  info        TEXT,
  is_executor BOOLEAN,
  city_id     INT           NOT NULL,
  avatar_path VARCHAR(1000) NOT NULL UNIQUE,
  create_date DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (city_id) REFERENCES cities (id)
);

CREATE TABLE categories
(
  id   INT AUTO_INCREMENT PRIMARY KEY,
  name varchar(100) NOT NULL,
  code varchar(255) NOT NULL
);


CREATE TABLE tasks
(
  id           INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title        VARCHAR(50) NOT NULL,
  description  TEXT        NOT NULL,
  category_id  INT         NOT NULL,
  status       INT         NOT NULL,
  price        INT,
  create_date  DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  due_date     DATE,
  user_id      INT         NOT NULL,
  city_id      INT         NOT NULL,
  file_id      INT,
  location     VARCHAR(100),
  FOREIGN KEY (user_id) REFERENCES users (id),
  FOREIGN KEY (category_id) REFERENCES categories (id),
  FOREIGN KEY (city_id) REFERENCES cities (id),
  FOREIGN KEY (file_id) REFERENCES files (id)
);

CREATE TABLE user_categories
(
  id          INT AUTO_INCREMENT PRIMARY KEY,
  executor_id INT NOT NULL,
  category_id INT NOT NULL,
  FOREIGN KEY (executor_id) REFERENCES users (id),
  FOREIGN KEY (category_id) REFERENCES categories (id)
);

CREATE TABLE responses
(
  id          INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
  executor_id INT  NOT NULL,
  task_id     INT  NOT NULL,
  comment     TEXT NOT NULL,
  price       INT  NOT NULL,
  FOREIGN KEY (executor_id) REFERENCES users (id),
  FOREIGN KEY (task_id) REFERENCES tasks (id)
);


CREATE TABLE files
(
  id   INT           NOT NULL AUTO_INCREMENT PRIMARY KEY,
  path VARCHAR(1000) NOT NULL UNIQUE
);

CREATE TABLE reviews
(
  id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  task_id     INT NOT NULL,
  executor_id INT NOT NULL,
  grade       INT,
  comment     TEXT,
  FOREIGN KEY (task_id) REFERENCES tasks (id),
  FOREIGN KEY (executor_id) REFERENCES users (id)
);
