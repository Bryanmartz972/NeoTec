CREATE TABLE `productos` (
  `codigo_producto` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(45) DEFAULT NULL,
  `descripcion_producto` varchar(300) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `cantidad_stock` int DEFAULT NULL,
  `codigo_categoria` int DEFAULT NULL,
  `uri_img` varchar(200) DEFAULT NULL,
  `codigo_tipo_producto` int DEFAULT NULL,
  PRIMARY KEY (`codigo_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci