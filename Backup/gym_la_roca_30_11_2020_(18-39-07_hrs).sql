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
  KEY `fk_id_objetobitacora` (`id_objeto`),
  KEY `fk_id_usuariobitacora` (`id_usuario`) USING BTREE,
  CONSTRAINT `tbl_bitacora_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_bitacora_ibfk_3` FOREIGN KEY (`id_objeto`) REFERENCES `tbl_objetos` (`id_objeto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_bitacora VALUES("1","2020-11-30 00:00:00","1","6","Ingreso"," Ingreso a Login");
INSERT INTO tbl_bitacora VALUES("2","2020-11-30 00:00:00","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("3","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("4","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("5","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("6","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("7","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("8","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("9","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("10","2020-11-30 00:00:00","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("11","2020-11-30 00:00:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("12","2020-11-30 00:00:00","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("13","2020-11-30 00:00:00","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("14","2020-11-30 00:00:00","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("15","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("16","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("17","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("18","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("19","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("20","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("21","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("22","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("23","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("24","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("25","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("26","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("27","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("28","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("29","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("30","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("31","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("32","2020-11-30 00:00:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("33","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("34","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("35","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("36","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("37","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("38","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("39","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("40","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("41","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("42","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("43","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("44","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("45","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("46","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("47","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("48","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("49","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("50","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("51","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("52","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("53","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("54","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("55","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("56","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("57","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("58","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("59","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("60","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("61","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("62","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("63","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("64","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("65","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("66","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("67","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("68","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("69","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("70","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("71","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("72","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("73","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("74","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("75","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("76","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("77","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("78","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("79","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("80","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("81","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("82","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("83","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("84","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("85","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("86","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("87","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("88","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("89","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("90","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("91","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("92","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("93","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("94","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("95","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("96","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("97","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("98","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("99","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("100","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("101","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("102","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("103","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("104","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("105","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("106","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("107","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("108","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("109","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("110","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("111","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("112","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("113","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("114","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("115","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("116","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("117","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("118","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("119","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("120","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("121","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("122","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("123","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("124","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("125","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("126","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("127","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("128","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("129","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("130","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("131","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("132","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("133","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("134","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("135","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("136","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("137","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("138","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("139","2020-11-30 00:00:00","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("140","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("141","2020-11-30 00:00:00","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("154","2020-11-30 00:00:00","1","6","Ingreso"," Ingreso a Login");
INSERT INTO tbl_bitacora VALUES("155","2020-11-30 00:00:00","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("156","2020-11-30 00:00:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("157","2020-11-30 00:00:00","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("158","2020-11-30 17:10:36","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("159","2020-11-30 17:11:29","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("160","2020-11-30 17:14:53","1","4","Nuevo","  Nuevo Producto");
INSERT INTO tbl_bitacora VALUES("161","2020-11-30 17:15:30","1","2","Actualizo","Actualizo un equipo del stock");
INSERT INTO tbl_bitacora VALUES("162","2020-11-30 17:18:49","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("163","2020-11-30 17:20:52","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("164","2020-11-30 17:21:48","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("165","2020-11-30 17:21:48","1","5","Nueva","Nueva venta ");
INSERT INTO tbl_bitacora VALUES("166","2020-11-30 17:21:53","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("167","2020-11-30 17:22:45","1","5","Actualizo","Actualizo una venta");
INSERT INTO tbl_bitacora VALUES("168","2020-11-30 17:22:50","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("169","2020-11-30 17:30:09","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("170","2020-11-30 17:30:39","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("171","2020-11-30 17:30:53","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("172","2020-11-30 17:30:56","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("173","2020-11-30 17:31:43","1","4","Nuevo","  Nuevo Producto");
INSERT INTO tbl_bitacora VALUES("174","2020-11-30 17:31:51","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("175","2020-11-30 17:31:54","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("176","2020-11-30 17:34:24","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("177","2020-11-30 17:34:37","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("178","2020-11-30 17:35:06","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("179","2020-11-30 17:35:35","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("180","2020-11-30 17:35:55","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("181","2020-11-30 17:36:13","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("182","2020-11-30 17:36:13","1","5","Nueva","Nueva venta ");
INSERT INTO tbl_bitacora VALUES("183","2020-11-30 17:36:17","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("184","2020-11-30 17:36:48","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("185","2020-11-30 17:36:51","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("186","2020-11-30 17:37:01","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("187","2020-11-30 17:37:06","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("188","2020-11-30 17:37:09","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("189","2020-11-30 17:37:14","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("190","2020-11-30 17:37:18","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("191","2020-11-30 17:39:47","1","4","Nuevo","  Nuevo Producto");
INSERT INTO tbl_bitacora VALUES("192","2020-11-30 17:40:37","1","4","Nuevo","  Nuevo Producto");
INSERT INTO tbl_bitacora VALUES("193","2020-11-30 17:40:44","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("194","2020-11-30 17:40:53","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("195","2020-11-30 17:42:00","1","4","Nuevo","  Nuevo Producto");
INSERT INTO tbl_bitacora VALUES("196","2020-11-30 17:42:37","1","4","Nuevo","  Nuevo Producto");
INSERT INTO tbl_bitacora VALUES("197","2020-11-30 17:42:46","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("198","2020-11-30 17:42:50","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("199","2020-11-30 17:43:04","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("200","2020-11-30 17:43:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("201","2020-11-30 17:44:53","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("202","2020-11-30 17:45:48","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("203","2020-11-30 17:46:02","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("204","2020-11-30 17:46:11","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("205","2020-11-30 17:46:13","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("206","2020-11-30 17:46:13","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("207","2020-11-30 17:47:40","1","1","salir"," Salio del sistema");
INSERT INTO tbl_bitacora VALUES("208","2020-11-30 17:47:57","1","6","Ingreso"," Ingreso a Login");
INSERT INTO tbl_bitacora VALUES("209","2020-11-30 17:47:59","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("210","2020-11-30 17:48:04","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("211","2020-11-30 17:48:04","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("212","2020-11-30 17:48:06","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("213","2020-11-30 17:48:38","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("214","2020-11-30 17:48:42","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("215","2020-11-30 17:58:22","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("216","2020-11-30 17:58:31","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("217","2020-11-30 17:58:32","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("218","2020-11-30 18:01:07","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("219","2020-11-30 18:01:49","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("220","2020-11-30 18:01:52","1","2","Nuevo","Nuevo Usuario");
INSERT INTO tbl_bitacora VALUES("221","2020-11-30 18:01:55","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("222","2020-11-30 18:02:02","1","1","salir"," Salio del sistema");
INSERT INTO tbl_bitacora VALUES("223","2020-11-30 18:02:15","11","6","Ingreso"," Ingreso a Login");
INSERT INTO tbl_bitacora VALUES("224","2020-11-30 18:02:16","11","6","Ingreso"," Primer Ingreso");
INSERT INTO tbl_bitacora VALUES("225","2020-11-30 18:02:58","11","6","Ingreso"," Primer Ingreso");
INSERT INTO tbl_bitacora VALUES("226","2020-11-30 18:02:58","11","1","salir"," Salio del sistema");
INSERT INTO tbl_bitacora VALUES("227","2020-11-30 18:03:14","11","6","Ingreso"," Ingreso a Login");
INSERT INTO tbl_bitacora VALUES("228","2020-11-30 18:03:16","11","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("229","2020-11-30 18:03:20","11","7","Consulta","Consulta a Perfil");
INSERT INTO tbl_bitacora VALUES("230","2020-11-30 18:03:33","11","1","salir"," Salio del sistema");
INSERT INTO tbl_bitacora VALUES("231","2020-11-30 18:03:42","1","6","Ingreso"," Ingreso a Login");
INSERT INTO tbl_bitacora VALUES("232","2020-11-30 18:03:44","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("233","2020-11-30 18:11:44","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("234","2020-11-30 18:18:16","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("235","2020-11-30 18:18:16","1","3","Nuevo","Nuevo cliente");
INSERT INTO tbl_bitacora VALUES("236","2020-11-30 18:18:19","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("237","2020-11-30 18:19:21","1","5","consulta"," Consulto la pantalla de crear ventas");
INSERT INTO tbl_bitacora VALUES("238","2020-11-30 18:19:21","1","5","Nueva","Nueva venta ");
INSERT INTO tbl_bitacora VALUES("239","2020-11-30 18:19:49","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("240","2020-11-30 18:25:28","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("241","2020-11-30 18:30:04","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("242","2020-11-30 18:32:14","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("243","2020-11-30 18:32:14","1","6","Nuevo","Nuevo rol ");
INSERT INTO tbl_bitacora VALUES("244","2020-11-30 18:32:18","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("245","2020-11-30 18:36:54","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("246","2020-11-30 18:36:55","1","6","Nuevo","Nueva matricula del gimnasio");
INSERT INTO tbl_bitacora VALUES("247","2020-11-30 18:37:05","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("248","2020-11-30 18:37:51","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("249","2020-11-30 18:37:51","1","6","Actualizo","Actualizo parametro");
INSERT INTO tbl_bitacora VALUES("250","2020-11-30 18:37:53","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("251","2020-11-30 18:38:43","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("252","2020-11-30 18:38:43","1","7","consulta"," Consulto la pantalla de Restauracion");



DROP TABLE IF EXISTS tbl_clientes;

CREATE TABLE `tbl_clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) DEFAULT NULL,
  `tipo_cliente` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_inscripcion` int(11) DEFAULT NULL,
  `id_matricula` int(11) DEFAULT NULL,
  `id_descuento` int(11) DEFAULT NULL,
  `fecha_inscripcion` date NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  `compras` int(11) DEFAULT NULL,
  `ultima_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_cliente`),
  KEY `id_inscripcion` (`id_inscripcion`),
  KEY `id_matricula` (`id_matricula`),
  KEY `id_descuento` (`id_descuento`),
  KEY `creado_por` (`creado_por`),
  KEY `id_persona` (`id_persona`) USING BTREE,
  CONSTRAINT `fk_id_descuento` FOREIGN KEY (`id_descuento`) REFERENCES `tbl_descuento` (`id_descuento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_inscripcion` FOREIGN KEY (`id_inscripcion`) REFERENCES `tbl_inscripcion` (`id_inscripcion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_matricula` FOREIGN KEY (`id_matricula`) REFERENCES `tbl_matricula` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_id_persona` FOREIGN KEY (`id_persona`) REFERENCES `tbl_personas` (`id_personas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fkl_id_creado` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_clientes VALUES("5","19","Gimnasio","2","1","1","2020-11-30","1","2020-11-30 13:27:03","","22","2020-11-30 13:27:03");
INSERT INTO tbl_clientes VALUES("6","20","Ventas","","","","2020-11-30","1","2020-11-30 13:54:14","","16","2020-11-30 14:55:06");
INSERT INTO tbl_clientes VALUES("8","26","","","","","2020-11-30","1","2020-11-30 14:51:25","","12","2020-11-30 14:55:06");
INSERT INTO tbl_clientes VALUES("9","27","","","","","2020-11-30","1","2020-11-30 15:08:34","","32","2020-11-30 17:22:45");
INSERT INTO tbl_clientes VALUES("10","29","","","","","2020-11-30","1","2020-11-30 18:18:16","","2","2020-11-30 18:18:16");



DROP TABLE IF EXISTS tbl_descuento;

CREATE TABLE `tbl_descuento` (
  `id_descuento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_descuento` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `valor_descuento` decimal(10,0) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_descuento`),
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `tbl_descuento_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_descuento VALUES("1","2x1","50","0","2020-11-21 17:49:59","");
INSERT INTO tbl_descuento VALUES("2","gratis","0","0","2020-11-21 17:49:59","");
INSERT INTO tbl_descuento VALUES("3","tercera edad","25","0","2020-11-21 17:49:59","");



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
  `estado` int(11) NOT NULL DEFAULT 0,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_inscripcion`),
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `tbl_inscripcion_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_inscripcion VALUES("1","mensual","300","0","","");
INSERT INTO tbl_inscripcion VALUES("2","quincenal","180","0","","");
INSERT INTO tbl_inscripcion VALUES("3","diaria","20","0","","");



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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_inventario VALUES("1","1","100","PROTEINA","","36","1000","10","30","3","2020-11-21 18:00:05");
INSERT INTO tbl_inventario VALUES("5","1","102","AGUA","vistas/img/productos/PESAS/743.jpg","0","1200","2","8","2","2020-11-30 17:14:53");
INSERT INTO tbl_inventario VALUES("6","1","103","GATORADE","","49","20","20","50","","2020-11-30 17:31:43");
INSERT INTO tbl_inventario VALUES("7","1","104","BANANA","","40","5","15","50","","2020-11-30 17:39:47");
INSERT INTO tbl_inventario VALUES("8","1","105","JUGO","","10","150","10","40","","2020-11-30 17:40:37");
INSERT INTO tbl_inventario VALUES("9","1","106","YOGURT","","30","20","20","50","","2020-11-30 17:42:00");
INSERT INTO tbl_inventario VALUES("10","2","700","PESAS","","50","150","40","100","","2020-11-30 17:42:37");



DROP TABLE IF EXISTS tbl_matricula;

CREATE TABLE `tbl_matricula` (
  `id_matricula` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_matricula` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio_matricula` float DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_matricula`),
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  CONSTRAINT `tbl_matricula_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_matricula VALUES("1","Normal","50","0","2020-11-21 17:48:32","");
INSERT INTO tbl_matricula VALUES("2","INFORMATICA","50","0","2020-11-30 18:36:55","");



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
  CONSTRAINT `tbl_objetos_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_objetos VALUES("1","Dashboard","dashboard","fas fa-tachometer-alt","2020-11-30 05:59:00","");
INSERT INTO tbl_objetos VALUES("2","Usuarios","usuarios","fas fa-users","2020-11-30 05:59:00","");
INSERT INTO tbl_objetos VALUES("3","Clientes","Clientes","fas fa-user-circle","2020-11-30 05:59:00","");
INSERT INTO tbl_objetos VALUES("4","Stock","stock","fas fa-layer-group","2020-11-30 05:59:00","");
INSERT INTO tbl_objetos VALUES("5","Ventas","ventas","fas fa-cart-plus","2020-11-30 05:59:00","");
INSERT INTO tbl_objetos VALUES("6","Mantenimiento","mantenimiento","fas fa-sliders-h","2020-11-30 05:59:00","");
INSERT INTO tbl_objetos VALUES("7","Respaldo y Restauracion","respaldoyrestauracion","fas fa-download","2020-11-30 06:02:25","");
INSERT INTO tbl_objetos VALUES("8","Bitacora","bitacora","fas fa-bold","2020-11-30 06:02:25","");



DROP TABLE IF EXISTS tbl_pagos_cliente;

CREATE TABLE `tbl_pagos_cliente` (
  `id_pagos_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `pago_matricula` float NOT NULL,
  `pago_descuento` float NOT NULL,
  `pago_inscripcion` float NOT NULL,
  `pago_total` float DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pagos_cliente`),
  KEY `id_cliente` (`id_cliente`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_pagos_cliente_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_pagos_cliente_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_pagos_cliente VALUES("4","5","0","0","0","0","2020-12-01","");
INSERT INTO tbl_pagos_cliente VALUES("5","6","0","0","0","0","2020-12-01","");



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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_parametros VALUES("10","ADMIN_CPASS","Grupo_6s","2020-11-21 18:08:49","");
INSERT INTO tbl_parametros VALUES("11","ADMIN_CORREO","grupo6ctrls@gmail.com","2020-11-21 18:08:49","");
INSERT INTO tbl_parametros VALUES("12","ADMIN_INTENTOS","0","2020-11-22 00:22:20","");
INSERT INTO tbl_parametros VALUES("13","ADMIN_VIGENCIA_CORREO","24","2020-11-22 00:22:20","");
INSERT INTO tbl_parametros VALUES("14","ADMIN_DIAS_VIGENCIA","365","2020-11-22 00:22:20","");
INSERT INTO tbl_parametros VALUES("15","ADMIN_CPUERTO","465","2020-11-22 00:22:20","");
INSERT INTO tbl_parametros VALUES("16","ADMIN_CHOST","smtp.gmail.com","2020-11-22 00:22:20","");
INSERT INTO tbl_parametros VALUES("17","ADMIN_CSMTP","ssl","2020-11-22 00:22:20","");
INSERT INTO tbl_parametros VALUES("18","ADMIN_PREGUNTAS","3","2020-11-22 00:22:20","");
INSERT INTO tbl_parametros VALUES("19","VIGENCIA_CLIENTE_MES","30","2020-11-30 06:16:55","");
INSERT INTO tbl_parametros VALUES("20","VIGENCIA_CLIENTE_QUINCENAL","15","2020-11-30 06:16:55","");
INSERT INTO tbl_parametros VALUES("21","VIGENCIA_CLIENTE_DIA","1","2020-11-30 06:16:55","");
INSERT INTO tbl_parametros VALUES("22","ADMIN_IMPUESTO","15","2020-11-30 14:51:04","");
INSERT INTO tbl_parametros VALUES("23","ADMIN_IMPUESTO","15","2020-11-30 14:51:07","");



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
  KEY `fk_creado_por` (`creado_por`) USING BTREE,
  KEY `id_objeto` (`id_objeto`),
  CONSTRAINT `fk_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_permisos_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_permisos_ibfk_2` FOREIGN KEY (`id_objeto`) REFERENCES `tbl_objetos` (`id_objeto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_permisos VALUES("1","1","1","1","1","1","1","2020-11-30 06:05:12","");
INSERT INTO tbl_permisos VALUES("2","1","2","1","1","1","1","2020-11-30 06:05:12","");
INSERT INTO tbl_permisos VALUES("3","1","3","1","1","1","1","2020-11-30 06:05:12","");
INSERT INTO tbl_permisos VALUES("4","1","4","1","1","1","1","2020-11-30 06:05:12","");
INSERT INTO tbl_permisos VALUES("5","1","5","1","1","1","1","2020-11-30 06:05:12","");
INSERT INTO tbl_permisos VALUES("6","1","6","1","1","1","1","2020-11-30 06:05:12","");
INSERT INTO tbl_permisos VALUES("7","1","7","1","1","1","1","2020-11-30 06:05:12","");
INSERT INTO tbl_permisos VALUES("8","1","8","1","1","1","1","2020-11-30 06:05:12","");



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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_personas VALUES("1","Super","Admin","1","000000000","","","","","","superadmin@correo.com","2020-11-21 20:21:47","");
INSERT INTO tbl_personas VALUES("3","yensi","cerrato","2","0801199500001","usuarios","1995-01-28","F","(504) 9927-3773","comayaguela","yensi.cerrato28@yahoo.com","2020-11-23 09:16:28","");
INSERT INTO tbl_personas VALUES("6","karen","lazo","1","0801199504953","usuarios","1995-03-04","F","(504) 9505-9591","tegucigalpa","karenlazo441@gmail.com","2020-11-23 13:34:27","");
INSERT INTO tbl_personas VALUES("7","Patricia","Garcia","1","0801199500002","usuarios","1987-06-07","F","(504) 9978-7655","san pedro","karenlazo4@gmail.com","2020-11-23 13:36:10","");
INSERT INTO tbl_personas VALUES("13","karen","lazo","1","100020000000","usuarios","1995-08-08","F","(504) 9937-7782","calpules","karenlazo44@gmail.com","2020-11-24 20:16:57","");
INSERT INTO tbl_personas VALUES("19","SARA","VELA","1","56456456","clientes","1994-09-08","F","(504) 9464-4646","LOARQUE","","2020-11-30 13:27:03","");
INSERT INTO tbl_personas VALUES("20","Andres","Lopez","1","56456456","clientes","1994-06-04","M","(504) 9414-8468","Israel","snchzax@gmail.es","2020-11-30 13:54:14","");
INSERT INTO tbl_personas VALUES("26","LU","ORTIZ","","","clientes","","","(989) 8988-989_","","koko.ko@ko.com","2020-11-30 14:51:25","");
INSERT INTO tbl_personas VALUES("27","POLETH","SOLORZANO","","","clientes","","","(999) 9999-9999","","npoleth@yahoo.es","2020-11-30 15:08:34","");
INSERT INTO tbl_personas VALUES("28","JESUS","AMADOR","1","08011999988881","usuarios","1999-09-09","M","(504) 3333-3333","VALLE","jesus.zuniga077@gmail.com","2020-11-30 18:01:49","");
INSERT INTO tbl_personas VALUES("29","INFORMATICA","UNAH","","","clientes","","","(504) 3333-3322","","polethsolorzano@gmail.com","2020-11-30 18:18:16","");



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

INSERT INTO tbl_preguntas VALUES("6","¿Escuela a la que asistía de pequeño?","2020-11-21 20:26:43","");
INSERT INTO tbl_preguntas VALUES("7","¿Héroe favorito?","2020-11-21 20:26:43","");
INSERT INTO tbl_preguntas VALUES("8","¿Color favorito?","2020-11-21 20:26:43","");
INSERT INTO tbl_preguntas VALUES("9","¿Cuál era el nombre de tu primera mascota?","2020-11-21 20:26:43","");
INSERT INTO tbl_preguntas VALUES("10","¿Dónde fuiste de vacaciones el año pasado?","2020-11-21 20:26:43","");



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

INSERT INTO tbl_preguntas_usuarios VALUES("1","11","6","RAMON","2020-11-30 18:02:58","");
INSERT INTO tbl_preguntas_usuarios VALUES("2","11","7","FLASH","2020-11-30 18:02:58","");
INSERT INTO tbl_preguntas_usuarios VALUES("3","11","9","SUSY","2020-11-30 18:02:58","");



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

INSERT INTO tbl_roles VALUES("1","Administrador","2020-11-21 20:13:48","","1","");
INSERT INTO tbl_roles VALUES("2","Default","2020-11-21 20:13:48","","0","");
INSERT INTO tbl_roles VALUES("4","Nuevo","2020-11-23 00:00:59","","1","");
INSERT INTO tbl_roles VALUES("17","Secretaria","2020-11-23 00:00:59","Secretaria","1","");
INSERT INTO tbl_roles VALUES("18","INFORMATICA","2020-11-30 18:32:14","INFORMATICA","0","");



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

INSERT INTO tbl_tipo_producto VALUES("1","Productos","2020-11-21 17:51:14","");
INSERT INTO tbl_tipo_producto VALUES("2","Bodega","2020-11-21 17:51:14","");



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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_usuarios VALUES("1","1","SUPERADMIN","$2a$07$asxx54ahjppf45sd87a5au.1UP6zDSXc3b.CkjVjQR/OCpZlYz4hq","vistas/img/usuarios/SUPERADMIN/854.jpg","1","0","","","","2020-11-30 18:03:42","1");
INSERT INTO tbl_usuarios VALUES("4","3","YENSIYENSI","$2a$07$asxx54ahjppf45sd87a5au3KmPU9kj3n1iKVQv7x0f2WboyVohiVe","","0","1","","","2021-11-23","","2");
INSERT INTO tbl_usuarios VALUES("6","7","PATRICIA","$2a$07$asxx54ahjppf45sd87a5auJiWWOaMIuHxzMLxN0gDY4e3zvNOUe7S","","0","1","","","2021-11-23","","2");
INSERT INTO tbl_usuarios VALUES("11","28","JEZA","$2a$07$asxx54ahjppf45sd87a5auN3t3yXm6O1JtaIBD.zHOTFO6UU.UNtO","","1","0","","","2021-11-30","2020-11-30 18:03:14","1");



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
  CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_venta VALUES("7","9","1","1002","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"2\",\"stock\":\"35\",\"precio\":\"1000\",\"total\":\"2000\"},{\"id\":\"5\",\"descripcion\":\"PESAS\",\"cantidad\":\"1\",\"stock\":\"5\",\"precio\":\"1200\",\"total\":\"1200\"}]","0","3200","3200","2020-06-28 14:08:58");
INSERT INTO tbl_venta VALUES("8","9","1","1003","[{\"id\":\"2\",\"descripcion\":\"Gatorade\",\"cantidad\":\"3\",\"stock\":\"21\",\"precio\":\"25\",\"total\":\"75\"}]","11.25","75","86","2020-06-28 14:16:10");
INSERT INTO tbl_venta VALUES("16","5","1","1004","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"1\",\"stock\":\"99\",\"precio\":\"1000\",\"total\":\"1000\"}]","150","1000","1150","2020-07-30 17:49:11");
INSERT INTO tbl_venta VALUES("17","6","1","1005","[{\"id\":\"2\",\"descripcion\":\"Gatorade\",\"cantidad\":\"1\",\"stock\":\"49\",\"precio\":\"25\",\"total\":\"25\"},{\"id\":\"3\",\"descripcion\":\"Banana\",\"cantidad\":\"1\",\"stock\":\"59\",\"precio\":\"5\",\"total\":\"5\"},{\"id\":\"4\",\"descripcion\":\"jugo\",\"cantidad\":\"1\",\"stock\":\"39\",\"precio\":\"5\",\"total\":\"5\"},{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"1\",\"stock\":\"98\",\"precio\":\"1000\",\"total\":\"1000\"}]","155.25","1035","1190","2020-07-30 18:50:09");
INSERT INTO tbl_venta VALUES("18","5","1","1006","[{\"id\":\"4\",\"descripcion\":\"jugo\",\"cantidad\":\"4\",\"stock\":\"35\",\"precio\":\"5\",\"total\":\"20\"}]","3","20","23","2020-08-01 15:50:29");
INSERT INTO tbl_venta VALUES("19","8","1","1007","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"1\",\"stock\":\"97\",\"precio\":\"1000\",\"total\":\"1000\"},{\"id\":\"2\",\"descripcion\":\"Gatorade\",\"cantidad\":\"4\",\"stock\":\"45\",\"precio\":\"25\",\"total\":\"100\"}]","165","1100","1265","2020-09-02 10:51:26");
INSERT INTO tbl_venta VALUES("20","9","1","1008","[{\"id\":\"3\",\"descripcion\":\"Banana\",\"cantidad\":\"6\",\"stock\":\"53\",\"precio\":\"5\",\"total\":\"30\"}]","4.5","30","35","2020-09-03 10:51:43");
INSERT INTO tbl_venta VALUES("21","6","1","1009","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"3\",\"stock\":\"94\",\"precio\":\"1000\",\"total\":\"3000\"},{\"id\":\"2\",\"descripcion\":\"Gatorade\",\"cantidad\":\"3\",\"stock\":\"42\",\"precio\":\"25\",\"total\":\"75\"}]","461.25","3075","3536","2020-10-04 15:52:06");
INSERT INTO tbl_venta VALUES("22","5","1","1010","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"1\",\"stock\":\"93\",\"precio\":\"1000\",\"total\":\"1000\"}]","150","1000","1150","2020-10-04 11:52:54");
INSERT INTO tbl_venta VALUES("23","9","1","1011","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"6\",\"stock\":\"87\",\"precio\":\"1000\",\"total\":\"6000\"}]","900","6000","6900","2020-11-05 11:53:21");
INSERT INTO tbl_venta VALUES("24","8","1","1012","[{\"id\":\"2\",\"descripcion\":\"Gatorade\",\"cantidad\":\"6\",\"stock\":\"36\",\"precio\":\"25\",\"total\":\"150\"},{\"id\":\"3\",\"descripcion\":\"Banana\",\"cantidad\":\"1\",\"stock\":\"52\",\"precio\":\"5\",\"total\":\"5\"},{\"id\":\"4\",\"descripcion\":\"jugo\",\"cantidad\":\"1\",\"stock\":\"34\",\"precio\":\"5\",\"total\":\"5\"},{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"4\",\"stock\":\"83\",\"precio\":\"1000\",\"total\":\"4000\"}]","624","4160","4784","2020-11-06 03:53:45");
INSERT INTO tbl_venta VALUES("31","9","1","1013","[{\"id\":\"3\",\"descripcion\":\"Banana\",\"cantidad\":\"6\",\"stock\":\"38\",\"precio\":\"5\",\"total\":\"30\"}]","4.5","30","35","2020-11-10 16:10:41");
INSERT INTO tbl_venta VALUES("32","6","1","1014","[{\"id\":\"3\",\"descripcion\":\"Banana\",\"cantidad\":\"5\",\"stock\":\"33\",\"precio\":\"5\",\"total\":\"25\"},{\"id\":\"4\",\"descripcion\":\"jugo\",\"cantidad\":\"3\",\"stock\":\"29\",\"precio\":\"5\",\"total\":\"15\"}]","6","40","46","2020-11-11 16:11:01");
INSERT INTO tbl_venta VALUES("36","5","1","1015","[{\"id\":\"3\",\"descripcion\":\"Banana\",\"cantidad\":\"6\",\"stock\":\"14\",\"precio\":\"5\",\"total\":\"30\"},{\"id\":\"4\",\"descripcion\":\"jugo\",\"cantidad\":\"6\",\"stock\":\"18\",\"precio\":\"5\",\"total\":\"30\"}]","9","60","69","2020-11-13 16:13:58");
INSERT INTO tbl_venta VALUES("41","6","1","1015","[{\"id\":\"2\",\"descripcion\":\"Gatorade\",\"cantidad\":\"4\",\"stock\":\"19\",\"precio\":\"25\",\"total\":\"100\"},{\"id\":\"3\",\"descripcion\":\"Banana\",\"cantidad\":\"7\",\"stock\":\"6\",\"precio\":\"5\",\"total\":\"35\"}]","20.25","135","155","2020-11-19 16:15:31");
INSERT INTO tbl_venta VALUES("42","5","1","1015","[{\"id\":\"4\",\"descripcion\":\"jugo\",\"cantidad\":\"4\",\"stock\":\"11\",\"precio\":\"5\",\"total\":\"20\"},{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"2\",\"stock\":\"52\",\"precio\":\"1000\",\"total\":\"2000\"}]","303","2020","2323","2020-11-20 16:15:48");
INSERT INTO tbl_venta VALUES("43","5","1","1015","[{\"id\":\"2\",\"descripcion\":\"Gatorade\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"25\",\"total\":\"25\"},{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"1\",\"stock\":\"51\",\"precio\":\"1000\",\"total\":\"1000\"}]","153.75","1025","1179","2020-11-21 16:16:15");
INSERT INTO tbl_venta VALUES("44","9","1","1015","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"2\",\"stock\":\"49\",\"precio\":\"1000\",\"total\":\"2000\"}]","300","2000","2300","2020-11-22 16:16:33");
INSERT INTO tbl_venta VALUES("45","9","1","1016","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"3\",\"stock\":\"46\",\"precio\":\"1000\",\"total\":\"3000\"}]","450","3000","3450","2020-11-25 16:18:03");
INSERT INTO tbl_venta VALUES("46","6","1","1017","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"8\",\"stock\":\"38\",\"precio\":\"1000\",\"total\":\"8000\"}]","1200","8000","9200","2020-11-30 16:18:17");
INSERT INTO tbl_venta VALUES("47","9","1","1017","[{\"id\":\"1\",\"descripcion\":\"Proteina\",\"cantidad\":\"1\",\"stock\":\"37\",\"precio\":\"1000\",\"total\":\"1000\"}]","150","1000","1150","2020-11-30 17:21:48");
INSERT INTO tbl_venta VALUES("48","9","1","1018","[{\"id\":\"6\",\"descripcion\":\"GATORADE\",\"cantidad\":\"1\",\"stock\":\"49\",\"precio\":\"20\",\"total\":\"20\"}]","3","20","23","2020-11-30 17:36:13");
INSERT INTO tbl_venta VALUES("49","10","1","1019","[{\"id\":\"1\",\"descripcion\":\"PROTEINA\",\"cantidad\":\"2\",\"stock\":\"36\",\"precio\":\"1000\",\"total\":\"2000\"},{\"id\":\"5\",\"descripcion\":\"AGUA\",\"cantidad\":\"5\",\"stock\":\"0\",\"precio\":\"1200\",\"total\":\"6000\"}]","1200","8000","9200","2020-11-30 18:19:21");



SET FOREIGN_KEY_CHECKS=1;