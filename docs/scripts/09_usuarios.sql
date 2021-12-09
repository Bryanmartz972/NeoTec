CREATE TABLE `usuarios` (
  `codigo_usuario` varchar(10) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `estado` varchar(20) NOT NULL,
  `usuarioactcod` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_estado` varchar(255) NOT NULL,
  `password_fexpirar` varchar(255) NOT NULL,
  `tipo_usuario` varchar(255) NOT NULL,
  `password_lastchange` varchar(255) NOT NULL,
  PRIMARY KEY (`codigo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci