SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS gym_lr;

USE gym_lr;

DROP TABLE IF EXISTS tbl_bitacora;

CREATE TABLE `tbl_bitacora` (
  `id_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `accion` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_bitacora`),
  KEY `FK_ID_ObjetosBitacora_idx` (`id_objeto`),
  KEY `FK_ID_Usuariobitacora_idx` (`id_usuario`),
  CONSTRAINT `FK_ID_ObjetosBitacora` FOREIGN KEY (`id_objeto`) REFERENCES `tbl_objetos` (`id_objetos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ID_Usuariobitacora` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;




DROP TABLE IF EXISTS tbl_clientes;

CREATE TABLE `tbl_clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `id_inscripcion` int(11) NOT NULL,
  `id_matricula` int(11) NOT NULL,
  `id_descuentos/promociones` int(11) NOT NULL,
  `alertas` varchar(65) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `idnew_table_UNIQUE` (`id_cliente`),
  KEY `FK_ID_Inscripcion_idx` (`id_inscripcion`),
  KEY `FK_ID_Matricula_idx` (`id_matricula`),
  KEY `FK_ID_Personasclientes_idx` (`id_persona`),
  KEY `FK_ID_promo/desc_idx` (`id_descuentos/promociones`),
  KEY `FK_CreadoPor:_Clientes_idx` (`creado_por:`),
  CONSTRAINT `FK_CreadoPor:_Clientes` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ID_Inscripcion` FOREIGN KEY (`id_inscripcion`) REFERENCES `tbl_inscripcion` (`id_inscripcion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ID_Matricula` FOREIGN KEY (`id_matricula`) REFERENCES `tbl_matricula` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ID_Personasclientes` FOREIGN KEY (`id_persona`) REFERENCES `tbl_personas` (`id_personas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ID_promo/desc` FOREIGN KEY (`id_descuentos/promociones`) REFERENCES `tbl_promociones_descuentos` (`id_promociones_descuentos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;




DROP TABLE IF EXISTS tbl_documento;

CREATE TABLE `tbl_documento` (
  `id_documento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_documento VALUES("1","Identidad");
INSERT INTO tbl_documento VALUES("2","RTN");
INSERT INTO tbl_documento VALUES("3","Pasaporte");



DROP TABLE IF EXISTS tbl_inscripcion;

CREATE TABLE `tbl_inscripcion` (
  `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_inscripcion` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio_inscripcion` float DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_inscripcion`),
  UNIQUE KEY `ID_Inscripcion(PK)_UNIQUE` (`id_inscripcion`),
  KEY `FK_CreadoPor:_inscripcion_idx` (`creado_por:`),
  CONSTRAINT `FK_CreadoPor:_inscripcion` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;




DROP TABLE IF EXISTS tbl_inventario;

CREATE TABLE `tbl_inventario` (
  `id_inventario` int(11) NOT NULL AUTO_INCREMENT,
  `id_tiipo_producto` int(11) DEFAULT NULL,
  `nombre_producto` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `producto_minimo` int(11) DEFAULT NULL,
  `producto_maximo` int(11) DEFAULT NULL,
  `alerta` varchar(65) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_inventario`),
  UNIQUE KEY `ID_Inventario(PK)_UNIQUE` (`id_inventario`),
  KEY `FK_ID_producto_idx` (`id_tiipo_producto`),
  CONSTRAINT `FK_ID_producto` FOREIGN KEY (`id_tiipo_producto`) REFERENCES `tbl_tipo_producto` (`id_tipo_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;




DROP TABLE IF EXISTS tbl_matricula;

CREATE TABLE `tbl_matricula` (
  `id_matricula` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_matricula` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL,
  `precio_matricula` float DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_matricula`),
  UNIQUE KEY `ID_Matricula_UNIQUE` (`id_matricula`),
  KEY `FK_CreadoPor:_matricula_idx` (`creado_por:`),
  CONSTRAINT `FK_CreadoPor:_matricula` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;




DROP TABLE IF EXISTS tbl_objetos;

CREATE TABLE `tbl_objetos` (
  `id_objetos` int(11) NOT NULL AUTO_INCREMENT,
  `objeto` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `link_objeto` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `icono` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_objetos`),
  UNIQUE KEY `ID_Objetos(PK)_UNIQUE` (`id_objetos`),
  KEY `FK_CreadoPor:_objetos_idx` (`creado_por:`),
  CONSTRAINT `fk_id_creadopor:` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO tbl_objetos VALUES("1","Dashboard","dashboard","fas fa-tachometer-alt","2020-10-21 10:10:48","2");
INSERT INTO tbl_objetos VALUES("2","Usuarios","usuarios","fas fa-users","2020-10-21 10:10:48","2");
INSERT INTO tbl_objetos VALUES("3","Clientes","clientes","fas fa-user-circle","2020-10-21 10:10:48","2");
INSERT INTO tbl_objetos VALUES("4","Stock","stock","fas fa-layer-group","2020-10-28 16:50:30","");
INSERT INTO tbl_objetos VALUES("5","Ventas","ventas","fas fa-cart-plus","2020-10-28 16:55:36","2");
INSERT INTO tbl_objetos VALUES("6","Mantenimiento","mantenimiento","fas fa-sliders-h","2020-10-28 16:55:36","2");
INSERT INTO tbl_objetos VALUES("7","Respaldo y Restauracion","respaldoyrestauracion"," fas fa-download","2020-11-21 03:11:51","");



DROP TABLE IF EXISTS tbl_parametros;

CREATE TABLE `tbl_parametros` (
  `id_parametro` int(11) NOT NULL AUTO_INCREMENT,
  `parametro` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `valor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_parametro`),
  UNIQUE KEY `ID_Parametro(PK)_UNIQUE` (`id_parametro`),
  KEY `FK_CreadoPor:_parametro_idx` (`creado_por:`),
  CONSTRAINT `FK_CreadoPor:_parametro` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO tbl_parametros VALUES("10","ADMIN_CPASS","Grupo_6s","2020-10-17 09:45:15","2");
INSERT INTO tbl_parametros VALUES("11","ADMIN_CORREO","grupo6ctrls@gmail.com","2020-10-17 09:45:15","");
INSERT INTO tbl_parametros VALUES("12","ADMIN_INTENTOS","3","2020-10-17 09:45:15","2");
INSERT INTO tbl_parametros VALUES("13","ADMIN_VIGENCIA_CORREO","24","2020-10-17 09:45:15","2");
INSERT INTO tbl_parametros VALUES("14","ADMIN_DIAS_VIGENCIA","365","2020-10-17 09:45:15","2");
INSERT INTO tbl_parametros VALUES("15","ADMIN_CPUERTO","465","2020-10-17 09:45:15","2");
INSERT INTO tbl_parametros VALUES("16","ADMIN_CHOST","smtp.gmail.com","2020-10-17 09:45:15","2");
INSERT INTO tbl_parametros VALUES("17","ADMIN_CSMTP","ssl","2020-10-17 09:45:15","2");
INSERT INTO tbl_parametros VALUES("18","ADMIN_PREGUNTAS","3","2020-10-17 09:45:15","2");



DROP TABLE IF EXISTS tbl_permisos;

CREATE TABLE `tbl_permisos` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `id_rol` int(11) NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `agregar` int(11) DEFAULT NULL,
  `eliminar` int(11) DEFAULT NULL,
  `actualizar` int(11) DEFAULT NULL,
  `consulta` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`),
  UNIQUE KEY ` ID_Permiso(PK)_UNIQUE` (`id_permiso`),
  KEY `FK_ID_ObjetoPermiso_idx` (`id_objeto`),
  KEY `FK_ID_Rolespermisos_idx` (`id_rol`),
  KEY `FK_CreadoPor:_permisos_idx` (`creado_por:`),
  CONSTRAINT `FK_CreadoPor:_permisos` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ID_ObjetoPermiso` FOREIGN KEY (`id_objeto`) REFERENCES `tbl_objetos` (`id_objetos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ID_Rolespermisos` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_permisos VALUES("1","1","1","1","1","1","1","2020-10-21 10:12:12","2");
INSERT INTO tbl_permisos VALUES("2","1","2","1","1","1","1","2020-10-22 14:14:39","2");
INSERT INTO tbl_permisos VALUES("3","1","3","1","1","1","1","2020-10-21 10:12:12","2");
INSERT INTO tbl_permisos VALUES("4","1","4","1","1","1","1","2020-10-28 16:57:50","2");
INSERT INTO tbl_permisos VALUES("5","1","5","1","1","1","1","2020-10-28 16:57:50","2");
INSERT INTO tbl_permisos VALUES("6","1","6","1","1","1","1","2020-10-28 16:57:50","2");
INSERT INTO tbl_permisos VALUES("7","1","7","1","1","1","1","2020-11-21 03:00:10","2");



DROP TABLE IF EXISTS tbl_personas;

CREATE TABLE `tbl_personas` (
  `id_personas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `apellidos` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_documento` int(11) DEFAULT NULL,
  `num_documento` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_persona` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `correo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_personas`),
  UNIQUE KEY `ID_Personas_UNIQUE` (`id_personas`),
  UNIQUE KEY `Correo_Electronico_UNIQUE` (`correo`),
  UNIQUE KEY `Num_Documento_UNIQUE` (`num_documento`),
  KEY `FK_ID_Documentos_idx` (`id_documento`),
  KEY `FK_CreadoPor:_personas_idx` (`creado_por:`),
  CONSTRAINT `FK_CreadoPor:_personas` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ID_Documentos` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documento` (`id_documento`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO tbl_personas VALUES("1","Super","Admin","1","0000000000000","","","","","","superadmin@correo.com","","");
INSERT INTO tbl_personas VALUES("14","Jesus","Zuniga","1","0801199507364","usuarios","1995-04-14","M","(504) 9996-6666","Valle de ángeles, Francisco Morazán","jesus.zuniga077@gmail.com","2020-10-17 09:46:35","");
INSERT INTO tbl_personas VALUES("135","Juan","Rosales","1","0801196887965","usuarios","1968-09-09","M","(504) 3399-8877","Valle ","jeduardo.zuniga@yahoo.com","2020-10-28 17:04:29","");



DROP TABLE IF EXISTS tbl_preguntas;

CREATE TABLE `tbl_preguntas` (
  `id_preguntas` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_preguntas`),
  UNIQUE KEY `ID_Preguntas(PK)_UNIQUE` (`id_preguntas`),
  KEY `FK_CreadoPor:_preguntas_idx` (`creado_por:`),
  CONSTRAINT `FK_CreadoPor:_preguntas` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO tbl_preguntas VALUES("6","¿Escuela a la que asistía de pequeño?","2020-10-17 09:51:26","");
INSERT INTO tbl_preguntas VALUES("7","¿Héroe favorito?","2020-10-17 09:51:26","");
INSERT INTO tbl_preguntas VALUES("8","¿Color favorito?","2020-10-17 09:51:26","");
INSERT INTO tbl_preguntas VALUES("9","¿Cuál era el nombre de tu primera mascota?","2020-10-17 09:51:26","");
INSERT INTO tbl_preguntas VALUES("10","¿Dónde fuiste de vacaciones el año pasado?","2020-10-17 09:51:26","");



DROP TABLE IF EXISTS tbl_preguntas_usuarios;

CREATE TABLE `tbl_preguntas_usuarios` (
  `id_preguntas_usuarios` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_preguntas` int(11) NOT NULL,
  `respuesta` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_preguntas_usuarios`),
  UNIQUE KEY `ID_preguntas_empleadas_UNIQUE` (`id_preguntas_usuarios`),
  KEY `FK_CreadoPor:_preg_empleadas_idx` (`creado_por:`),
  KEY `fk_id_preguntas_idx` (`id_preguntas`),
  KEY `fk_id_usuario_idx` (`id_usuario`),
  KEY `fk_id_usuariopreguntas_idx` (`id_usuario`),
  CONSTRAINT `fk_creadopor:` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`),
  CONSTRAINT `fk_id_preguntas` FOREIGN KEY (`id_preguntas`) REFERENCES `tbl_preguntas` (`id_preguntas`),
  CONSTRAINT `fk_id_usuariopreguntas` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO tbl_preguntas_usuarios VALUES("7","9","7","batman","2020-10-26 12:57:27","");
INSERT INTO tbl_preguntas_usuarios VALUES("8","9","8","negro","2020-10-26 12:57:27","");
INSERT INTO tbl_preguntas_usuarios VALUES("9","9","9","susy","2020-10-26 12:57:27","");



DROP TABLE IF EXISTS tbl_promociones_descuentos;

CREATE TABLE `tbl_promociones_descuentos` (
  `id_promociones_descuentos` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_promociones_descuentos` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `valor_promociones_descuentos` decimal(10,0) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_promociones_descuentos`),
  UNIQUE KEY `ID_Promociones/Descuentos(PK)_UNIQUE` (`id_promociones_descuentos`),
  KEY `FK_CreadoPor:_promo/desc_idx` (`creado_por:`),
  CONSTRAINT `FK_CreadoPor:_promo/desc` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;




DROP TABLE IF EXISTS tbl_roles;

CREATE TABLE `tbl_roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(15) NOT NULL DEFAULT 0,
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rol`),
  UNIQUE KEY `ID_Rol_UNIQUE` (`id_rol`),
  KEY `FK_CreadoPor:_roles_idx` (`creado_por:`),
  CONSTRAINT `FK_CreadoPor:_roles` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO tbl_roles VALUES("1","Administrador","2020-11-03 00:26:53","","1","");
INSERT INTO tbl_roles VALUES("2","Default","2020-11-22 00:24:20","","0","");
INSERT INTO tbl_roles VALUES("4","Nuevo","2020-11-22 01:52:14","","1","");
INSERT INTO tbl_roles VALUES("15","Soldado","2020-11-21 18:42:14","Soldado JR","1","");
INSERT INTO tbl_roles VALUES("16","Soldado","2020-11-21 18:42:14","Soldado JR","1","");
INSERT INTO tbl_roles VALUES("17","Secretaria","2020-11-21 18:41:57","Secretaria","1","");



DROP TABLE IF EXISTS tbl_tipo_producto;

CREATE TABLE `tbl_tipo_producto` (
  `id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_producto` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `creado_por:` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_producto`),
  UNIQUE KEY `ID_tipo_producto_UNIQUE` (`id_tipo_producto`),
  KEY `FK_CreadoPor:_producto_idx` (`creado_por:`),
  CONSTRAINT `FK_CreadoPor:_producto` FOREIGN KEY (`creado_por:`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;




DROP TABLE IF EXISTS tbl_usuarios;

CREATE TABLE `tbl_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) DEFAULT NULL,
  `usuario` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` int(11) DEFAULT 0,
  `primera_vez` int(11) DEFAULT 1,
  `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_recuperacion` datetime DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `ID_Usuario(PK)_UNIQUE` (`id_usuario`),
  UNIQUE KEY `Codigo_UNIQUE` (`token`),
  KEY `FK_ID_PersonasUsuario_idx` (`id_persona`),
  KEY `FK_ID_Rolesusuario_idx` (`id_rol`),
  CONSTRAINT `FK_ID_PersonasUsuario` FOREIGN KEY (`id_persona`) REFERENCES `tbl_personas` (`id_personas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ID_Rolesusuario` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO tbl_usuarios VALUES("2","1","SUPERADMIN","$2a$07$asxx54ahjppf45sd87a5au.1UP6zDSXc3b.CkjVjQR/OCpZlYz4hq","vistas/img/usuarios/SUPERADMIN/854.jpg","1","0","","","","2020-11-22 15:01:03","1");
INSERT INTO tbl_usuarios VALUES("9","14","JEZA","$2a$07$asxx54ahjppf45sd87a5au1/7Au8apWpZh9z1gqLj2XARrdIHFbtG","vistas/img/usuarios/JEZA/992.jpg","1","0","rVqnGdFoI5VKOq7","2020-10-18 10:09:51","2021-10-20","2020-10-27 19:01:34","1");
INSERT INTO tbl_usuarios VALUES("23","135","JUAN","$2a$07$asxx54ahjppf45sd87a5auQnRZYbiQjL1zTHFmbfwJ5YVCJWPhfSO","vistas/img/usuarios/JUAN/744.png","0","1","","","2021-10-28","","1");



DROP TABLE IF EXISTS tbl_venta;

CREATE TABLE `tbl_venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_inventario` int(11) DEFAULT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `FK_ID_Clientesfk_idx` (`id_cliente`),
  KEY `FK_ID_Inventariofk_idx` (`id_inventario`),
  KEY `FK_ID_Usuario_idx` (`id_usuario`),
  CONSTRAINT `FK_ID_ClientesFK` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ID_Inventariofk` FOREIGN KEY (`id_inventario`) REFERENCES `tbl_inventario` (`id_inventario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_ID_Usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;




SET FOREIGN_KEY_CHECKS=1;