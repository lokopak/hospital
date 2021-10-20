CREATE DATABASE IF NOT EXISTS 'hospital';
CREATE USER IF NOT EXISTS 'hospital'@'localhost' IDENTIFIED BY 'hospital';
GRANT ALL PRIVILEGES ON hospital.* TO 'hospital'@'localhost';