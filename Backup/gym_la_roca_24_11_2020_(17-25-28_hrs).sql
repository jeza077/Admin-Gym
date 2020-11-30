SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS gym_la_roca;

USE gym_la_roca;

DROP TABLE IF EXISTS tbl_bitacora;

CREATE TABLE `tbl_bitacora` (
  `id_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `accion` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_bitacora`),
  KEY `fk_id_objetobitacora` (`id_objeto`),
  KEY `fk_id_usuariobitacora` (`id_usuario`) USING BTREE,
  CONSTRAINT `tbl_bitacora_ibfk_1` FOREIGN KEY (`id_objeto`) REFERENCES `tbl_objetos` (`id_objeto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_bitacora_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;




DROP TABLE IF EXISTS tbl_clientes;

CREATE TABLE `tbl_clientes` (
  `id_cliente` int(11) NOT NULL,
  `id_persona` int(11) DEFAULT NULL,
  `tipo_cliente` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_inscripcion` int(11) DEFAULT NULL,
  `id_matricula` int(11) DEFAULT NULL,
  `id_descuento` int(11) DEFAULT NULL,
  `id_pagos_cliente` int(11) DEFAULT NULL,
  `fecha_de_inscripcion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  `compras` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `fk_id_personacliente` (`id_persona`) USING BTREE,
  KEY `fk_id_inscripcioncliente` (`id_inscripcion`) USING BTREE,
  KEY `fk_id_matriculacliente` (`id_matricula`) USING BTREE,
  KEY `fk_id_descuentocliente` (`id_descuento`) USING BTREE,
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  KEY `fk_id_pagos_cliente` (`id_pagos_cliente`) USING BTREE,
  CONSTRAINT `fk_id_descuento` FOREIGN KEY (`id_descuento`) REFERENCES `tbl_descuento` (`id_descuento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_inscripcion` FOREIGN KEY (`id_inscripcion`) REFERENCES `tbl_inscripcion` (`id_inscripcion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_matricula` FOREIGN KEY (`id_matricula`) REFERENCES `tbl_matricula` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_persona` FOREIGN KEY (`id_persona`) REFERENCES `tbl_personas` (`id_personas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkl_id_creado` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_clientes VALUES("1","2","ventas","1","1","2","1","2020-11-23 00:13:00","1","2020-11-23 00:13:00","0","22");



DROP TABLE IF EXISTS tbl_descuento;

CREATE TABLE `tbl_descuento` (
  `id_descuento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_descuento` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `valor_descuento` decimal(10,0) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_descuento`),
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `tbl_descuento_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_descuento VALUES("1","2x1","50","2020-11-21 17:49:59","0");
INSERT INTO tbl_descuento VALUES("2","gratis","0","2020-11-21 17:49:59","0");
INSERT INTO tbl_descuento VALUES("3","tercera edad","25","2020-11-21 17:49:59","0");



DROP TABLE IF EXISTS tbl_documento;

CREATE TABLE `tbl_documento` (
  `id_documento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_documento VALUES("1","Identidad");
INSERT INTO tbl_documento VALUES("2","RTN");
INSERT INTO tbl_documento VALUES("3","Pasaporte");



DROP TABLE IF EXISTS tbl_inscripcion;

CREATE TABLE `tbl_inscripcion` (
  `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_inscripcion` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio_inscripcion` float DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_inscripcion`),
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `tbl_inscripcion_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_inscripcion VALUES("1","mensual","300","0000-00-00 00:00:00","0");
INSERT INTO tbl_inscripcion VALUES("2","quicenal","180","0000-00-00 00:00:00","0");
INSERT INTO tbl_inscripcion VALUES("3","diaria","20","0000-00-00 00:00:00","0");



DROP TABLE IF EXISTS tbl_inventario;

CREATE TABLE `tbl_inventario` (
  `id_inventario` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_producto` int(11) DEFAULT NULL,
  `codigo` int(20) DEFAULT NULL,
  `nombre_producto` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `producto_minimo` int(11) DEFAULT NULL,
  `producto_maximo` int(11) DEFAULT NULL,
  `venta` int(45) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_inventario`),
  KEY `fk_id_tipo_producto` (`id_tipo_producto`) USING BTREE,
  CONSTRAINT `tbl_inventario_ibfk_1` FOREIGN KEY (`id_tipo_producto`) REFERENCES `tbl_tipo_producto` (`id_tipo_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_inventario VALUES("1","1","1","Proteina","","12","1000","10","30","0","2020-11-21 18:00:05");
INSERT INTO tbl_inventario VALUES("2","1","2","Gatorade","","0","25","5","30","0","2020-11-21 18:01:20");
INSERT INTO tbl_inventario VALUES("3","1","0","Banana","","5","5","7","50","3","2020-11-21 22:00:26");
INSERT INTO tbl_inventario VALUES("4","1","0","jugo","","12","5","7","50","1","2020-11-21 22:00:26");



DROP TABLE IF EXISTS tbl_matricula;

CREATE TABLE `tbl_matricula` (
  `id_matricula` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_matricula` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio_matricula` float DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_matricula`),
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `tbl_matricula_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_matricula VALUES("1","normal","50","2020-11-21 17:48:32","0");



DROP TABLE IF EXISTS tbl_objetos;

CREATE TABLE `tbl_objetos` (
  `id_objeto` int(11) NOT NULL,
  `objeto` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `link_objeto` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `icono` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_objeto`),
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `tbl_objetos_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_objetos VALUES("1","Dashboard","dashboard","fas fa-tachometer-alt","2020-11-21 18:04:51","0");
INSERT INTO tbl_objetos VALUES("2","Usuarios","usuarios","fas fa-users","2020-11-21 18:04:51","0");
INSERT INTO tbl_objetos VALUES("3","Clientes","clientes","fas fa-user-circle","2020-11-21 18:04:51","0");
INSERT INTO tbl_objetos VALUES("4","Stock","stock","fas fa-layer-group","2020-11-21 20:16:35","0");
INSERT INTO tbl_objetos VALUES("5","Ventas","ventas","fas fa-cart-plus","2020-11-21 20:16:35","0");
INSERT INTO tbl_objetos VALUES("6","Mantenimiento","mantenimiento","fas fa-sliders-h","2020-11-21 20:16:35","0");
INSERT INTO tbl_objetos VALUES("7","Respaldo y Restauracion","respaldoyrestauracion","fas fa-download","2020-11-23 00:09:38","0");
INSERT INTO tbl_objetos VALUES("8","Bitacora","bitacora","fas fa-bold","2020-11-23 20:41:09","0");



DROP TABLE IF EXISTS tbl_pagos_cliente;

CREATE TABLE `tbl_pagos_cliente` (
  `id_pagos_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `pago` float DEFAULT NULL,
  PRIMARY KEY (`id_pagos_cliente`),
  CONSTRAINT `tbl_pagos_cliente_ibfk_1` FOREIGN KEY (`id_pagos_cliente`) REFERENCES `tbl_clientes` (`id_pagos_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;




DROP TABLE IF EXISTS tbl_parametros;

CREATE TABLE `tbl_parametros` (
  `id_parametro` int(11) NOT NULL AUTO_INCREMENT,
  `parametro` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `valor` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_parametro`),
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `tbl_parametros_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_parametros VALUES("10","ADMIN_CPASS","Grupo_6s","2020-11-21 18:08:49","0");
INSERT INTO tbl_parametros VALUES("11","ADMIN_CORREO","grupo6ctrls@gmail.com","2020-11-21 18:08:49","0");
INSERT INTO tbl_parametros VALUES("12","ADMIN_INTENTOS","3","2020-11-22 00:22:20","0");
INSERT INTO tbl_parametros VALUES("13","ADMIN_VIGENCIA_CORREO","24","2020-11-22 00:22:20","0");
INSERT INTO tbl_parametros VALUES("14","ADMIN_DIAS_VIGENCIA","365","2020-11-22 00:22:20","0");
INSERT INTO tbl_parametros VALUES("15","ADMIN_CPUERTO","465","2020-11-22 00:22:20","0");
INSERT INTO tbl_parametros VALUES("16","ADMIN_CHOST","smtp.gmail.com","2020-11-22 00:22:20","0");
INSERT INTO tbl_parametros VALUES("17","ADMIN_CSMTP","ssl","2020-11-22 00:22:20","0");
INSERT INTO tbl_parametros VALUES("18","ADMIN_PREGUNTAS","3","2020-11-22 00:22:20","0");



DROP TABLE IF EXISTS tbl_permisos;

CREATE TABLE `tbl_permisos` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) DEFAULT NULL,
  `id_objeto` int(11) DEFAULT NULL,
  `agregar` int(11) DEFAULT NULL,
  `eliminar` int(11) DEFAULT NULL,
  `actualizar` int(11) DEFAULT NULL,
  `consulta` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`),
  KEY `fk_id_rol` (`id_rol`) USING BTREE,
  KEY `fk_id_objeto` (`id_objeto`) USING BTREE,
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `fk_id_objeto` FOREIGN KEY (`id_objeto`) REFERENCES `tbl_objetos` (`id_objeto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_permisos_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_permisos VALUES("1","1","1","1","1","1","1","2020-11-21 20:17:28","0");
INSERT INTO tbl_permisos VALUES("2","1","2","0","1","1","1","2020-11-21 20:17:28","0");
INSERT INTO tbl_permisos VALUES("3","1","3","1","1","1","0","2020-11-21 20:17:28","0");
INSERT INTO tbl_permisos VALUES("4","1","4","1","1","1","1","2020-11-21 20:17:28","0");
INSERT INTO tbl_permisos VALUES("5","1","5","1","1","1","1","2020-11-21 20:17:28","0");
INSERT INTO tbl_permisos VALUES("6","1","6","1","1","1","1","2020-11-21 20:17:28","0");
INSERT INTO tbl_permisos VALUES("7","1","7","1","1","1","1","2020-11-23 00:09:48","0");
INSERT INTO tbl_permisos VALUES("8","1","8","1","1","1","1","2020-11-23 20:42:05","0");



DROP TABLE IF EXISTS tbl_personas;

CREATE TABLE `tbl_personas` (
  `id_personas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `apellidos` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_documento` int(11) DEFAULT NULL,
  `num_documento` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_persona` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` char(1) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_personas`),
  KEY `fk_id_documento` (`id_documento`) USING BTREE,
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `fk_id_documento` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documento` (`id_documento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_personas_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_personas VALUES("1","Super","Admin","1","000000000","","0000-00-00","","","","superadmin@correo.com","2020-11-21 20:21:47","0");
INSERT INTO tbl_personas VALUES("2","KAREN","LAZO","1","000000000","clientes","0000-00-00","F","828737373883","brisas","karenlazo@gmail.com","2020-11-21 22:41:30","0");
INSERT INTO tbl_personas VALUES("3","JESUS","AMADOR","1","0801199989768","usuarios","1999-09-09","M","(504) 3333-3333","VALLE","jesus.zuniga077@gmail.com","2020-11-23 08:10:00","0");



DROP TABLE IF EXISTS tbl_preguntas;

CREATE TABLE `tbl_preguntas` (
  `id_preguntas` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creador_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_preguntas`),
  KEY `fk_creador_por` (`creador_por`) USING BTREE,
  CONSTRAINT `tbl_preguntas_ibfk_1` FOREIGN KEY (`creador_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_preguntas VALUES("6","¿Escuela a la que asistía de pequeño?","2020-11-21 20:26:43","0");
INSERT INTO tbl_preguntas VALUES("7","¿Héroe favorito?","2020-11-21 20:26:43","0");
INSERT INTO tbl_preguntas VALUES("8","¿Color favorito?","2020-11-21 20:26:43","0");
INSERT INTO tbl_preguntas VALUES("9","¿Cuál era el nombre de tu primera mascota?","2020-11-21 20:26:43","0");
INSERT INTO tbl_preguntas VALUES("10","¿Dónde fuiste de vacaciones el año pasado?","2020-11-21 20:26:43","0");



DROP TABLE IF EXISTS tbl_preguntas_usuarios;

CREATE TABLE `tbl_preguntas_usuarios` (
  `id_preguntas_usuarios` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_preguntas` int(11) DEFAULT NULL,
  `respuesta` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_preguntas_usuarios`),
  KEY `fk_id_usuario` (`id_usuario`) USING BTREE,
  KEY `fk_id_preguntas` (`id_preguntas`) USING BTREE,
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `fk_id_preguntas` FOREIGN KEY (`id_preguntas`) REFERENCES `tbl_preguntas` (`id_preguntas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_preguntausuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_preguntas_usuarios_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_preguntas_usuarios VALUES("1","3","8","ROJO","2020-11-23 08:20:11","0");
INSERT INTO tbl_preguntas_usuarios VALUES("2","3","7","BATMAN","2020-11-23 08:20:11","0");
INSERT INTO tbl_preguntas_usuarios VALUES("3","3","9","SUSY","2020-11-23 08:20:11","0");



DROP TABLE IF EXISTS tbl_roles;

CREATE TABLE `tbl_roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `descripcion` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` int(15) NOT NULL,
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rol`),
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `tbl_roles_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_roles VALUES("1","Administrador","2020-11-21 20:13:48","","1","0");
INSERT INTO tbl_roles VALUES("2","Default","2020-11-21 20:13:48","","0","0");
INSERT INTO tbl_roles VALUES("4","Nuevo","2020-11-23 00:00:59","","1","0");
INSERT INTO tbl_roles VALUES("17","Secretaria","2020-11-23 00:00:59","Secretaria","1","0");
INSERT INTO tbl_roles VALUES("18","Director","2020-11-23 20:43:57","Director","0","0");



DROP TABLE IF EXISTS tbl_tipo_producto;

CREATE TABLE `tbl_tipo_producto` (
  `id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_producto` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_producto`),
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `tbl_tipo_producto_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_tipo_producto VALUES("1","Productos","2020-11-21 17:51:14","0");
INSERT INTO tbl_tipo_producto VALUES("2","Bodega","2020-11-21 17:51:14","0");



DROP TABLE IF EXISTS tbl_usuarios;

CREATE TABLE `tbl_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) DEFAULT NULL,
  `usuario` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` int(11) DEFAULT 0,
  `primera_vez` int(11) DEFAULT 1,
  `token` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_recuperacion` datetime DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_id_persona` (`id_persona`) USING BTREE,
  KEY `fk_id_rol` (`id_rol`) USING BTREE,
  CONSTRAINT `fk_id_roles` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_idl_personas` FOREIGN KEY (`id_persona`) REFERENCES `tbl_personas` (`id_personas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_usuarios VALUES("1","1","SUPERADMIN","$2a$07$asxx54ahjppf45sd87a5au.1UP6zDSXc3b.CkjVjQR/OCpZlYz4hq","vistas/img/usuarios/SUPERADMIN/854.jpg","1","0","","0000-00-00 00:00:00","0000-00-00","2020-11-24 17:00:45","1");
INSERT INTO tbl_usuarios VALUES("3","3","JEZA","$2a$07$asxx54ahjppf45sd87a5auN3t3yXm6O1JtaIBD.zHOTFO6UU.UNtO","vistas/img/usuarios/JEZA/610.png","1","0","","0000-00-00 00:00:00","2021-11-23","2020-11-23 18:49:22","1");



DROP TABLE IF EXISTS tbl_venta;

CREATE TABLE `tbl_venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `numero_factura` int(11) NOT NULL,
  `productos` varchar(500) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `impuesto` float DEFAULT NULL,
  `neto` float DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_venta`),
  KEY `fk_id_cliente` (`id_cliente`) USING BTREE,
  KEY `fk_id_usuario` (`id_usuario`) USING BTREE,
  CONSTRAINT `fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_venta VALUES("6","1","1","1001","[{\"id\":\"2\",\"descripcion\":\"Gatorade\",\"cantidad\":\"2\",\"stock\":\"0\",\"precio\":\"25\",\"total\":\"50\"}]","2.5","50","53","2020-11-23 20:11:08");
INSERT INTO tbl_venta VALUES("7","1","1","1","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"1000\",\"total\":\"1000\"},{\"id\":\"3\",\"descripcion\":\"Banana\",\"cantidad\":\"1\",\"stock\":\"7\",\"precio\":\"5\",\"total\":\"5\"}]","150.75","1005","1156","2020-11-24 03:15:09");
INSERT INTO tbl_venta VALUES("8","1","1","1","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"1000\",\"total\":\"1000\"},{\"id\":\"3\",\"descripcion\":\"Banana\",\"cantidad\":\"1\",\"stock\":\"6\",\"precio\":\"5\",\"total\":\"5\"}]","60.3","1005","1065","2020-11-24 03:17:06");
INSERT INTO tbl_venta VALUES("9","1","1","1","[{\"id\":\"3\",\"descripcion\":\"Banana\",\"cantidad\":\"1\",\"stock\":\"5\",\"precio\":\"5\",\"total\":\"5\"},{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"1000\",\"total\":\"1000\"}]","50.25","1005","1055","2020-11-24 03:45:10");
INSERT INTO tbl_venta VALUES("10","1","1","2","[{\"id\":\"4\",\"descripcion\":\"jugo\",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"5\",\"total\":\"5\"}]","0.9","5","6","2020-11-24 03:47:34");
INSERT INTO tbl_venta VALUES("11","1","1","3","[{\"id\":\"4\",\"descripcion\":\"jugo\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"5\",\"total\":\"5\"}]","0.7","5","6","2020-11-24 03:48:09");



SET FOREIGN_KEY_CHECKS=1;