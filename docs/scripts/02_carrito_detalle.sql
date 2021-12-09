CREATE TABLE `carrito_detalle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo_carrito` int DEFAULT NULL,
  `codigo_producto_c` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_carrito_idx` (`codigo_carrito`),
  KEY `codigo_producto_c_idx` (`codigo_producto_c`),
  CONSTRAINT `codigo_carrito` FOREIGN KEY (`codigo_carrito`) REFERENCES `carrito` (`codigo_carrito`),
  CONSTRAINT `codigo_producto_c` FOREIGN KEY (`codigo_producto_c`) REFERENCES `productos` (`codigo_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci