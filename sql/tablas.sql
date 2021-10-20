CREATE DATABASE IF NOT EXISTS 'hospital';
CREATE USER IF NOT EXISTS 'hospital'@'localhost' IDENTIFIED BY 'hospital';
GRANT ALL PRIVILEGES ON hospital.* TO 'hospital'@'localhost';
FLUSH PRIVILEGES;

USE hospital;

CREATE TABLE IF NOT EXISTS empleados (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(40) NOT NULL,
    apellidos varchar(80) NOT NULL,
    DNI varchar(9) NOT NULL UNIQUE,
    cargo tinyint(1) NOT NULL,
    _password varchar(512) NOT NULL,
    INDEX empleado_dni_index (DNI),
    INDEX empleado_nombre_apellidos_index (nombre,apellidos)
);

CREATE TABLE IF NOT EXISTS pacientes (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(40) NOT NULL,
    apellidos varchar(80) NOT NULL,
    habitacion varchar(9) NOT NULL,
    dieta tinyint(1) NOT NULL DEfAULT 0,
    estado tinyint(1) NOT NULL,
    INDEX paciente_nombre_apellidos_index (nombre,apellidos)
);

CREATE TABLE IF NOT EXISTS informes (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    
);

