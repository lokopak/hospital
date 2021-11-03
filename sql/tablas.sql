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
    dieta varchar(100),
    estado tinyint(1) NOT NULL,
    fechaNacimiento DATE NOT NULL,
    fechaRegistro TIMESTAMP NOT NULL DEFAULT NOW(),
    fechaSalida TIMESTAMP NULL,
    INDEX paciente_nombre_apellidos_index (nombre,apellidos)
);

CREATE TABLE IF NOT EXISTS informes (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idPaciente int(11) NOT NULL,
    idEmpleado int(11) NOT NULL,
    dieta varchar(100),
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

INSERT INTO `empleados` (`nombre`, `apellidos`, `DNI`, `cargo`, `userPassword`) VALUES
('Pepe', 'García Pérez', '12345678A', 1, ''),
('Frigiddo', 'Faldoib Meldid', '12345678D', 2, ''),
('Judds', 'Maldif Fldud', '12345676A', 3, ''),
('Meiekdy', 'Musodo Ldkdfifie', '12345656P', 2, ''),
('Refokri', 'Grudifu Flaldif', '23456734F', 4, ''),
('Celador', 'Celador Celador', '11111111A', 2, '$2y$10$6gDeoTYH17tXarMajmulue9s/TLTWi0CpZ3QQSZn3hWCKXv62/2py'),
('Nutricionista', 'Nutricionista Nutricionista', '22222222B', 3, '$2y$10$aT1YxkHAynB0HB4VZWqedOU1x1zgJ418r7hKDKXlCXnw4aWGVfRXu'),
('Administrador', 'Administrador Administrador', '33333333C', 4, '$2y$10$qUJYRH5FBIXXYkbNMY6xAejY6qmpVNuZb7tMsVXsiiBMZjtcCGgEK'),
('No Empleado', 'No Empleado O Despedido', '44444444D', 0, '$2y$10$vyEuV5G4D7hw9kt0LaPIzOBPjWoF4BlZF2FZ9AoVvLWrtx1HCv0Wu');

INSERT INTO `pacientes` (`nombre`, `apellidos`, `habitacion`, `dieta`, `estado`, `fechaNacimiento`, `fechaRegistro`, `fechaSalida`) VALUES
('Dradin', 'Faraic Chidlc', '23', 'absoluta', 2, '1988-12-01', '2021-11-03 09:03:00', NULL),
('Vladri', 'Frudig Gradig', '24', 'baja_en_potasio', 3, '1974-03-11', '2021-11-03 09:09:45', NULL),
('Agrdic', 'Nutric Bludy', '22', 'diabetica@sin_sal@cal2000', 3, '1999-05-22', '2021-11-03 09:14:23', NULL),
('Hidjfe', 'Jirdi Bldrid', '12', 'absoluta', 4, '0000-00-00', '2001-11-03 09:45:02', NULL),
('Kldird', 'Nindir Girld', '13', 'liquida@sin_sal@liquida', 4, '1992-06-15', '2021-11-03 09:47:09', NULL);


INSERT INTO `informes` (`idPaciente`, `idEmpleado`, `dieta`, `fecha`, `desayuno`, `comida1`, `comida2`, `comida3`, `merienda`, `cena1`, `cena2`, `cena3`, `fechaModificacion`, `ultimoEditor`) VALUES
(1, 1, 'absoluta', '2021-11-03 09:51:25', 1, 2, 2, 3, 3, 2, 2, 2, NULL, NULL),
(2, 1, 'baja_en_potasio', '2021-11-03 09:51:56', 4, 4, 4, 4, 4, 4, 4, 4, '2021-11-03 10:52:04', 1),
(3, 1, 'diabetica@sin_sal@cal2000', '2021-11-03 10:16:35', 3, 2, 2, 2, 2, 3, 3, 3, NULL, NULL),
(4, 1, 'absoluta', '2021-11-03 10:19:08', 0, 1, 1, 2, 0, 3, 3, 3, NULL, NULL),
(5, 1, 'liquida@sin_sal@liquida', '2021-11-03 10:19:26', 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL);