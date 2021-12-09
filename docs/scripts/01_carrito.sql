CREATE TABLE `carrito` (
  `codigo_carrito` int NOT NULL AUTO_INCREMENT,
  `codigo_usuario` varchar(10) DEFAULT NULL,
  `fechaCreado` datetime DEFAULT NULL,
  `fechaExpira` datetime DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigo_carrito`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci


