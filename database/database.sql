CREATE DATABASE webdb;  
USE webdb; 

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

INSERT INTO admins
  (username, password)
VALUES
  ('admin', SHA2('admin123', 256));

CREATE TABLE usuarios (  
  id INT AUTO_INCREMENT PRIMARY KEY,  
  nombre VARCHAR(50),  
  email VARCHAR(100)  
);

INSERT INTO usuarios
  (nombre, email)
VALUES
  ('Juan Perez', 'juan@example.com'),
  ('Ana Gomez', 'ana@example.com');