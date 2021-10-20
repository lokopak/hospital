CREATE DATABASE IF NOT EXISTS hospital;
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
    userPassword varchar(512) NOT NULL,
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
    fechaRegistro date NOT NULL DEFAULT (CURRENT_DATE),
    fechaSalida date,
    INDEX paciente_nombre_apellidos_index (nombre,apellidos)
);

CREATE TABLE IF NOT EXISTS informes (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idNutricionista int(11) NOT NULL,
    idPaciente int(11) NOT NULL,
    idCelador int(11) NOT NULL,
    dienta tinyint(1) NOT NULL,
    fecha date NOT NULL DEFAULT (CURRENT_DATE),
    desayuno tinyint(1) NOT NULL,
    comida1 tinyint(1) NOT NULL,
    comida2 tinyint(1) NOT NULL,
    comida3 tinyint(1) NOT NULL,
    merienda tinyint(1) NOT NULL,
    cena1 tinyint(1) NOT NULL,
    cena2 tinyint(1) NOT NULL,
    cena3 tinyint(1) NOT NULL,
    fechaModificacion date NOT NULL,
    ultimoEditor int(11) NOT NULL,
    INDEX informes_nutricionista_index (idNutricionista),
    INDEX informes_paciente_index (idPaciente),
    INDEX informes_celador_index (idCelador)
);

