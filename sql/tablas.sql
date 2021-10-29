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
    fechaRegistro TIMESTAMP NOT NULL DEFAULT NOW(),
    fechaSalida TIMESTAMP,
    INDEX paciente_nombre_apellidos_index (nombre,apellidos)
);

CREATE TABLE IF NOT EXISTS informes (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idPaciente int(11) NOT NULL,
    idEmpleado int(11) NOT NULL,
    dieta tinyint(1) NOT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT NOW(),
    desayuno tinyint(1) NOT NULL,
    comida1 tinyint(1) NOT NULL,
    comida2 tinyint(1) NOT NULL,
    comida3 tinyint(1) NOT NULL,
    merienda tinyint(1) NOT NULL,
    cena1 tinyint(1) NOT NULL,
    cena2 tinyint(1) NOT NULL,
    cena3 tinyint(1) NOT NULL,
    fechaModificacion DATETIME,
    ultimoEditor int(11) NULL,
    INDEX informes_paciente_index (idPaciente),
    INDEX informes_celador_index (idEmpleado),
    CONSTRAINT fk_paciente FOREIGN KEY (idPaciente) REFERENCES pacientes(id),
    CONSTRAINT fk_empleado FOREIGN KEY (idEmpleado) REFERENCES empleados(id),
    CONSTRAINT fk_ultimo_editor FOREIGN KEY (ultimoEditor) REFERENCES empleados(id)
);

