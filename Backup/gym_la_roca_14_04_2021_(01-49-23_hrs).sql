SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS gym_la_roca;

USE gym_la_roca;

DROP TABLE IF EXISTS tbl_bitacora;

CREATE TABLE `tbl_bitacora` (
  `id_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `accion` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id_bitacora`),
  KEY `id_usuariobitacora` (`id_usuario`) USING BTREE,
  KEY `id_objetobitacora` (`id_objeto`) USING BTREE,
  CONSTRAINT `tbl_bitacorausuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_objetobitacora` FOREIGN KEY (`id_objeto`) REFERENCES `tbl_objetos` (`id_objeto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=659 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_bitacora VALUES("1","2021-04-12 10:34:51","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("2","2021-04-12 10:34:51","1","3","Actualizar","SUPERADMIN actualizó un cliente de gimnasio llamado LUIS");
INSERT INTO tbl_bitacora VALUES("3","2021-04-12 10:34:53","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("4","2021-04-12 10:36:32","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("5","2021-04-12 10:36:37","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("6","2021-04-12 10:36:37","1","3","Actualizar","SUPERADMIN actualizó el cliente de gimnasio llamado CLIENTE ");
INSERT INTO tbl_bitacora VALUES("7","2021-04-12 10:36:39","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("8","2021-04-12 10:36:47","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("9","2021-04-12 10:36:47","1","3","Actualizar","SUPERADMIN actualizó el cliente de ventas llamado OTTO");
INSERT INTO tbl_bitacora VALUES("10","2021-04-12 10:36:49","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("11","2021-04-12 10:37:38","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("12","2021-04-12 10:37:38","1","3","Actualizar","SUPERADMIN actualizó el cliente de gimnasio llamado NUEVO");
INSERT INTO tbl_bitacora VALUES("13","2021-04-12 10:37:40","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("14","2021-04-12 11:29:17","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("15","2021-04-12 11:29:23","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("16","2021-04-12 11:29:37","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("17","2021-04-12 11:29:48","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("18","2021-04-12 11:29:58","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("19","2021-04-12 11:31:42","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("20","2021-04-12 11:32:01","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("21","2021-04-12 11:32:15","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("22","2021-04-12 11:34:07","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("23","2021-04-12 11:34:23","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("24","2021-04-12 11:34:30","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("25","2021-04-12 11:45:05","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("26","2021-04-12 11:45:11","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("27","2021-04-12 11:45:22","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("28","2021-04-12 11:45:22","1","21","Actualizar","SUPERADMIN cambió el pago de inscripcion al usuario ");
INSERT INTO tbl_bitacora VALUES("29","2021-04-12 11:45:23","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("30","2021-04-12 11:48:06","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("31","2021-04-12 11:48:14","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("32","2021-04-12 11:48:14","1","21","Actualizar","SUPERADMIN cambió el pago de inscripcion al usuario ");
INSERT INTO tbl_bitacora VALUES("33","2021-04-12 11:48:15","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("34","2021-04-12 11:49:03","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("35","2021-04-12 11:49:12","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("36","2021-04-12 11:49:12","1","21","Actualizar","SUPERADMIN cambió el pago de inscripcion al usuario ");
INSERT INTO tbl_bitacora VALUES("37","2021-04-12 11:49:14","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("38","2021-04-12 11:53:44","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("39","2021-04-12 11:53:51","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("40","2021-04-12 11:53:51","1","21","Actualizar","SUPERADMIN cambió el pago de inscripcion al usuario PRUEBA");
INSERT INTO tbl_bitacora VALUES("41","2021-04-12 11:53:52","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("42","2021-04-12 11:54:37","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("43","2021-04-12 11:54:38","1","21","Actualizar","SUPERADMIN cambió el pago de inscripcion al usuario ");
INSERT INTO tbl_bitacora VALUES("44","2021-04-12 11:54:39","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("45","2021-04-12 12:01:15","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("46","2021-04-12 12:01:22","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("47","2021-04-12 12:01:22","1","21","Actualizar","SUPERADMIN cambió el pago de inscripcion al usuario LUIS");
INSERT INTO tbl_bitacora VALUES("48","2021-04-12 12:01:23","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("49","2021-04-12 12:07:11","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("50","2021-04-12 12:07:18","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("51","2021-04-12 12:07:18","1","21","Actualizar","SUPERADMIN cambió el pago de inscripcion al usuario LUIS");
INSERT INTO tbl_bitacora VALUES("52","2021-04-12 12:07:19","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("53","2021-04-12 12:07:49","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("54","2021-04-12 12:07:49","1","21","Actualizar","SUPERADMIN cambió el pago de inscripcion al usuario PRUEBA");
INSERT INTO tbl_bitacora VALUES("55","2021-04-12 12:07:50","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("56","2021-04-12 12:11:38","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("57","2021-04-12 12:11:39","1","21","Actualizar","SUPERADMIN cambió el pago de inscripcion al usuario LUIS");
INSERT INTO tbl_bitacora VALUES("58","2021-04-12 12:11:47","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("59","2021-04-12 12:12:12","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("60","2021-04-12 12:12:19","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("61","2021-04-12 12:12:19","1","21","Actualizar","SUPERADMIN Cambió el pago de inscripcion al usuario LUIS");
INSERT INTO tbl_bitacora VALUES("62","2021-04-12 12:12:21","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("63","2021-04-12 12:24:48","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("64","2021-04-12 12:24:57","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("65","2021-04-12 12:24:57","1","21","Nuevo","SUPERADMIN Creó una nueva inscripcion ");
INSERT INTO tbl_bitacora VALUES("66","2021-04-12 12:24:59","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("67","2021-04-12 12:27:07","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("68","2021-04-12 12:27:20","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("69","2021-04-12 12:27:20","1","21","Nuevo","SUPERADMIN Creó una nueva inscripción ");
INSERT INTO tbl_bitacora VALUES("70","2021-04-12 12:27:21","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("71","2021-04-12 13:17:40","1","4","consulta"," Consulto la pantalla de Compras");
INSERT INTO tbl_bitacora VALUES("72","2021-04-12 13:17:58","1","4","consulta"," Consulto la pantalla de Compras");
INSERT INTO tbl_bitacora VALUES("73","2021-04-12 13:17:58","1","4","Nuevo","SUPERADMIN Creó un nuevo producto");
INSERT INTO tbl_bitacora VALUES("74","2021-04-12 13:18:00","1","4","consulta"," Consulto la pantalla de Compras");
INSERT INTO tbl_bitacora VALUES("75","2021-04-12 13:20:43","1","4","consulta"," Consulto la pantalla de Compras");
INSERT INTO tbl_bitacora VALUES("76","2021-04-12 13:20:55","1","4","consulta"," Consulto la pantalla de Compras");
INSERT INTO tbl_bitacora VALUES("77","2021-04-12 13:20:55","1","9","Nuevo","SUPERADMIN Realizó una nueva compra ");
INSERT INTO tbl_bitacora VALUES("78","2021-04-12 13:20:56","1","4","consulta"," Consulto la pantalla de Compras");
INSERT INTO tbl_bitacora VALUES("79","2021-04-12 13:48:15","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("80","2021-04-12 13:50:13","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("81","2021-04-12 13:50:29","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("82","2021-04-12 13:54:12","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("83","2021-04-12 13:54:20","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("84","2021-04-12 23:09:41","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("85","2021-04-12 23:15:49","1","26","Generar","SUPERADMIN Generó reporte pdf de bitacora");
INSERT INTO tbl_bitacora VALUES("86","2021-04-12 23:18:18","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("87","2021-04-12 23:19:23","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("88","2021-04-12 23:19:27","1","6","Generar","SUPERADMIN Generó reporte pdf de clientes inscripciones histórico");
INSERT INTO tbl_bitacora VALUES("89","2021-04-12 23:20:58","1","5","Generar","SUPERADMIN Generó reporte pdf de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("90","2021-04-12 23:23:16","1","7","Consulta","SUPERADMIN Consultó la pantalla de clientes pagos histórico");
INSERT INTO tbl_bitacora VALUES("91","2021-04-12 23:23:19","1","5","Generar","SUPERADMIN Generó reporte pdf de clientes pagos histórico");
INSERT INTO tbl_bitacora VALUES("92","2021-04-12 23:26:16","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("93","2021-04-12 23:26:20","1","3","Generar","SUPERADMIN Generó reporte pdf de clientes");
INSERT INTO tbl_bitacora VALUES("94","2021-04-12 23:26:56","1","3","Generar","SUPERADMIN Generó reporte pdf de administrar clientes");
INSERT INTO tbl_bitacora VALUES("95","2021-04-12 23:30:45","1","4","consulta"," Consulto la pantalla de Compras");
INSERT INTO tbl_bitacora VALUES("96","2021-04-12 23:30:50","1","9","Generar","SUPERADMIN Generó reporte pdf de compras");
INSERT INTO tbl_bitacora VALUES("97","2021-04-12 23:33:39","1","16","Consulta","SUPERADMIN Consultó la pantalla de reporte de ventas");
INSERT INTO tbl_bitacora VALUES("98","2021-04-12 23:33:47","1","10","Consulta","SUPERADMIN Consultó la pantalla de inventario");
INSERT INTO tbl_bitacora VALUES("99","2021-04-12 23:34:02","1","6","consulta"," Consulto la pantalla de Descuento");
INSERT INTO tbl_bitacora VALUES("100","2021-04-12 23:34:02","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("101","2021-04-12 23:34:24","1","6","consulta"," Consulto la pantalla de Descuento");
INSERT INTO tbl_bitacora VALUES("102","2021-04-12 23:34:24","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("103","2021-04-12 23:34:26","1","23","Generar","SUPERADMIN Generó reporte pdf de descuentos");
INSERT INTO tbl_bitacora VALUES("104","2021-04-12 23:34:59","1","23","Generar","SUPERADMIN Generó reporte pdf de descuentos");
INSERT INTO tbl_bitacora VALUES("105","2021-04-12 23:35:26","1","6","consulta"," Consulto la pantalla de Descuento");
INSERT INTO tbl_bitacora VALUES("106","2021-04-12 23:35:26","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("107","2021-04-12 23:35:31","1","6","consulta"," Consulto la pantalla de Descuento");
INSERT INTO tbl_bitacora VALUES("108","2021-04-12 23:35:31","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("109","2021-04-12 23:36:58","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("110","2021-04-12 23:38:33","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("111","2021-04-12 23:39:07","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("112","2021-04-12 23:39:07","1","5","Nueva","Nueva venta");
INSERT INTO tbl_bitacora VALUES("113","2021-04-12 23:39:37","1","4","consulta"," Consulto la pantalla de Compras");
INSERT INTO tbl_bitacora VALUES("114","2021-04-12 23:39:50","1","4","consulta"," Consulto la pantalla de Compras");
INSERT INTO tbl_bitacora VALUES("115","2021-04-12 23:39:50","1","9","Nuevo","SUPERADMIN Realizó una nueva compra ");
INSERT INTO tbl_bitacora VALUES("116","2021-04-12 23:39:52","1","4","consulta"," Consulto la pantalla de Compras");
INSERT INTO tbl_bitacora VALUES("117","2021-04-12 23:41:29","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("118","2021-04-12 23:41:42","1","5","Generar","SUPERADMIN Generó reporte pdf de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("119","2021-04-12 23:42:40","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("120","2021-04-12 23:42:54","1","6","consulta"," Consulto la pantalla deInscripcion");
INSERT INTO tbl_bitacora VALUES("121","2021-04-12 23:45:00","1","10","Consulta","SUPERADMIN Consultó la pantalla de inventario");
INSERT INTO tbl_bitacora VALUES("122","2021-04-12 23:45:59","1","5","Generar","SUPERADMIN Generó reporte pdf de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("123","2021-04-12 23:47:19","1","5","Generar","SUPERADMIN Generó reporte pdf de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("124","2021-04-12 23:48:06","1","10","Generar","SUPERADMIN Generó reporte pdf de inventario");
INSERT INTO tbl_bitacora VALUES("125","2021-04-12 23:49:14","1","6","consulta"," Consulto la pantalla de Matricula");
INSERT INTO tbl_bitacora VALUES("126","2021-04-12 23:50:09","1","6","consulta"," Consulto la pantalla de Parametro");
INSERT INTO tbl_bitacora VALUES("127","2021-04-12 23:51:00","1","19","Consulta","SUPERADMIN Consultó la pantalla de permisos rol");
INSERT INTO tbl_bitacora VALUES("128","2021-04-12 23:52:11","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("129","2021-04-12 23:52:19","1","7","consulta"," Consulto la pantalla de Respaldo y Restauracion");
INSERT INTO tbl_bitacora VALUES("130","2021-04-12 23:52:19","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("131","2021-04-12 23:52:19","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("132","2021-04-12 23:53:24","1","4","consulta"," Consulto la pantalla de Productos");
INSERT INTO tbl_bitacora VALUES("133","2021-04-12 23:55:10","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("134","2021-04-12 23:56:27","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("135","2021-04-12 23:56:54","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("136","2021-04-12 23:56:54","1","5","Nueva","Nueva venta");
INSERT INTO tbl_bitacora VALUES("137","2021-04-12 23:57:44","1","6","consulta"," Consulto la pantalla de Rol");
INSERT INTO tbl_bitacora VALUES("138","2021-04-12 23:58:26","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("139","2021-04-12 23:59:41","1","2","Generar","SUPERADMIN Generó reporte pdf de usuarios");
INSERT INTO tbl_bitacora VALUES("140","2021-04-13 00:00:05","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("141","2021-04-13 00:01:11","1","13","Generar","SUPERADMIN Generó reporte pdf de administrar ventas");
INSERT INTO tbl_bitacora VALUES("142","2021-04-13 00:20:37","1","6","consulta"," Consulto la pantalla de Descuento");
INSERT INTO tbl_bitacora VALUES("143","2021-04-13 00:20:37","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("144","2021-04-13 00:21:29","1","6","consulta"," Consulto la pantalla de Descuento");
INSERT INTO tbl_bitacora VALUES("145","2021-04-13 00:21:29","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("146","2021-04-13 00:44:48","1","6","consulta"," Consulto la pantalla de Descuento");
INSERT INTO tbl_bitacora VALUES("147","2021-04-13 00:44:48","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("148","2021-04-13 00:45:31","1","4","consulta"," Consulto la pantalla de Productos");
INSERT INTO tbl_bitacora VALUES("149","2021-04-13 00:46:00","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("150","2021-04-13 15:10:51","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("151","2021-04-13 15:17:40","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("152","2021-04-13 15:18:44","1","1","Consulta"," Consultó Inicio");
INSERT INTO tbl_bitacora VALUES("153","2021-04-13 15:19:18","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("154","2021-04-13 15:20:20","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("155","2021-04-13 15:20:24","1","1","Consulta","SUPERADMIN Consultó Inicio");
INSERT INTO tbl_bitacora VALUES("156","2021-04-13 15:20:59","1","1","Consulta","SUPERADMIN Consultó inicio");
INSERT INTO tbl_bitacora VALUES("157","2021-04-13 15:22:43","1","1","Consulta","SUPERADMIN Consultó inicio");
INSERT INTO tbl_bitacora VALUES("158","2021-04-13 15:22:45","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuario");
INSERT INTO tbl_bitacora VALUES("159","2021-04-13 15:23:14","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("160","2021-04-13 15:24:04","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("161","2021-04-13 15:25:08","1","4","consulta"," Consulto la pantalla de Compras");
INSERT INTO tbl_bitacora VALUES("162","2021-04-13 15:26:42","1","4","Consulta","SUPERADMIN Consultó la pantalla de compras");
INSERT INTO tbl_bitacora VALUES("163","2021-04-13 15:27:32","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("164","2021-04-13 15:27:39","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("165","2021-04-13 15:28:06","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("166","2021-04-13 15:28:12","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("167","2021-04-13 15:28:15","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("168","2021-04-13 15:28:33","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("169","2021-04-13 15:28:44","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("170","2021-04-13 15:29:48","1","3","consulta","SUPERADMIN Consulto la pantalla de cliente inscripciones histórico");
INSERT INTO tbl_bitacora VALUES("171","2021-04-13 15:30:16","1","3","Consulta","SUPERADMIN Consulto la pantalla de cliente inscripciones histórico");
INSERT INTO tbl_bitacora VALUES("172","2021-04-13 15:30:38","1","4","Consulta","SUPERADMIN Consultó la pantalla de compras");
INSERT INTO tbl_bitacora VALUES("173","2021-04-13 15:30:58","1","10","Consulta","SUPERADMIN Consultó la pantalla de inventario");
INSERT INTO tbl_bitacora VALUES("174","2021-04-13 15:31:16","1","4","consulta"," Consulto la pantalla de Productos");
INSERT INTO tbl_bitacora VALUES("175","2021-04-13 15:32:10","1","4","Consulta","SUPERADMIN Consulto la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("176","2021-04-13 15:32:32","1","4","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("177","2021-04-13 15:32:48","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("178","2021-04-13 15:35:39","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("179","2021-04-13 15:36:31","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("180","2021-04-13 15:36:53","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("181","2021-04-13 15:37:15","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("182","2021-04-13 15:38:30","1","4","Consulta"," Consultó la pantalla de administracion de ventas");
INSERT INTO tbl_bitacora VALUES("183","2021-04-13 15:39:37","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("184","2021-04-13 15:41:28","1","5","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("185","2021-04-13 15:41:44","1","16","Consulta","SUPERADMIN Consultó la pantalla de reporte de ventas");
INSERT INTO tbl_bitacora VALUES("186","2021-04-13 15:45:25","1","6","consulta"," Consulto la pantalla de Rol");
INSERT INTO tbl_bitacora VALUES("187","2021-04-13 15:46:08","1","6","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("188","2021-04-13 15:46:24","1","19","Consulta","SUPERADMIN Consultó la pantalla de permisos rol");
INSERT INTO tbl_bitacora VALUES("189","2021-04-13 15:46:40","1","6","consulta"," Consulto la pantalla de Parametro");
INSERT INTO tbl_bitacora VALUES("190","2021-04-13 15:47:41","1","6","Consulta","SUPERADMIN Consultó la pantalla de parametros");
INSERT INTO tbl_bitacora VALUES("191","2021-04-13 15:47:57","1","6","consulta"," Consulto la pantalla deInscripcion");
INSERT INTO tbl_bitacora VALUES("192","2021-04-13 15:49:30","1","6","consulta"," Consulto la pantalla deInscripcion");
INSERT INTO tbl_bitacora VALUES("193","2021-04-13 15:49:41","1","20","Consulta","SUPERADMIN Consultó la pantalla de parametros");
INSERT INTO tbl_bitacora VALUES("194","2021-04-13 15:51:14","1","20","Consulta","SUPERADMIN Consultó la pantalla de parametros");
INSERT INTO tbl_bitacora VALUES("195","2021-04-13 15:51:18","1","21","Consulta"," Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("196","2021-04-13 15:51:37","1","6","consulta"," Consulto la pantalla de Matricula");
INSERT INTO tbl_bitacora VALUES("197","2021-04-13 15:52:58","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("198","2021-04-13 15:53:25","1","6","consulta"," Consulto la pantalla de Descuento");
INSERT INTO tbl_bitacora VALUES("199","2021-04-13 15:53:25","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("200","2021-04-13 15:54:47","1","23","Consulta"," Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("201","2021-04-13 15:57:53","1","24","Consulta"," Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("202","2021-04-13 15:59:09","1","25","Consulta"," Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("203","2021-04-13 16:00:56","1","26","Consulta"," Consultó la pantalla de bitacora");
INSERT INTO tbl_bitacora VALUES("204","2021-04-13 16:01:16","1","7","consulta"," Consulto la pantalla de Respaldo y Restauracion");
INSERT INTO tbl_bitacora VALUES("205","2021-04-13 16:01:16","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("206","2021-04-13 16:01:16","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("207","2021-04-13 16:02:18","1","27","Consulta"," Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("208","2021-04-13 16:02:18","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("209","2021-04-13 16:02:18","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("210","2021-04-13 16:02:28","1","27","Consulta"," Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("211","2021-04-13 16:02:28","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("212","2021-04-13 16:02:28","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("213","2021-04-13 16:02:41","1","27","Consulta"," Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("214","2021-04-13 16:02:41","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("215","2021-04-13 16:02:42","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("216","2021-04-13 16:03:25","1","27","Consulta"," Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("217","2021-04-13 16:03:25","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("218","2021-04-13 16:03:25","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("219","2021-04-13 16:03:44","1","27","Consulta"," Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("220","2021-04-13 16:03:44","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("221","2021-04-13 16:03:44","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("222","2021-04-13 16:04:18","1","27","Consulta"," Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("223","2021-04-13 16:04:18","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("224","2021-04-13 16:05:27","1","27","Consulta"," Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("225","2021-04-13 16:05:27","1","27","Consulta"," Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("226","2021-04-13 16:05:27","1","27","Consulta"," Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("227","2021-04-13 16:09:12","1","1","Consulta","SUPERADMIN Consultó inicio");
INSERT INTO tbl_bitacora VALUES("228","2021-04-13 16:09:18","1","7","Consulta","Consulta a Perfil");
INSERT INTO tbl_bitacora VALUES("229","2021-04-13 16:14:23","1","28","Consulta","SUPERADMINConsultó el perfil");
INSERT INTO tbl_bitacora VALUES("230","2021-04-13 16:14:48","1","28","Consulta","SUPERADMIN Consultó el perfil");
INSERT INTO tbl_bitacora VALUES("231","2021-04-13 16:17:11","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("232","2021-04-13 16:17:24","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("233","2021-04-13 16:17:40","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("234","2021-04-13 16:17:50","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("235","2021-04-13 16:17:56","1","26","Consulta","SUPERADMIN Consultó la pantalla de bitacora");
INSERT INTO tbl_bitacora VALUES("236","2021-04-13 16:18:00","1","27","Consulta","SUPERADMIN Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("237","2021-04-13 16:18:00","1","27","Consulta","SUPERADMIN Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("238","2021-04-13 16:18:00","1","27","Consulta","SUPERADMIN Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("239","2021-04-13 16:19:43","1","1","Consulta","SUPERADMIN Consultó inicio");
INSERT INTO tbl_bitacora VALUES("240","2021-04-13 16:19:55","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("241","2021-04-13 16:20:07","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("242","2021-04-13 16:20:17","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("243","2021-04-13 16:21:31","1","3","Consulta","SUPERADMIN Consultó la pantalla de clientes");
INSERT INTO tbl_bitacora VALUES("244","2021-04-13 16:22:17","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("245","2021-04-13 16:22:37","1","5","Consulta","SUPERADMIN Consultó la pantalla de clientes inscripciones");
INSERT INTO tbl_bitacora VALUES("246","2021-04-13 16:22:48","1","3","Consulta","SUPERADMIN Consulto la pantalla de cliente inscripciones histórico");
INSERT INTO tbl_bitacora VALUES("247","2021-04-13 16:23:53","1","6","Consulta","SUPERADMIN Consulto la pantalla de cliente inscripciones histórico");
INSERT INTO tbl_bitacora VALUES("248","2021-04-13 16:24:04","1","4","Consulta","SUPERADMIN Consultó la pantalla de compras");
INSERT INTO tbl_bitacora VALUES("249","2021-04-13 16:24:45","1","4","Consulta","SUPERADMIN Consultó la pantalla de compras");
INSERT INTO tbl_bitacora VALUES("250","2021-04-13 16:25:08","1","9","Consulta","SUPERADMIN Consultó la pantalla de compras");
INSERT INTO tbl_bitacora VALUES("251","2021-04-13 16:25:28","1","10","Consulta","SUPERADMIN Consultó la pantalla de inventario");
INSERT INTO tbl_bitacora VALUES("252","2021-04-13 16:25:40","1","4","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("253","2021-04-13 16:26:22","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("254","2021-04-13 16:26:34","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("255","2021-04-13 16:26:45","1","4","Consulta"," Consultó la pantalla de administracion de ventas");
INSERT INTO tbl_bitacora VALUES("256","2021-04-13 16:27:18","1","14","Consulta"," Consultó la pantalla de administracion de ventas");
INSERT INTO tbl_bitacora VALUES("257","2021-04-13 16:27:34","1","5","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("258","2021-04-13 16:28:16","1","5","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("259","2021-04-13 16:29:03","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("260","2021-04-13 16:29:13","1","16","Consulta","SUPERADMIN Consultó la pantalla de reporte de ventas");
INSERT INTO tbl_bitacora VALUES("261","2021-04-13 16:29:23","1","6","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("262","2021-04-13 16:30:26","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("263","2021-04-13 16:31:58","1","19","Consulta","SUPERADMIN Consultó la pantalla de permisos rol");
INSERT INTO tbl_bitacora VALUES("264","2021-04-13 16:32:13","1","20","Consulta","SUPERADMIN Consultó la pantalla de parametros");
INSERT INTO tbl_bitacora VALUES("265","2021-04-13 16:32:23","1","21","Consulta"," Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("266","2021-04-13 16:32:33","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("267","2021-04-13 16:32:51","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("268","2021-04-13 16:33:02","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("269","2021-04-13 16:33:18","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("270","2021-04-13 16:33:30","1","26","Consulta","SUPERADMIN Consultó la pantalla de bitacora");
INSERT INTO tbl_bitacora VALUES("271","2021-04-13 16:33:38","1","27","Consulta","SUPERADMIN Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("272","2021-04-13 16:33:38","1","27","Consulta","SUPERADMIN Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("273","2021-04-13 16:33:38","1","27","Consulta","SUPERADMIN Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("274","2021-04-13 16:34:45","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("275","2021-04-13 17:03:42","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("276","2021-04-13 17:04:30","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("277","2021-04-13 17:04:31","1","2","Nuevo","Nuevo Usuario");
INSERT INTO tbl_bitacora VALUES("278","2021-04-13 17:04:32","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("279","2021-04-13 17:08:01","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("280","2021-04-13 17:08:02","1","2","Actualizo"," Actualizo registro en la pantalla de usuario");
INSERT INTO tbl_bitacora VALUES("281","2021-04-13 17:08:07","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("282","2021-04-13 17:08:18","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("283","2021-04-13 17:08:18","1","2","Actualizo"," Actualizo registro en la pantalla de usuario");
INSERT INTO tbl_bitacora VALUES("284","2021-04-13 17:08:20","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("285","2021-04-13 17:11:45","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("286","2021-04-13 17:11:55","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("287","2021-04-13 17:11:55","1","2","Actualizar","1 Actualizó el registro en la pantalla de usuarioBITACORA");
INSERT INTO tbl_bitacora VALUES("288","2021-04-13 17:11:56","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("289","2021-04-13 17:12:22","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("290","2021-04-13 17:12:29","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("291","2021-04-13 17:12:30","1","2","Actualizar","SUPERADMIN Actualizó el registro en la pantalla de usuario BITACORA");
INSERT INTO tbl_bitacora VALUES("292","2021-04-13 17:12:31","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("293","2021-04-13 17:13:30","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("294","2021-04-13 17:13:38","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("295","2021-04-13 17:13:39","1","2","Actualizar","SUPERADMIN Actualizó el registro del usuario BITACORA");
INSERT INTO tbl_bitacora VALUES("296","2021-04-13 17:13:41","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("297","2021-04-13 17:14:09","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("298","2021-04-13 17:14:09","1","2","Actualizar","SUPERADMIN Actualizó el registro del usuario NUEVO");
INSERT INTO tbl_bitacora VALUES("299","2021-04-13 17:14:10","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("300","2021-04-13 17:15:59","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("301","2021-04-13 17:15:59","1","2","Elimino"," Elimino un usuario.");
INSERT INTO tbl_bitacora VALUES("302","2021-04-13 17:16:02","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("303","2021-04-13 17:20:56","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("304","2021-04-13 17:21:01","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("305","2021-04-13 17:21:04","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("306","2021-04-13 17:21:09","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("307","2021-04-13 17:21:10","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("308","2021-04-13 17:22:23","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("309","2021-04-13 17:22:23","1","2","Nuevo","SUPERADMIN Creó un nuevo usuario");
INSERT INTO tbl_bitacora VALUES("310","2021-04-13 17:22:25","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("311","2021-04-13 17:22:35","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("312","2021-04-13 17:22:39","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("313","2021-04-13 17:22:39","1","2","Eliminar","SUPERADMIN Eliminó un usuario.");
INSERT INTO tbl_bitacora VALUES("314","2021-04-13 17:22:41","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("315","2021-04-13 17:26:14","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("316","2021-04-13 17:27:05","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("317","2021-04-13 17:27:06","1","2","Nuevo","SUPERADMIN Creó un nuevo usuario");
INSERT INTO tbl_bitacora VALUES("318","2021-04-13 17:27:07","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("319","2021-04-13 17:27:37","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("320","2021-04-13 17:27:37","1","2","Eliminar","SUPERADMIN Eliminó un usuarioBITACORA");
INSERT INTO tbl_bitacora VALUES("321","2021-04-13 17:27:39","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("322","2021-04-13 17:29:42","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("323","2021-04-13 17:30:26","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("324","2021-04-13 17:30:27","1","2","Nuevo","SUPERADMIN Creó un nuevo usuario llamado");
INSERT INTO tbl_bitacora VALUES("325","2021-04-13 17:30:28","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("326","2021-04-13 17:33:15","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("327","2021-04-13 17:33:54","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("328","2021-04-13 17:33:55","1","2","Nuevo","SUPERADMIN Creó un nuevo usuario llamado ");
INSERT INTO tbl_bitacora VALUES("329","2021-04-13 17:33:56","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("330","2021-04-13 17:34:54","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("331","2021-04-13 17:34:57","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("332","2021-04-13 17:34:58","1","2","Eliminar","SUPERADMIN Eliminó el usuario INGRESAR");
INSERT INTO tbl_bitacora VALUES("333","2021-04-13 17:35:00","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("334","2021-04-13 17:35:39","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("335","2021-04-13 17:36:14","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("336","2021-04-13 17:36:15","1","2","Nuevo","SUPERADMIN Creó un nuevo usuario llamado INGRESAR");
INSERT INTO tbl_bitacora VALUES("337","2021-04-13 17:36:16","1","2","Consulta","SUPERADMIN Consultó la pantalla de usuarios");
INSERT INTO tbl_bitacora VALUES("338","2021-04-13 23:01:58","1","1","Consulta","SUPERADMIN Consultó inicio");
INSERT INTO tbl_bitacora VALUES("339","2021-04-13 23:02:41","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("340","2021-04-13 23:04:13","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("341","2021-04-13 23:04:13","1","3","Nuevo","SUPERADMIN creó un nuevo cliente de ventas");
INSERT INTO tbl_bitacora VALUES("342","2021-04-13 23:04:15","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("343","2021-04-13 23:08:49","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("344","2021-04-13 23:08:59","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("345","2021-04-13 23:09:01","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("346","2021-04-13 23:09:12","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("347","2021-04-13 23:09:14","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("348","2021-04-13 23:10:07","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("349","2021-04-13 23:10:07","1","3","Nuevo","SUPERADMIN creó un nuevo cliente de ventas");
INSERT INTO tbl_bitacora VALUES("350","2021-04-13 23:10:08","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("351","2021-04-13 23:12:27","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("352","2021-04-13 23:13:12","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("353","2021-04-13 23:13:12","1","3","Nuevo","SUPERADMIN creó un nuevo cliente de ventasOTTO");
INSERT INTO tbl_bitacora VALUES("354","2021-04-13 23:13:13","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("355","2021-04-13 23:14:51","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("356","2021-04-13 23:15:42","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("357","2021-04-13 23:15:43","1","3","Nuevo","SUPERADMIN creó el nuevo cliente del gimnasio llamadoBITACORA");
INSERT INTO tbl_bitacora VALUES("358","2021-04-13 23:15:44","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("359","2021-04-13 23:17:15","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("360","2021-04-13 23:17:15","1","3","Nuevo","SUPERADMIN creó el nuevo cliente de ventas llamado LUISR");
INSERT INTO tbl_bitacora VALUES("361","2021-04-13 23:17:16","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("362","2021-04-13 23:18:35","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("363","2021-04-13 23:18:35","1","3","Actualizar","SUPERADMIN Actualizó el cliente de gimnasio llamado MARIA");
INSERT INTO tbl_bitacora VALUES("364","2021-04-13 23:18:37","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("365","2021-04-13 23:19:25","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("366","2021-04-13 23:19:26","1","3","Actualizar","SUPERADMIN Actualizó el cliente de ventas llamado BITACORA");
INSERT INTO tbl_bitacora VALUES("367","2021-04-13 23:19:27","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("368","2021-04-13 23:22:09","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("369","2021-04-13 23:22:16","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("370","2021-04-13 23:22:16","1","4","Actualizar","SUPERADMIN Actualizó el cliente de gimnasio llamado MARIA");
INSERT INTO tbl_bitacora VALUES("371","2021-04-13 23:22:18","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("372","2021-04-13 23:22:44","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("373","2021-04-13 23:22:44","1","4","Actualizar","SUPERADMIN Actualizó el cliente de ventas llamado OTTO");
INSERT INTO tbl_bitacora VALUES("374","2021-04-13 23:22:46","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("375","2021-04-13 23:25:54","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("376","2021-04-13 23:25:57","1","4","Consulta","SUPERADMIN Consultó la pantalla de administrar clientes");
INSERT INTO tbl_bitacora VALUES("377","2021-04-13 23:26:09","1","9","Consulta","SUPERADMIN Consultó la pantalla de compras");
INSERT INTO tbl_bitacora VALUES("378","2021-04-13 23:26:23","1","9","Consulta","SUPERADMIN Consultó la pantalla de compras");
INSERT INTO tbl_bitacora VALUES("379","2021-04-13 23:26:23","1","9","Nuevo","SUPERADMIN Realizó una nueva compra ");
INSERT INTO tbl_bitacora VALUES("380","2021-04-13 23:26:25","1","9","Consulta","SUPERADMIN Consultó la pantalla de compras");
INSERT INTO tbl_bitacora VALUES("381","2021-04-13 23:27:58","1","10","Consulta","SUPERADMIN Consultó la pantalla de inventario");
INSERT INTO tbl_bitacora VALUES("382","2021-04-13 23:28:07","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("383","2021-04-13 23:28:26","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("384","2021-04-13 23:28:26","1","4","Nuevo"," Nuevo Producto");
INSERT INTO tbl_bitacora VALUES("385","2021-04-13 23:28:31","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("386","2021-04-13 23:30:34","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("387","2021-04-13 23:30:45","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("388","2021-04-13 23:30:45","1","4","Nuevo","SUPERADMINAgregó un nuevo producto");
INSERT INTO tbl_bitacora VALUES("389","2021-04-13 23:30:46","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("390","2021-04-13 23:33:37","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("391","2021-04-13 23:33:50","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("392","2021-04-13 23:33:50","1","4","Actualizar","SUPERADMIN Actualizó un producto del stock");
INSERT INTO tbl_bitacora VALUES("393","2021-04-13 23:33:52","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("394","2021-04-13 23:35:10","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("395","2021-04-13 23:35:23","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("396","2021-04-13 23:35:24","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("397","2021-04-13 23:38:10","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("398","2021-04-13 23:40:57","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("399","2021-04-13 23:41:08","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("400","2021-04-13 23:41:08","1","4","Nuevo","SUPERADMIN Agregó un nuevo equipo");
INSERT INTO tbl_bitacora VALUES("401","2021-04-13 23:41:09","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("402","2021-04-13 23:43:06","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("403","2021-04-13 23:43:06","1","2","Actualizo","Actualizo un Equipo del Stock");
INSERT INTO tbl_bitacora VALUES("404","2021-04-13 23:43:08","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("405","2021-04-13 23:44:36","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("406","2021-04-13 23:44:43","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("407","2021-04-13 23:44:43","1","12","Actualizo","SUPERADMIN Actualizó un Equipo del stock");
INSERT INTO tbl_bitacora VALUES("408","2021-04-13 23:44:45","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("409","2021-04-13 23:45:14","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("410","2021-04-13 23:45:22","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("411","2021-04-13 23:45:22","1","12","Actualizar","SUPERADMIN Actualizó un equipo del stock");
INSERT INTO tbl_bitacora VALUES("412","2021-04-13 23:45:23","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("413","2021-04-13 23:48:51","1","9","Consulta","SUPERADMIN Consultó la pantalla de compras");
INSERT INTO tbl_bitacora VALUES("414","2021-04-13 23:49:03","1","9","Consulta","SUPERADMIN Consultó la pantalla de compras");
INSERT INTO tbl_bitacora VALUES("415","2021-04-13 23:49:03","1","9","Nuevo","SUPERADMIN Realizó una nueva compra ");
INSERT INTO tbl_bitacora VALUES("416","2021-04-13 23:49:04","1","9","Consulta","SUPERADMIN Consultó la pantalla de compras");
INSERT INTO tbl_bitacora VALUES("417","2021-04-13 23:49:17","1","10","Consulta","SUPERADMIN Consultó la pantalla de inventario");
INSERT INTO tbl_bitacora VALUES("418","2021-04-13 23:49:24","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("419","2021-04-13 23:49:44","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("420","2021-04-13 23:49:44","1","4","Nuevo","SUPERADMIN Agregó un nuevo producto");
INSERT INTO tbl_bitacora VALUES("421","2021-04-13 23:49:45","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("422","2021-04-13 23:49:53","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("423","2021-04-13 23:49:53","1","4","Actualizar","SUPERADMIN Actualizó un producto del stock");
INSERT INTO tbl_bitacora VALUES("424","2021-04-13 23:49:54","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("425","2021-04-13 23:50:44","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("426","2021-04-13 23:50:49","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("427","2021-04-13 23:50:49","1","11","Actualizar","SUPERADMIN Actualizó un producto del stock");
INSERT INTO tbl_bitacora VALUES("428","2021-04-13 23:50:51","1","11","Consulta","SUPERADMIN Consultó la pantalla de productos");
INSERT INTO tbl_bitacora VALUES("429","2021-04-13 23:51:06","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("430","2021-04-13 23:51:17","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("431","2021-04-13 23:51:17","1","12","Nuevo","SUPERADMIN Agregó un nuevo equipo");
INSERT INTO tbl_bitacora VALUES("432","2021-04-13 23:51:18","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("433","2021-04-13 23:51:22","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("434","2021-04-13 23:51:22","1","12","Actualizar","SUPERADMIN Actualizó un equipo del stock");
INSERT INTO tbl_bitacora VALUES("435","2021-04-13 23:51:24","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("436","2021-04-13 23:52:49","1","14","Consulta"," Consultó la pantalla de administracion de ventas");
INSERT INTO tbl_bitacora VALUES("437","2021-04-13 23:52:54","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("438","2021-04-13 23:53:26","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("439","2021-04-13 23:53:26","1","5","Nueva","Nueva venta");
INSERT INTO tbl_bitacora VALUES("440","2021-04-13 23:53:41","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("441","2021-04-13 23:53:41","1","5","Nueva","Nueva venta");
INSERT INTO tbl_bitacora VALUES("442","2021-04-13 23:54:47","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("443","2021-04-13 23:54:50","1","14","Consulta"," Consultó la pantalla de administracion de ventas");
INSERT INTO tbl_bitacora VALUES("444","2021-04-13 23:54:57","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("445","2021-04-13 23:55:08","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("446","2021-04-13 23:55:10","1","14","Consulta"," Consultó la pantalla de administracion de ventas");
INSERT INTO tbl_bitacora VALUES("447","2021-04-14 00:00:16","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("448","2021-04-14 00:02:15","1","15","Nuevo","SUPERADMIN Registró una nueva venta");
INSERT INTO tbl_bitacora VALUES("449","2021-04-14 00:02:24","1","15","Nuevo","SUPERADMIN Registró una nueva venta");
INSERT INTO tbl_bitacora VALUES("450","2021-04-14 00:02:26","1","14","Consulta"," Consultó la pantalla de administracion de ventas");
INSERT INTO tbl_bitacora VALUES("451","2021-04-14 00:04:00","1","15","Nuevo","SUPERADMIN Registró una nueva venta");
INSERT INTO tbl_bitacora VALUES("452","2021-04-14 00:04:05","1","15","Nuevo","SUPERADMIN Registró una nueva venta");
INSERT INTO tbl_bitacora VALUES("453","2021-04-14 00:04:08","1","14","Consulta"," Consultó la pantalla de administracion de ventas");
INSERT INTO tbl_bitacora VALUES("454","2021-04-14 00:04:49","1","14","Consulta"," Consultó la pantalla de administracion de ventas");
INSERT INTO tbl_bitacora VALUES("455","2021-04-14 00:04:58","1","15","Nuevo","SUPERADMIN Registró una nueva venta");
INSERT INTO tbl_bitacora VALUES("456","2021-04-14 00:05:03","1","15","Nuevo","SUPERADMIN Registró una nueva venta");
INSERT INTO tbl_bitacora VALUES("457","2021-04-14 00:05:05","1","14","Consulta"," Consultó la pantalla de administracion de ventas");
INSERT INTO tbl_bitacora VALUES("458","2021-04-14 00:06:45","1","14","Consulta"," Consultó la pantalla de administracion de ventas");
INSERT INTO tbl_bitacora VALUES("459","2021-04-14 00:07:25","1","14","Consulta"," Consultó la pantalla de administrar de ventas");
INSERT INTO tbl_bitacora VALUES("460","2021-04-14 00:07:42","1","14","Consulta"," Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("461","2021-04-14 00:07:54","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("462","2021-04-14 00:08:01","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("463","2021-04-14 00:08:03","1","14","Consulta"," Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("464","2021-04-14 00:09:03","1","14","Consulta"," Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("465","2021-04-14 00:09:05","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("466","2021-04-14 00:09:09","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("467","2021-04-14 00:09:10","1","14","Consulta"," Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("468","2021-04-14 00:10:33","1","14","Consulta"," Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("469","2021-04-14 00:11:06","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("470","2021-04-14 00:11:47","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("471","2021-04-14 00:11:48","1","14","Consulta","SUPERADMIN Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("472","2021-04-14 00:13:24","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("473","2021-04-14 00:13:33","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("474","2021-04-14 00:13:33","1","5","Nueva","Nueva venta");
INSERT INTO tbl_bitacora VALUES("475","2021-04-14 00:15:49","1","14","Consulta","SUPERADMIN Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("476","2021-04-14 00:15:51","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("477","2021-04-14 00:16:13","1","14","Consulta","SUPERADMIN Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("478","2021-04-14 00:17:35","1","14","Consulta","SUPERADMIN Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("479","2021-04-14 00:17:38","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("480","2021-04-14 00:17:41","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("481","2021-04-14 00:17:41","1","15","Nuevo","SUPERADMINRegistró una nueva venta");
INSERT INTO tbl_bitacora VALUES("482","2021-04-14 00:17:44","1","14","Consulta","SUPERADMIN Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("483","2021-04-14 00:19:12","1","14","Consulta","SUPERADMIN Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("484","2021-04-14 00:19:18","1","15","Nuevo","SUPERADMIN Registró una nueva venta");
INSERT INTO tbl_bitacora VALUES("485","2021-04-14 00:19:20","1","14","Consulta","SUPERADMIN Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("486","2021-04-14 00:20:33","1","14","Consulta","SUPERADMIN Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("487","2021-04-14 00:20:35","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("488","2021-04-14 00:20:41","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("489","2021-04-14 00:20:41","1","15","Nuevo","SUPERADMIN Registró una nueva venta");
INSERT INTO tbl_bitacora VALUES("490","2021-04-14 00:20:43","1","14","Consulta","SUPERADMIN Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("491","2021-04-14 00:22:28","1","13","Generar","SUPERADMIN Generó reporte pdf de administrar venta");
INSERT INTO tbl_bitacora VALUES("492","2021-04-14 00:23:12","1","15","Consulta","SUPERADMIN Consultó la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("493","2021-04-14 00:24:47","1","14","Consulta","SUPERADMIN Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("494","2021-04-14 00:24:53","1","13","Generar","SUPERADMIN Generó reporte pdf de administrar venta");
INSERT INTO tbl_bitacora VALUES("495","2021-04-14 00:26:34","1","14","Consulta","SUPERADMIN Consultó la pantalla de administrar ventas");
INSERT INTO tbl_bitacora VALUES("496","2021-04-14 00:26:53","1","13","Generar","SUPERADMIN Generó reporte pdf de administrar venta");
INSERT INTO tbl_bitacora VALUES("497","2021-04-14 00:27:49","1","16","Consulta","SUPERADMIN Consultó la pantalla de reporte de ventas");
INSERT INTO tbl_bitacora VALUES("498","2021-04-14 00:28:02","1","12","Consulta","SUPERADMIN Consultó la pantalla de equipo");
INSERT INTO tbl_bitacora VALUES("499","2021-04-14 00:29:18","1","16","Consulta","SUPERADMIN Consultó la pantalla de reporte de ventas");
INSERT INTO tbl_bitacora VALUES("500","2021-04-14 00:31:02","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("501","2021-04-14 00:31:07","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("502","2021-04-14 00:31:09","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("503","2021-04-14 00:31:16","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("504","2021-04-14 00:31:16","1","6","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("505","2021-04-14 00:31:17","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("506","2021-04-14 00:31:46","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("507","2021-04-14 00:36:30","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("508","2021-04-14 00:37:23","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("509","2021-04-14 00:39:33","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("510","2021-04-14 00:40:10","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("511","2021-04-14 00:41:41","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("512","2021-04-14 00:42:02","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("513","2021-04-14 00:42:37","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("514","2021-04-14 00:42:37","1","6","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("515","2021-04-14 00:42:39","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("516","2021-04-14 00:44:28","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("517","2021-04-14 00:44:34","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("518","2021-04-14 00:44:34","1","6","Actualizar","SUPERADMINActualizó el rol");
INSERT INTO tbl_bitacora VALUES("519","2021-04-14 00:44:35","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("520","2021-04-14 00:45:06","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("521","2021-04-14 00:45:10","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("522","2021-04-14 00:45:10","1","18","Actualizar","SUPERADMIN Actualizó un rol");
INSERT INTO tbl_bitacora VALUES("523","2021-04-14 00:45:12","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("524","2021-04-14 00:47:10","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("525","2021-04-14 00:47:30","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("526","2021-04-14 00:48:50","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("527","2021-04-14 00:48:54","1","18","Consulta","SUPERADMIN Consultó la pantalla de rol");
INSERT INTO tbl_bitacora VALUES("528","2021-04-14 00:51:30","1","19","Consulta","SUPERADMIN Consultó la pantalla de permisos rol");
INSERT INTO tbl_bitacora VALUES("529","2021-04-14 00:52:15","1","20","Consulta","SUPERADMIN Consultó la pantalla de parametros");
INSERT INTO tbl_bitacora VALUES("530","2021-04-14 00:52:28","1","20","Consulta","SUPERADMIN Consultó la pantalla de parametros");
INSERT INTO tbl_bitacora VALUES("531","2021-04-14 00:52:28","1","6","Actualizo","Actualizo parametro");
INSERT INTO tbl_bitacora VALUES("532","2021-04-14 00:52:30","1","20","Consulta","SUPERADMIN Consultó la pantalla de parametros");
INSERT INTO tbl_bitacora VALUES("533","2021-04-14 00:55:57","1","20","Consulta","SUPERADMIN Consultó la pantalla de parametros");
INSERT INTO tbl_bitacora VALUES("534","2021-04-14 00:56:20","1","20","Consulta","SUPERADMIN Consultó la pantalla de parametros");
INSERT INTO tbl_bitacora VALUES("535","2021-04-14 00:56:24","1","20","Consulta","SUPERADMIN Consultó la pantalla de parametros");
INSERT INTO tbl_bitacora VALUES("536","2021-04-14 00:56:24","1","20","Actualizar","SUPERADMIN Actualizó un parametro");
INSERT INTO tbl_bitacora VALUES("537","2021-04-14 00:56:26","1","20","Consulta","SUPERADMIN Consultó la pantalla de parametros");
INSERT INTO tbl_bitacora VALUES("538","2021-04-14 00:56:57","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("539","2021-04-14 00:57:25","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("540","2021-04-14 00:57:25","1","6","Nuevo","Nueva Inscripcion del Gimnasio");
INSERT INTO tbl_bitacora VALUES("541","2021-04-14 00:57:27","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("542","2021-04-14 01:00:46","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("543","2021-04-14 01:00:56","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("544","2021-04-14 01:00:56","1","6","Nuevo","SUPERADMIN Agregó una nueva inscripción del gimnasio");
INSERT INTO tbl_bitacora VALUES("545","2021-04-14 01:00:58","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("546","2021-04-14 01:01:39","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("547","2021-04-14 01:01:48","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("548","2021-04-14 01:01:49","1","21","Nuevo","SUPERADMIN Agregó una nueva inscripción del gimnasio");
INSERT INTO tbl_bitacora VALUES("549","2021-04-14 01:01:50","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("550","2021-04-14 01:02:15","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("551","2021-04-14 01:02:16","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("552","2021-04-14 01:04:27","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("553","2021-04-14 01:04:31","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("554","2021-04-14 01:04:31","1","21","Eliminar","SUPERADMIN Eliminó una inscripción del gimnasio");
INSERT INTO tbl_bitacora VALUES("555","2021-04-14 01:04:32","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("556","2021-04-14 01:07:00","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("557","2021-04-14 01:07:00","1","6","Actualizar","SUPERADMINActualizó una inscripcion");
INSERT INTO tbl_bitacora VALUES("558","2021-04-14 01:07:03","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("559","2021-04-14 01:07:38","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("560","2021-04-14 01:07:42","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("561","2021-04-14 01:07:42","1","6","Actualizar","SUPERADMINActualizó una inscripción");
INSERT INTO tbl_bitacora VALUES("562","2021-04-14 01:07:44","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("563","2021-04-14 01:08:14","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("564","2021-04-14 01:08:18","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("565","2021-04-14 01:08:18","1","21","Actualizar","SUPERADMIN Actualizó una inscripción");
INSERT INTO tbl_bitacora VALUES("566","2021-04-14 01:08:20","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("567","2021-04-14 01:09:11","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("568","2021-04-14 01:09:11","1","21","Eliminar","SUPERADMIN Eliminó una inscripción del gimnasio");
INSERT INTO tbl_bitacora VALUES("569","2021-04-14 01:09:13","1","21","Consulta","SUPERADMIN Consultó la pantalla de inscripción");
INSERT INTO tbl_bitacora VALUES("570","2021-04-14 01:09:35","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("571","2021-04-14 01:09:48","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("572","2021-04-14 01:09:48","1","6","Nuevo","Nueva Matricula del Gimnasio");
INSERT INTO tbl_bitacora VALUES("573","2021-04-14 01:09:50","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("574","2021-04-14 01:12:32","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("575","2021-04-14 01:13:15","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("576","2021-04-14 01:13:23","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("577","2021-04-14 01:13:23","1","22","Nuevo","SUPERADMIN Agregó una nueva matricula del gimnasio");
INSERT INTO tbl_bitacora VALUES("578","2021-04-14 01:13:25","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("579","2021-04-14 01:15:11","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("580","2021-04-14 01:15:25","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("581","2021-04-14 01:15:28","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("582","2021-04-14 01:15:28","1","22","Actualizar","SUPERADMIN Actualizó una matricula ");
INSERT INTO tbl_bitacora VALUES("583","2021-04-14 01:15:30","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("584","2021-04-14 01:15:49","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("585","2021-04-14 01:15:51","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("586","2021-04-14 01:17:16","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("587","2021-04-14 01:17:19","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("588","2021-04-14 01:17:20","1","22","Eliminar","SUPERADMIN Eliminó una matricula ");
INSERT INTO tbl_bitacora VALUES("589","2021-04-14 01:18:37","1","22","Consulta","SUPERADMIN Consultó la pantalla de matrícula");
INSERT INTO tbl_bitacora VALUES("590","2021-04-14 01:18:43","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("591","2021-04-14 01:18:53","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("592","2021-04-14 01:18:53","1","6","Nuevo","Nuevo Descuento del Gimnasio");
INSERT INTO tbl_bitacora VALUES("593","2021-04-14 01:18:55","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("594","2021-04-14 01:20:27","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("595","2021-04-14 01:20:36","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("596","2021-04-14 01:20:36","1","23","Nuevo","SUPERADMIN Agregó un nuevo descuento del gimnasio");
INSERT INTO tbl_bitacora VALUES("597","2021-04-14 01:20:38","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("598","2021-04-14 01:20:58","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("599","2021-04-14 01:20:59","1","6","consulta","Actualizo Descuento");
INSERT INTO tbl_bitacora VALUES("600","2021-04-14 01:21:00","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("601","2021-04-14 01:22:17","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("602","2021-04-14 01:22:21","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("603","2021-04-14 01:22:21","1","23","Actualizar","SUPERADMINActualizó un descuento");
INSERT INTO tbl_bitacora VALUES("604","2021-04-14 01:22:23","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("605","2021-04-14 01:24:11","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("606","2021-04-14 01:24:15","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("607","2021-04-14 01:24:15","1","23","Eliminar","SUPERADMIN Eliminó un descuento ");
INSERT INTO tbl_bitacora VALUES("608","2021-04-14 01:24:18","1","23","Consulta","SUPERADMIN Consultó la pantalla de descuento");
INSERT INTO tbl_bitacora VALUES("609","2021-04-14 01:24:51","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("610","2021-04-14 01:24:57","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("611","2021-04-14 01:24:59","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("612","2021-04-14 01:25:31","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("613","2021-04-14 01:25:33","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("614","2021-04-14 01:27:52","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("615","2021-04-14 01:27:57","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("616","2021-04-14 01:27:57","1","24","Nuevo","SUPERADMIN Agregó un nuevo documento ");
INSERT INTO tbl_bitacora VALUES("617","2021-04-14 01:27:59","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("618","2021-04-14 01:32:24","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("619","2021-04-14 01:32:37","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("620","2021-04-14 01:32:38","1","24","Nuevo","SUPERADMIN Agregó un nuevo documento ");
INSERT INTO tbl_bitacora VALUES("621","2021-04-14 01:32:40","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("622","2021-04-14 01:33:03","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("623","2021-04-14 01:33:05","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("624","2021-04-14 01:34:50","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("625","2021-04-14 01:34:53","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("626","2021-04-14 01:34:53","1","24","Actualizar","SUPERADMIN Actualizó un documento");
INSERT INTO tbl_bitacora VALUES("627","2021-04-14 01:34:55","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("628","2021-04-14 01:36:15","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("629","2021-04-14 01:36:18","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("630","2021-04-14 01:36:18","1","24","Actualizar","SUPERADMIN Actualizó el documento IDENTIDAD");
INSERT INTO tbl_bitacora VALUES("631","2021-04-14 01:36:20","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("632","2021-04-14 01:36:55","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("633","2021-04-14 01:36:57","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("634","2021-04-14 01:38:34","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("635","2021-04-14 01:38:39","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("636","2021-04-14 01:38:39","1","24","Eliminar","SUPERADMIN Eliminó el documento ");
INSERT INTO tbl_bitacora VALUES("637","2021-04-14 01:38:41","1","24","Consulta","SUPERADMIN Consultó la pantalla de documentos");
INSERT INTO tbl_bitacora VALUES("638","2021-04-14 01:39:49","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("639","2021-04-14 01:40:12","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("640","2021-04-14 01:42:12","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("641","2021-04-14 01:42:29","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("642","2021-04-14 01:43:27","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("643","2021-04-14 01:43:29","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("644","2021-04-14 01:44:43","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("645","2021-04-14 01:44:47","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("646","2021-04-14 01:44:47","1","25","Actualizar","SUPERADMIN Actualizó un proveedor ");
INSERT INTO tbl_bitacora VALUES("647","2021-04-14 01:44:48","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("648","2021-04-14 01:45:58","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("649","2021-04-14 01:46:03","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("650","2021-04-14 01:46:03","1","25","Eliminar","SUPERADMIN Eliminó un proveedor ");
INSERT INTO tbl_bitacora VALUES("651","2021-04-14 01:46:05","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("652","2021-04-14 01:46:21","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("653","2021-04-14 01:46:21","1","25","Eliminar","SUPERADMIN Eliminó un proveedor ");
INSERT INTO tbl_bitacora VALUES("654","2021-04-14 01:46:22","1","25","Consulta","SUPERADMIN Consultó la pantalla de proveedores");
INSERT INTO tbl_bitacora VALUES("655","2021-04-14 01:49:12","1","26","Consulta","SUPERADMIN Consultó la pantalla de bitacora");
INSERT INTO tbl_bitacora VALUES("656","2021-04-14 01:49:16","1","27","Consulta","SUPERADMIN Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("657","2021-04-14 01:49:16","1","27","Consulta","SUPERADMIN Consultó la pantalla de respaldo y restauracion");
INSERT INTO tbl_bitacora VALUES("658","2021-04-14 01:49:16","1","27","Consulta","SUPERADMIN Consultó la pantalla de respaldo y restauracion");



DROP TABLE IF EXISTS tbl_cliente_inscripcion;

CREATE TABLE `tbl_cliente_inscripcion` (
  `id_cliente_inscripcion` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_inscripcion` int(11) NOT NULL,
  `fecha_inscripcion` date NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_proximo_pago` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `inscrito` int(11) NOT NULL DEFAULT 1,
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cliente_inscripcion`),
  KEY `id_inscripcion` (`id_inscripcion`),
  KEY `id_cliente` (`id_cliente`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_cliente_inscripcion_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_cliente_inscripcion_ibfk_2` FOREIGN KEY (`id_inscripcion`) REFERENCES `tbl_inscripcion` (`id_inscripcion`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_cliente_inscripcion_ibfk_3` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_cliente_inscripcion VALUES("1","15","2","2020-04-01","2020-12-30","2021-02-05","2021-02-05","0","1","1");
INSERT INTO tbl_cliente_inscripcion VALUES("10","15","2","2020-07-01","2020-12-30","2021-02-05","2021-02-05","0","1","1");
INSERT INTO tbl_cliente_inscripcion VALUES("11","21","2","2020-08-01","2020-08-01","2020-08-31","2020-08-31","0","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("12","21","1","2020-10-01","2020-10-01","2020-10-31","2020-10-31","0","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("14","22","1","2020-10-01","2020-10-01","2020-10-31","2020-10-31","0","1","1");
INSERT INTO tbl_cliente_inscripcion VALUES("15","23","1","2020-09-10","2020-09-10","2020-10-10","2020-10-10","0","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("22","22","1","2020-12-07","2020-12-08","2021-01-21","2021-01-21","1","1","1");
INSERT INTO tbl_cliente_inscripcion VALUES("23","15","1","2020-12-07","2020-12-30","2021-02-05","2021-02-05","1","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("24","25","1","2020-07-08","2021-04-12","2021-06-11","2021-06-11","0","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("25","23","1","2020-12-08","2020-12-08","2021-01-07","2021-01-07","1","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("27","21","2","2020-12-08","2020-12-08","2020-12-23","2020-12-23","0","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("28","27","2","2020-12-08","2020-12-08","2021-02-21","2021-02-21","0","0","1");
INSERT INTO tbl_cliente_inscripcion VALUES("30","28","2","2020-12-08","2020-12-08","2021-02-06","2021-02-06","0","1","1");
INSERT INTO tbl_cliente_inscripcion VALUES("31","28","2","2020-12-08","2020-12-08","2020-12-23","2020-12-23","0","0","");
INSERT INTO tbl_cliente_inscripcion VALUES("39","36","2","2020-12-10","2021-04-12","2021-04-27","2021-04-27","0","0","");
INSERT INTO tbl_cliente_inscripcion VALUES("42","39","2","2020-12-30","2021-04-12","2021-04-27","2021-04-27","1","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("46","49","1","2021-01-03","2021-04-12","2021-08-10","2021-08-10","1","1","1");
INSERT INTO tbl_cliente_inscripcion VALUES("47","54","1","2021-04-12","2021-04-12","2021-06-11","2021-06-11","1","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("48","52","2","2021-04-12","2021-04-12","2021-05-27","2021-05-27","1","1","1");
INSERT INTO tbl_cliente_inscripcion VALUES("49","56","1","2021-04-12","2021-04-12","2021-06-19","2021-06-19","1","1","1");
INSERT INTO tbl_cliente_inscripcion VALUES("50","21","1","2021-04-12","2021-04-12","2021-05-12","2021-05-12","1","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("51","25","1","2021-04-12","2021-04-12","2021-06-11","2021-06-11","1","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("52","60","2","2021-04-13","2021-04-13","2021-04-28","2021-04-28","1","1","");



DROP TABLE IF EXISTS tbl_clientes;

CREATE TABLE `tbl_clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) DEFAULT NULL,
  `tipo_cliente` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_matricula` int(11) DEFAULT NULL,
  `id_descuento` int(11) DEFAULT NULL,
  `compras` int(11) DEFAULT 0,
  `ultima_compra` datetime DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `id_persona` (`id_persona`),
  KEY `id_matricula` (`id_matricula`),
  KEY `id_descuento` (`id_descuento`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_descuentocliente` FOREIGN KEY (`id_descuento`) REFERENCES `tbl_descuento` (`id_descuento`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_matriculacliente` FOREIGN KEY (`id_matricula`) REFERENCES `tbl_matricula` (`id_matricula`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_personacliente` FOREIGN KEY (`id_persona`) REFERENCES `tbl_personas` (`id_personas`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_usuariocliente` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_clientes VALUES("15","22","Gimnasio","1","1","6","2020-12-30 17:08:21","1");
INSERT INTO tbl_clientes VALUES("21","30","Gimnasio","1","3","24","2021-04-14 00:20:41","");
INSERT INTO tbl_clientes VALUES("22","31","Gimnasio","1","1","8","2021-04-14 00:09:09","");
INSERT INTO tbl_clientes VALUES("23","32","Gimnasio","1","2","","","");
INSERT INTO tbl_clientes VALUES("25","34","Gimnasio","1","1","2","2021-04-13 23:53:26","");
INSERT INTO tbl_clientes VALUES("27","39","Gimnasio","1","","","","");
INSERT INTO tbl_clientes VALUES("28","40","Gimnasio","1","1","","","");
INSERT INTO tbl_clientes VALUES("36","54","Gimnasio","1","","2","2021-01-18 20:28:59","");
INSERT INTO tbl_clientes VALUES("39","58","Gimnasio","1","1","1","2020-12-30 17:09:50","");
INSERT INTO tbl_clientes VALUES("49","56","Gimnasio","1","1","0","","");
INSERT INTO tbl_clientes VALUES("52","63","Gimnasio","1","1","0","","");
INSERT INTO tbl_clientes VALUES("53","64","Ventas","","","0","","");
INSERT INTO tbl_clientes VALUES("54","65","Gimnasio","1","2","0","","");
INSERT INTO tbl_clientes VALUES("55","66","Ventas","","","0","","");
INSERT INTO tbl_clientes VALUES("56","67","Gimnasio","1","1","0","","");
INSERT INTO tbl_clientes VALUES("57","74","Ventas","","","0","","");
INSERT INTO tbl_clientes VALUES("58","75","Ventas","","","0","","");
INSERT INTO tbl_clientes VALUES("59","76","Ventas","","","0","","");
INSERT INTO tbl_clientes VALUES("60","77","Gimnasio","1","1","0","","");
INSERT INTO tbl_clientes VALUES("61","78","Ventas","","","0","","");



DROP TABLE IF EXISTS tbl_compras;

CREATE TABLE `tbl_compras` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `cantidad` int(15) NOT NULL,
  `precio` int(15) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_compra`),
  KEY `id_proveedor` (`id_proveedor`),
  KEY `id_inventario` (`id_inventario`),
  CONSTRAINT `tbl_compras_inventario` FOREIGN KEY (`id_inventario`) REFERENCES `tbl_inventario` (`id_inventario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_compras_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id_proveedor`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_compras VALUES("1","1","1","35","15","2020-12-08 12:41:07");
INSERT INTO tbl_compras VALUES("2","1","2","15","700","2020-12-08 12:50:57");
INSERT INTO tbl_compras VALUES("3","1","1","20","300","2020-12-08 13:46:35");
INSERT INTO tbl_compras VALUES("11","1","7","15","650","2020-12-14 23:02:20");
INSERT INTO tbl_compras VALUES("12","1","7","15","650","2020-12-14 23:03:26");
INSERT INTO tbl_compras VALUES("14","16","10","40","9","2021-01-04 19:35:06");
INSERT INTO tbl_compras VALUES("15","20","1","20","10","2021-01-04 19:45:45");
INSERT INTO tbl_compras VALUES("16","1","10","50","10","2021-01-18 19:58:29");
INSERT INTO tbl_compras VALUES("17","1","1","1","5","2021-04-12 13:17:58");
INSERT INTO tbl_compras VALUES("18","1","1","1","5","2021-04-12 13:20:55");
INSERT INTO tbl_compras VALUES("19","1","1","2","5","2021-04-12 23:39:50");
INSERT INTO tbl_compras VALUES("20","1","1","1","5","2021-04-13 23:26:23");
INSERT INTO tbl_compras VALUES("21","1","1","1","5","2021-04-13 23:49:03");



DROP TABLE IF EXISTS tbl_descuento;

CREATE TABLE `tbl_descuento` (
  `id_descuento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_descuento` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `valor_descuento` decimal(10,0) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_descuento`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_usuarioclient` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_descuento VALUES("1","2x1","50","1","2020-12-04 23:19:49","");
INSERT INTO tbl_descuento VALUES("2","GRATIS","100","1","2020-12-04 23:20:57","");
INSERT INTO tbl_descuento VALUES("3","TERCERA EDAD","35","1","2020-12-04 23:22:02","");
INSERT INTO tbl_descuento VALUES("6","DSF","32","0","2021-04-14 01:18:53","");



DROP TABLE IF EXISTS tbl_documento;

CREATE TABLE `tbl_documento` (
  `id_documento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_documento VALUES("1","IDENTIDAD","1","2020-12-28 14:26:39");
INSERT INTO tbl_documento VALUES("2","RTN","1","2020-12-28 14:26:39");
INSERT INTO tbl_documento VALUES("9","PASAPORTE","1","2021-01-05 14:01:48");
INSERT INTO tbl_documento VALUES("12","DSF","0","2021-04-14 01:24:57");
INSERT INTO tbl_documento VALUES("13","FFF","0","2021-04-14 01:25:31");



DROP TABLE IF EXISTS tbl_inscripcion;

CREATE TABLE `tbl_inscripcion` (
  `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_inscripcion` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio_inscripcion` float DEFAULT NULL,
  `cantidad_dias` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_inscripcion`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_usuaricliente` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_inscripcion VALUES("1","MENSUAL","300","30","1","2020-12-04 23:32:32","");
INSERT INTO tbl_inscripcion VALUES("2","QUINCENAL","180","15","1","2020-12-04 23:33:42","");
INSERT INTO tbl_inscripcion VALUES("3","DIARIA","25","1","1","2020-12-04 23:34:15","");



DROP TABLE IF EXISTS tbl_inventario;

CREATE TABLE `tbl_inventario` (
  `id_inventario` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_producto` int(11) DEFAULT NULL,
  `codigo` int(20) DEFAULT NULL,
  `nombre_producto` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `precio_venta` float DEFAULT NULL,
  `producto_minimo` int(11) DEFAULT NULL,
  `producto_maximo` int(11) DEFAULT NULL,
  `venta` int(45) DEFAULT 0,
  `devolucion` int(45) DEFAULT 0,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `precio_compra` int(11) NOT NULL,
  PRIMARY KEY (`id_inventario`),
  KEY `id_tipo_producto` (`id_tipo_producto`),
  CONSTRAINT `tbl_tipoproducto_iventario` FOREIGN KEY (`id_tipo_producto`) REFERENCES `tbl_tipo_producto` (`id_tipo_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_inventario VALUES("1","1","100","GATORADE","","77","30","20","70","4","0","2020-12-08 12:37:15","15");
INSERT INTO tbl_inventario VALUES("2","1","101","PROTEINA","","43","1750","20","50","5","1","2020-12-08 12:38:41","700");
INSERT INTO tbl_inventario VALUES("3","2","700","PESAS","","30","","15","40","0","0","2020-12-08 12:41:54","0");
INSERT INTO tbl_inventario VALUES("7","1","102","CARNITINA","","26","1299","10","30","4","0","2020-12-14 22:56:49","0");
INSERT INTO tbl_inventario VALUES("10","1","103","AGUA","","86","25","20","60","4","0","2020-12-29 13:50:45","0");
INSERT INTO tbl_inventario VALUES("15","2","701","CAMINADORA","","16","","","","0","0","2020-12-30 12:27:25","0");
INSERT INTO tbl_inventario VALUES("16","1","104","TORTILLAS MAIZ","","0","5","1","5","0","0","2021-04-13 23:28:26","0");
INSERT INTO tbl_inventario VALUES("17","1","105","TORTILLAS JA","","0","5","1","2","0","0","2021-04-13 23:30:45","0");
INSERT INTO tbl_inventario VALUES("18","2","702","BARRA","","0","","","","0","0","2021-04-13 23:35:23","0");
INSERT INTO tbl_inventario VALUES("19","2","703","BARRASS","","2","","","","0","0","2021-04-13 23:41:08","0");
INSERT INTO tbl_inventario VALUES("20","1","106","SAL","","0","5","1","2","0","0","2021-04-13 23:49:44","0");
INSERT INTO tbl_inventario VALUES("21","2","704","BARRAS","","2","","","","0","0","2021-04-13 23:51:17","0");



DROP TABLE IF EXISTS tbl_matricula;

CREATE TABLE `tbl_matricula` (
  `id_matricula` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_matricula` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio_matricula` float DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_matricula`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_usuario_matricula` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_matricula VALUES("1","Normal","50","1","2020-12-04 23:36:34","");



DROP TABLE IF EXISTS tbl_objetos;

CREATE TABLE `tbl_objetos` (
  `id_objeto` int(11) NOT NULL AUTO_INCREMENT,
  `objeto` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `link_objeto` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `icono` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_objeto`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_usuario_objeto` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_objetos VALUES("1","Dashboard","dashboard","fas fa-tachometer-alt","2020-12-04 23:40:13","1");
INSERT INTO tbl_objetos VALUES("2","Usuarios","usuarios","fas fa-users","2020-12-04 23:42:36","1");
INSERT INTO tbl_objetos VALUES("3","Clientes","clientes","fas fa-user-circle","2020-12-04 23:43:34","1");
INSERT INTO tbl_objetos VALUES("4","Administrar Clientes","clientes","fas fa-layer-group","2020-12-04 23:48:10","1");
INSERT INTO tbl_objetos VALUES("5","Clientes Inscripciones","clientes-inscripciones","fas fa-cart-plus","2020-12-04 23:49:40","1");
INSERT INTO tbl_objetos VALUES("6","Clientes Inscripciones Historico","clientes-inscripciones-historico","fas fa-sliders-h","2020-12-04 23:51:12","1");
INSERT INTO tbl_objetos VALUES("7","Clientes Pagos Historico","clientes-pagos-historico","fas fa-download","2020-12-04 23:53:24","1");
INSERT INTO tbl_objetos VALUES("8","Stock","stock","fas fa-bold","2020-12-04 23:54:21","1");
INSERT INTO tbl_objetos VALUES("9","Compras","compras","fas fa-layer-group","2021-01-06 13:27:18","1");
INSERT INTO tbl_objetos VALUES("10","Inventario","inventario","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("11","Productos","productos","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("12","Equipo","equipo","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("13","Ventas","venta","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("14","Administrar Ventas","administrar-ventas","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("15","Nueva Venta","crear-venta","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("16","Reporte de Ventas","reportes","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("17","Mantenimiento","mantenimiento ","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("18","Roles","rol","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("19","Administracion de Permisos","permisos-rol","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("20","Parametros","parametro","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("21","Inscripciones","inscripcion","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("22","Matricula","matricula","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("23","Descuentos","descuento","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("24","Documentos","documentos","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("25","Proveedores","proveedores","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("26","Bitacora","bitacora","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("27","Respaldo y Restauración","respaldo-restauracion","fas fa-layer-group","2021-01-06 13:35:33","1");
INSERT INTO tbl_objetos VALUES("28","Perfil","perfil","fas fa-layer-group","2021-01-07 12:59:16","1");
INSERT INTO tbl_objetos VALUES("29","Editar ventas","editar-venta","","2021-01-18 20:30:38","1");



DROP TABLE IF EXISTS tbl_pagos_cliente;

CREATE TABLE `tbl_pagos_cliente` (
  `id_pagos_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente_inscripcion` int(11) NOT NULL,
  `pago_matricula` float DEFAULT NULL,
  `pago_descuento` float DEFAULT NULL,
  `pago_inscripcion` float DEFAULT NULL,
  `pago_total` float DEFAULT NULL,
  `fecha_de_pago` date NOT NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pagos_cliente`),
  KEY `creado_por` (`creado_por`),
  KEY `id_cliente_inscripcion` (`id_cliente_inscripcion`),
  CONSTRAINT `tbl_pagos_cliente_ibfk_1` FOREIGN KEY (`id_cliente_inscripcion`) REFERENCES `tbl_cliente_inscripcion` (`id_cliente_inscripcion`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_usuario_pagos` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_pagos_cliente VALUES("4","1","50","25","300","325","2020-12-07","1");
INSERT INTO tbl_pagos_cliente VALUES("7","1","0","0","300","300","2020-12-07","");
INSERT INTO tbl_pagos_cliente VALUES("23","10","0","0","180","180","2020-12-07","");
INSERT INTO tbl_pagos_cliente VALUES("24","11","0","0","180","180","2020-12-07","");
INSERT INTO tbl_pagos_cliente VALUES("25","12","0","0","300","300","2020-12-07","");
INSERT INTO tbl_pagos_cliente VALUES("29","14","50","50","300","325","2020-12-07","");
INSERT INTO tbl_pagos_cliente VALUES("30","14","0","0","180","180","2020-12-07","");
INSERT INTO tbl_pagos_cliente VALUES("31","15","50","100","300","300","2020-12-07","");
INSERT INTO tbl_pagos_cliente VALUES("33","22","0","0","180","180","2020-12-07","");
INSERT INTO tbl_pagos_cliente VALUES("34","23","0","0","300","300","2020-12-07","");
INSERT INTO tbl_pagos_cliente VALUES("35","23","50","0","300","350","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("36","24","50","50","300","325","2020-07-08","");
INSERT INTO tbl_pagos_cliente VALUES("38","22","","","300","300","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("39","25","0","0","300","300","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("41","25","50","0","180","230","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("42","27","0","0","180","180","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("43","28","50","0","300","350","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("44","28","","","300","300","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("45","28","","","180","180","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("47","30","50","0","300","325","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("48","30","","","180","180","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("49","30","","","180","180","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("50","30","","","180","180","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("51","30","","","180","180","2020-12-08","");
INSERT INTO tbl_pagos_cliente VALUES("60","39","50","0","180","230","2020-12-10","");
INSERT INTO tbl_pagos_cliente VALUES("61","39","","","180","180","2020-12-10","");
INSERT INTO tbl_pagos_cliente VALUES("64","42","50","25","180","205","2020-12-30","");
INSERT INTO tbl_pagos_cliente VALUES("65","23","","","300","300","2020-12-30","");
INSERT INTO tbl_pagos_cliente VALUES("67","42","50","25","180","205","2021-01-03","");
INSERT INTO tbl_pagos_cliente VALUES("69","46","50","25","300","325","2021-01-03","");
INSERT INTO tbl_pagos_cliente VALUES("70","39","","","180","180","2021-01-19","");
INSERT INTO tbl_pagos_cliente VALUES("71","47","50","50","300","300","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("72","47","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("73","47","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("74","47","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("75","47","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("76","47","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("77","48","50","25","180","205","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("78","48","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("79","48","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("80","48","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("81","48","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("82","48","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("83","48","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("84","48","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("85","48","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("86","48","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("87","48","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("88","49","50","25","25","50","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("89","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("90","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("91","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("92","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("93","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("94","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("95","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("96","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("97","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("98","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("99","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("100","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("101","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("102","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("103","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("104","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("105","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("106","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("107","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("108","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("109","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("110","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("111","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("112","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("113","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("114","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("115","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("116","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("117","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("118","49","","","","","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("119","46","","","300","300","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("120","46","","","300","300","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("121","42","","","180","180","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("122","47","","","300","300","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("123","46","","","300","300","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("124","49","","","25","25","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("125","49","","","25","25","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("126","49","","","25","25","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("127","49","","","25","25","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("128","48","","","180","180","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("129","49","","","25","25","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("130","49","","","25","25","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("131","46","","","300","300","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("132","49","","","300","300","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("133","49","","","300","300","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("134","50","0","0","300","300","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("135","51","0","0","300","300","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("136","51","","","300","300","2021-04-12","");
INSERT INTO tbl_pagos_cliente VALUES("137","52","50","25","180","205","2021-04-13","");
INSERT INTO tbl_pagos_cliente VALUES("138","52","","","","","2021-04-13","");
INSERT INTO tbl_pagos_cliente VALUES("139","52","","","","","2021-04-13","");



DROP TABLE IF EXISTS tbl_parametros;

CREATE TABLE `tbl_parametros` (
  `id_parametro` int(11) NOT NULL AUTO_INCREMENT,
  `parametro` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `valor` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_parametro`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_usuario_parametro` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_parametros VALUES("1","ADMIN_CPASS","Grupo_6s","2020-12-04 23:57:16","");
INSERT INTO tbl_parametros VALUES("2","ADMIN_CORREO","grupo6ctrls@gmail.com","2020-12-04 23:58:17","");
INSERT INTO tbl_parametros VALUES("3","ADMIN_INTENTOS","3","2020-12-04 23:58:55","");
INSERT INTO tbl_parametros VALUES("4","ADMIN_VIGENCIA_CORREO","24","2020-12-05 00:00:41","");
INSERT INTO tbl_parametros VALUES("5","ADMIN_DIAS_VIGENCIA","365","2020-12-05 00:01:56","");
INSERT INTO tbl_parametros VALUES("6","ADMIN_CPUERTO","465","2020-12-05 00:03:19","");
INSERT INTO tbl_parametros VALUES("7","ADMIN_CHOST","smtp.gmail.com","2020-12-05 00:04:59","");
INSERT INTO tbl_parametros VALUES("8","ADMIN_CSMTP","ssl","2020-12-05 00:06:25","");
INSERT INTO tbl_parametros VALUES("9","ADMIN_PREGUNTAS","3","2020-12-05 00:07:19","");
INSERT INTO tbl_parametros VALUES("10","ADMIN_VIGENCIA_CLIENTE_MES","30","2020-12-05 00:08:26","");
INSERT INTO tbl_parametros VALUES("11","ADMIN_VIGENCIA_CLIENTE_QUINCENAL","15","2020-12-05 00:09:02","");
INSERT INTO tbl_parametros VALUES("12","ADMIN_VIGENCIA_CLIENTE_DIA","12","2020-12-05 00:09:32","");
INSERT INTO tbl_parametros VALUES("13","ADMIN_IMPUESTO","15","2020-12-05 00:10:12","");
INSERT INTO tbl_parametros VALUES("14","ADMIN_NOMBRE_EMPRESA","GIMNASIO LA ROCA ","2020-12-05 00:13:04","");
INSERT INTO tbl_parametros VALUES("15","ADMIN_DIRECCION_EMPRESA","COMAYAGUELA D.C BARRIO BELEN","2020-12-05 00:13:56","");
INSERT INTO tbl_parametros VALUES("16","ADMIN_TELEFONO_EMPRESA","(504) 9988-9999","2020-12-05 00:15:18","");
INSERT INTO tbl_parametros VALUES("17","ADMIN_RUTA_URL","localhost/Admin-Gym/","2021-01-07 17:24:13","1");



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
  KEY `id_rol` (`id_rol`),
  KEY `id_objeto` (`id_objeto`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_objeto_permisos` FOREIGN KEY (`id_objeto`) REFERENCES `tbl_objetos` (`id_objeto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_rol_permisos` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_usuario_permisos` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_permisos VALUES("1","1","1","1","1","1","1","2020-12-05 00:22:28","");
INSERT INTO tbl_permisos VALUES("2","1","2","1","1","1","1","2020-12-05 00:23:13","");
INSERT INTO tbl_permisos VALUES("3","1","3","1","1","1","1","2020-12-05 00:23:44","");
INSERT INTO tbl_permisos VALUES("4","1","4","1","1","1","1","2020-12-05 00:23:54","");
INSERT INTO tbl_permisos VALUES("5","1","5","1","1","1","1","2020-12-05 00:24:06","");
INSERT INTO tbl_permisos VALUES("6","1","6","1","1","1","1","2020-12-05 00:24:18","");
INSERT INTO tbl_permisos VALUES("7","1","7","1","1","1","1","2020-12-05 00:24:27","");
INSERT INTO tbl_permisos VALUES("8","1","8","1","1","1","1","2020-12-05 00:24:40","");
INSERT INTO tbl_permisos VALUES("19","7","13","1","0","0","1","2020-12-25 19:15:56","");
INSERT INTO tbl_permisos VALUES("20","7","14","1","1","1","1","2020-12-25 19:17:26","");
INSERT INTO tbl_permisos VALUES("21","7","15","0","0","0","1","2020-12-25 19:23:38","");
INSERT INTO tbl_permisos VALUES("24","1","9","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("25","1","10","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("26","1","11","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("27","1","12","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("28","1","13","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("29","1","14","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("30","1","15","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("31","1","16","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("32","1","17","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("33","1","19","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("34","1","20","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("35","1","21","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("36","1","22","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("37","1","23","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("38","1","24","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("39","1","25","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("40","1","26","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("41","1","27","1","1","1","1","2021-01-06 16:45:19","1");
INSERT INTO tbl_permisos VALUES("42","1","28","1","1","1","1","2021-01-07 13:00:51","1");
INSERT INTO tbl_permisos VALUES("43","15","1","0","0","0","1","2021-01-15 18:59:15","");
INSERT INTO tbl_permisos VALUES("44","1","18","1","1","1","1","2021-01-18 18:28:30","1");
INSERT INTO tbl_permisos VALUES("45","1","29","1","1","1","1","2021-01-18 20:31:54","1");
INSERT INTO tbl_permisos VALUES("46","16","1","0","0","1","0","2021-04-14 00:31:43","");
INSERT INTO tbl_permisos VALUES("47","18","1","0","0","0","1","2021-04-14 00:40:07","");
INSERT INTO tbl_permisos VALUES("48","19","1","1","1","1","1","2021-04-14 00:42:00","");
INSERT INTO tbl_permisos VALUES("49","20","1","0","0","0","1","2021-04-14 00:47:28","");



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
  KEY `id_documento` (`id_documento`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_documento_personas` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documento` (`id_documento`) ON UPDATE CASCADE,
  CONSTRAINT `tbl_usuario_personas` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_personas VALUES("1","Super","Admin","1","000000000","usuarios","0000-00-00","","","","superadmin@correo.com","2020-12-05 00:30:28","");
INSERT INTO tbl_personas VALUES("22","JESUS","ZUNIGA","1","0801199907678","usuarios","1990-01-22","M","(504) 9999-9999","VALLE","jesus.zuniga077@gmail.com","2020-12-05 19:09:02","1");
INSERT INTO tbl_personas VALUES("30","MARIA","AMADOR","2","0801199907645","clientes","1960-09-09","M","(504) 9966-7788","VALLES","maria@correo.com","2020-12-06 08:39:58","");
INSERT INTO tbl_personas VALUES("31","JOSUE","ORTEZ","1","0801199489746","clientes","1999-09-09","M","(504) 9999-9999","VALLE","carlos@gmail.com","2020-12-06 21:26:05","");
INSERT INTO tbl_personas VALUES("32","JUAN","ROSALES","1","0801199998881","clientes","1999-09-09","M","(504) 9999-9999","VALLE","juan@yahoo.es","2020-12-07 08:10:47","");
INSERT INTO tbl_personas VALUES("34","BARBARA","RUBIO","1","0801199507334","clientes","1999-09-09","F","(504) 9999-9999","VALLE DE ANGELES","barb@gmail.com","2020-12-08 07:57:21","");
INSERT INTO tbl_personas VALUES("39","MARIO","LOPEZ","1","0801199489743","clientes","1989-09-09","M","(504) 9999-9999","VALLE","mario@correo.com","2020-12-08 15:49:22","");
INSERT INTO tbl_personas VALUES("40","INFORMATICA","INFORMATICA","1","0801199507364","clientes","1999-09-09","M","(504) 9999-9999","VALLE","informatica@gmail.com","2020-12-08 17:15:48","");
INSERT INTO tbl_personas VALUES("54","FERNANDA","ZUNIGA","1","0801199507362","clientes","1999-09-09","F","(504) 8888-8888","VALL","fer@gmail.com","2020-12-10 16:11:59","");
INSERT INTO tbl_personas VALUES("56","PRUEBA","PRUEBA","1","0801199507365","ambos","1999-09-09","M","(504) 9999-9999","VALLE","prueba@yahoo.es","2020-12-14 23:11:59","");
INSERT INTO tbl_personas VALUES("58","NUEVO","NUEVOS","1","0801199489744","usuarios","1994-09-09","M","(504) 9999-9999","VALLE DE ANGELES","jeduardo@correo.com","2020-12-30 13:11:12","");
INSERT INTO tbl_personas VALUES("63","CLIENTE ","VENTAS","1","213233222","clientes","1998-03-31","M","(504) 9999-9999","SDDDSS","cliente-v@correo.com","2021-01-18 20:22:17","");
INSERT INTO tbl_personas VALUES("64","OTTO","GONZALES","1","0102323232","clientes","1990-02-02","M","(504) 3334-4444","HNS","gonzalesoctavio885@gmail.com","2021-04-12 00:56:44","");
INSERT INTO tbl_personas VALUES("65","LUIS","GONZALES","1","0102323232343","clientes","1990-03-03","M","(504) 3333-3333","H","hola@dg.com","2021-04-12 00:58:20","");
INSERT INTO tbl_personas VALUES("66","OCTAVIO","GONZALES","1","01023232321","clientes","1990-03-03","M","(504) 2222-2222","E","hola@dg.comd","2021-04-12 02:43:41","");
INSERT INTO tbl_personas VALUES("67","LUIS","GONZALES","1","0102323232324","clientes","1990-03-03","M","(504) 1223-3456","2","hola@dg.comdd","2021-04-12 02:45:11","");
INSERT INTO tbl_personas VALUES("71","BITACORA","BITACORA","1","010232323221321","usuarios","1990-03-03","M","(332) 4423-4324","D","hola@dg.comdsd","2021-04-13 17:30:27","");
INSERT INTO tbl_personas VALUES("73","LUIS","GONZALES","1","010232323212","usuarios","1990-03-03","M","(342) 4343-2432","H","hola@dg.coms","2021-04-13 17:36:14","");
INSERT INTO tbl_personas VALUES("74","LUIS","GONZALES","1","0102323232322","clientes","1990-03-03","M","(504) 2222-2222","D","hola@dg.coma","2021-04-13 23:04:13","");
INSERT INTO tbl_personas VALUES("75","BITACORA","GONZALES","1","01023232321223434343","clientes","1990-04-04","M","(504) 3333-3333","SD","hola@dg.comdds","2021-04-13 23:10:07","");
INSERT INTO tbl_personas VALUES("76","OTTO","GONZALES","1","12321","clientes","1990-02-02","M","(504) 3333-3333","F","hola@dg.cos","2021-04-13 23:13:12","");
INSERT INTO tbl_personas VALUES("77","BITACORA","GONZALES","1","01023232323121","clientes","1990-03-03","M","(504) 4444-4444","D","hola@dg.comsw","2021-04-13 23:15:42","");
INSERT INTO tbl_personas VALUES("78","LUISR","GONZALES","1","010232323212313","clientes","1990-02-02","M","(504) 4444-4444","DFF","hola@dgsd.comd","2021-04-13 23:17:15","");



DROP TABLE IF EXISTS tbl_preguntas;

CREATE TABLE `tbl_preguntas` (
  `id_preguntas` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_preguntas`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_usuario_preguntas` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_preguntas VALUES("1","¿Escuela a la que asistía de pequeño?","2020-12-05 00:33:16","");
INSERT INTO tbl_preguntas VALUES("2","¿Héroe favorito?","2020-12-05 00:33:46","");
INSERT INTO tbl_preguntas VALUES("3","¿Color favorito?","2020-12-05 00:34:30","");
INSERT INTO tbl_preguntas VALUES("4","¿Cuál era el nombre de tu primera mascota?","2020-12-05 00:35:00","");
INSERT INTO tbl_preguntas VALUES("5","¿Dónde fuiste de vacaciones el año pasado?","2020-12-05 00:36:00","");



DROP TABLE IF EXISTS tbl_preguntas_usuarios;

CREATE TABLE `tbl_preguntas_usuarios` (
  `id_preguntas_usuarios` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_preguntas` int(11) DEFAULT NULL,
  `respuesta` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_preguntas_usuarios`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_preguntas` (`id_preguntas`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_pregunta_preguntausua` FOREIGN KEY (`id_preguntas`) REFERENCES `tbl_preguntas` (`id_preguntas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_usua_preguntausuario` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_usuario_preguntausua` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_preguntas_usuarios VALUES("1","2","1","ELVEL","2020-12-14 23:14:18","");
INSERT INTO tbl_preguntas_usuarios VALUES("2","2","3","AZUL","2020-12-14 23:14:18","");
INSERT INTO tbl_preguntas_usuarios VALUES("3","2","5","ROATAN","2020-12-14 23:14:18","");
INSERT INTO tbl_preguntas_usuarios VALUES("4","4","2","BATMAN","2021-01-02 20:23:02","");
INSERT INTO tbl_preguntas_usuarios VALUES("5","4","3","NEGRO","2021-01-02 20:23:02","");
INSERT INTO tbl_preguntas_usuarios VALUES("6","4","5","PARIS","2021-01-02 20:23:02","");



DROP TABLE IF EXISTS tbl_proveedores;

CREATE TABLE `tbl_proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_proveedores VALUES("1","ECO","eco@gmail.com","(504) 9988-9977");
INSERT INTO tbl_proveedores VALUES("16","NUEVO NUEVO","nuevoprov@correo.es","(504) 8899-9888");
INSERT INTO tbl_proveedores VALUES("20","PROVEEDOR","prov@correo.es","(504) 8877-6655");
INSERT INTO tbl_proveedores VALUES("23","LEYDE","ley@correo.com","(504) 9999-9999");
INSERT INTO tbl_proveedores VALUES("24","PRUEBA","prueba@correo.com","(504) 8899-8899");



DROP TABLE IF EXISTS tbl_roles;

CREATE TABLE `tbl_roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `descripcion` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `estado` int(15) NOT NULL,
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rol`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_usuario_rol` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_roles VALUES("1","Administrador","2020-12-05 00:19:03","TODOS LOS PERMISOS","1","");
INSERT INTO tbl_roles VALUES("2","Default","2020-12-05 00:19:53","NO TIENE PERMISOS","1","");
INSERT INTO tbl_roles VALUES("7","VENDEDOR","2020-12-25 19:15:32","PERMISOS EN VENTAS","1","");
INSERT INTO tbl_roles VALUES("15","NUEVO","2021-01-15 18:53:02","NUEVON","0","");
INSERT INTO tbl_roles VALUES("16","ROL","2021-04-14 00:31:29","ROL","0","");
INSERT INTO tbl_roles VALUES("17","BB","2021-04-14 00:36:40","BB","0","");
INSERT INTO tbl_roles VALUES("18","FF","2021-04-14 00:39:55","FF","0","");
INSERT INTO tbl_roles VALUES("19","D","2021-04-14 00:41:48","DD","1","");
INSERT INTO tbl_roles VALUES("20","B","2021-04-14 00:47:18","JJ","0","");



DROP TABLE IF EXISTS tbl_tipo_producto;

CREATE TABLE `tbl_tipo_producto` (
  `id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_producto` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_producto`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_usuario_tipo_producto` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_tipo_producto VALUES("1","Productos","2020-12-05 00:38:32","");
INSERT INTO tbl_tipo_producto VALUES("2","Bodega","2020-12-05 00:39:11","");



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
  KEY `id_persona` (`id_persona`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `tbl_persona_usuario` FOREIGN KEY (`id_persona`) REFERENCES `tbl_personas` (`id_personas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_rol_usuario` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_usuarios VALUES("1","1","SUPERADMIN","$2a$07$asxx54ahjppf45sd87a5au.1UP6zDSXc3b.CkjVjQR/OCpZlYz4hq","vistas/img/usuarios/SUPERADMIN/854.jpg","1","0","","","","2021-04-12 10:21:26","1");
INSERT INTO tbl_usuarios VALUES("2","56","PRUE","$2a$07$asxx54ahjppf45sd87a5auLPjFcMng9ID3.WybWFciH86yMkmyp.a","","1","0","","","2021-12-14","2020-12-14 23:14:52","1");
INSERT INTO tbl_usuarios VALUES("4","22","JEZA","$2a$07$asxx54ahjppf45sd87a5auN3t3yXm6O1JtaIBD.zHOTFO6UU.UNtO","vistas/img/usuarios/JEZA/665.jpg","1","0","pFCWmaw4sDno6ks","2021-01-21 13:46:02","2022-01-10","2021-01-20 13:34:40","1");
INSERT INTO tbl_usuarios VALUES("7","58","NUEVO","$2a$07$asxx54ahjppf45sd87a5aurW0a0pm4xJRC7yilX39iODRoKVib/cu","","0","1","","","2022-01-03","","7");
INSERT INTO tbl_usuarios VALUES("11","71","BITACORA","$2a$07$asxx54ahjppf45sd87a5auQsyitU.o11.NXbGI3nc9DCthYgFJwF2","","0","1","","","2022-04-13","","1");
INSERT INTO tbl_usuarios VALUES("13","73","INGRESAR","$2a$07$asxx54ahjppf45sd87a5auQsyitU.o11.NXbGI3nc9DCthYgFJwF2","","0","1","","","2022-04-13","","1");



DROP TABLE IF EXISTS tbl_venta;

CREATE TABLE `tbl_venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `numero_factura` int(11) NOT NULL,
  `productos` varchar(1000) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `impuesto` float DEFAULT NULL,
  `neto` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_venta`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `tbl_cliente_venta` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_usuario_venta` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_venta VALUES("1","22","1","1001","[{\"id\":\"1\",\"descripcion\":\"GATORADE\",\"cantidad\":\"1\",\"stock\":\"34\",\"precio\":\"30\",\"total\":\"30\"}]","4.5","30","35","2020-12-08 12:43:11");
INSERT INTO tbl_venta VALUES("2","15","1","1002","[{\"id\":\"2\",\"descripcion\":\"PROTEINA\",\"cantidad\":\"2\",\"stock\":\"47\",\"precio\":\"1750\",\"total\":\"3500\"}]","525","3500","4025","2020-12-30 14:02:58");
INSERT INTO tbl_venta VALUES("3","15","1","1003","[{\"id\":\"1\",\"descripcion\":\"GATORADE\",\"cantidad\":\"1\",\"stock\":\"53\",\"precio\":\"30\",\"total\":\"30\"},{\"id\":\"7\",\"descripcion\":\"CARNITINA\",\"cantidad\":\"1\",\"stock\":\"29\",\"precio\":\"1299\",\"total\":\"1299\"}]","199.35","1329","1528","2020-12-30 14:07:28");
INSERT INTO tbl_venta VALUES("4","15","1","1004","[{\"id\":\"7\",\"descripcion\":\"CARNITINA\",\"cantidad\":\"1\",\"stock\":\"28\",\"precio\":\"1299\",\"total\":\"1299\"}]","194.85","1299","1494","2020-12-30 17:08:21");
INSERT INTO tbl_venta VALUES("5","39","1","1005","[{\"id\":\"2\",\"descripcion\":\"PROTEINA\",\"cantidad\":\"1\",\"stock\":\"46\",\"precio\":\"1750\",\"total\":\"1750\"}]","262.5","1750","2012.5","2020-12-30 17:09:50");
INSERT INTO tbl_venta VALUES("7","36","1","1006","[{\"id\":\"2\",\"descripcion\":\"PROTEINA\",\"cantidad\":\"1\",\"stock\":\"45\",\"precio\":\"1750\",\"total\":\"1750\"},{\"id\":\"1\",\"descripcion\":\"GATORADE\",\"cantidad\":\"2\",\"stock\":\"72\",\"precio\":\"30\",\"total\":\"60\"}]","271.5","1810","2081.5","2021-01-18 20:28:59");
INSERT INTO tbl_venta VALUES("8","21","1","1007","[{\"id\":\"1\",\"descripcion\":\"GATORADE\",\"cantidad\":\"1\",\"stock\":\"73\",\"precio\":\"30\",\"total\":\"30\"}]","4.5","30","34.5","2021-04-12 23:39:07");
INSERT INTO tbl_venta VALUES("9","21","1","1008","[{\"id\":\"2\",\"descripcion\":\"PROTEINA\",\"cantidad\":\"1\",\"stock\":\"44\",\"precio\":\"1750\",\"total\":\"1750\"}]","262.5","1750","2012.5","2021-04-12 23:56:54");
INSERT INTO tbl_venta VALUES("10","25","1","1009","[{\"id\":\"7\",\"descripcion\":\"CARNITINA\",\"cantidad\":\"1\",\"stock\":\"27\",\"precio\":\"1299\",\"total\":\"1299\"}]","194.85","1299","1493.85","2021-04-13 23:53:26");
INSERT INTO tbl_venta VALUES("11","21","1","1009","[{\"id\":\"2\",\"descripcion\":\"PROTEINA\",\"cantidad\":\"1\",\"stock\":\"43\",\"precio\":\"1750\",\"total\":\"1750\"}]","262.5","1750","2012.5","2021-04-13 23:53:41");
INSERT INTO tbl_venta VALUES("13","22","1","1011","[{\"id\":\"7\",\"descripcion\":\"CARNITINA\",\"cantidad\":\"1\",\"stock\":\"26\",\"precio\":\"1299\",\"total\":\"1299\"}]","194.85","1299","1493.85","2021-04-13 23:55:08");
INSERT INTO tbl_venta VALUES("14","21","1","1012","[{\"id\":\"10\",\"descripcion\":\"AGUA\",\"cantidad\":\"1\",\"stock\":\"89\",\"precio\":\"25\",\"total\":\"25\"}]","3.75","25","28.75","2021-04-14 00:02:24");
INSERT INTO tbl_venta VALUES("15","21","1","1013","[{\"id\":\"10\",\"descripcion\":\"AGUA\",\"cantidad\":\"1\",\"stock\":\"88\",\"precio\":\"25\",\"total\":\"25\"}]","3.75","25","28.75","2021-04-14 00:04:05");
INSERT INTO tbl_venta VALUES("16","21","1","1014","[{\"id\":\"10\",\"descripcion\":\"AGUA\",\"cantidad\":\"1\",\"stock\":\"87\",\"precio\":\"25\",\"total\":\"25\"}]","3.75","25","28.75","2021-04-14 00:05:03");
INSERT INTO tbl_venta VALUES("20","21","1","1018","[{\"id\":\"10\",\"descripcion\":\"AGUA\",\"cantidad\":\"1\",\"stock\":\"86\",\"precio\":\"25\",\"total\":\"25\"}]","3.75","25","28.75","2021-04-14 00:13:33");



SET FOREIGN_KEY_CHECKS=1;