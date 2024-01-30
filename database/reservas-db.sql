CREATE DATABASE IF NOT EXISTS reservas_db;
USE reservas_db;


CREATE TABLE IF NOT EXISTS habitacion (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tipo_habitacion VARCHAR(50) NOT NULL,
  num_habitacion TINYINT NOT NULL,
  descripcion TEXT
);
  
CREATE TABLE IF NOT EXISTS reserva (
  id BINARY(16) PRIMARY KEY, 
  nombre VARCHAR(60) NOT NULL,
  telefono VARCHAR(14) NOT NULL,
  email VARCHAR(60) NOT NULL,
  id_habitacion INT,
  fecha_ini DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  num_personas TINYINT NOT NULL,
  preferencias LONGTEXT NOT NULL,
  FOREIGN KEY (id_habitacion) REFERENCES habitacion(id)
);


INSERT INTO habitacion (tipo_habitacion, num_habitacion, descripcion) VALUES
('Individual', 1,'Habitación diseñada para una persona.'),
('Doble', 2,'Habitación diseñada para dos personas, con una cama matrimonial o dos camas individuales.'),
('Suite', 3,'Habitación más grande que incluye una sala de estar separada, además del área de dormitorio.'),
('Familiar', 4,'Habitación diseñada para familias o grupos, con varias camas y espacio adicional.'),
('Ejecutiva', 5,'Habitación con comodidades adicionales diseñada para viajeros de negocios.'),
('Deluxe', 6,'Habitación de lujo con comodidades y servicios adicionales.'),
('Estándar', 7,'Habitación básica con comodidades estándar, como una cama y un baño.'),
('Individual', 8,'Habitación diseñada para una persona.'),
('Doble', 9,'Habitación diseñada para dos personas, con una cama matrimonial o dos camas individuales.'),
('Suite', 10,'Habitación más grande que incluye una sala de estar separada, además del área de dormitorio.'),
('Familiar', 11,'Habitación diseñada para familias o grupos, con varias camas y espacio adicional.'),
('Ejecutiva', 12,'Habitación con comodidades adicionales diseñada para viajeros de negocios.'),
('Deluxe', 13,'Habitación de lujo con comodidades y servicios adicionales.'),
('Estándar', 14,'Habitación básica con comodidades estándar, como una cama y un baño.'),
('Individual', 15,'Habitación diseñada para una persona.');

