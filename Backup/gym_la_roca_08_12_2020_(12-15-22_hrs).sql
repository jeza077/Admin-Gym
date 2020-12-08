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
) ENGINE=InnoDB AUTO_INCREMENT=831 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_bitacora VALUES("1","2020-12-05 16:06:56","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("2","2020-12-05 16:06:59","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("3","2020-12-05 16:07:07","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("4","2020-12-05 16:07:10","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("5","2020-12-05 16:07:13","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("6","2020-12-05 16:16:51","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("7","2020-12-05 16:16:55","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("8","2020-12-05 16:18:11","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("9","2020-12-05 16:18:12","1","3","Nuevo","Nuevo cliente");
INSERT INTO tbl_bitacora VALUES("10","2020-12-05 16:21:10","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("11","2020-12-05 16:21:31","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("12","2020-12-05 16:24:11","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("13","2020-12-05 16:33:12","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("14","2020-12-05 16:33:12","1","3","Nuevo","Nuevo cliente");
INSERT INTO tbl_bitacora VALUES("15","2020-12-05 16:35:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("16","2020-12-05 16:36:11","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("17","2020-12-05 16:37:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("18","2020-12-05 16:39:31","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("19","2020-12-05 16:40:36","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("20","2020-12-05 16:41:44","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("21","2020-12-05 16:45:40","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("22","2020-12-05 16:46:18","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("23","2020-12-05 16:47:15","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("24","2020-12-05 16:48:26","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("25","2020-12-05 16:49:01","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("26","2020-12-05 16:49:19","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("27","2020-12-05 16:49:37","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("28","2020-12-05 16:50:42","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("29","2020-12-05 16:50:43","1","3","Nuevo","Nuevo cliente");
INSERT INTO tbl_bitacora VALUES("30","2020-12-05 16:51:37","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("31","2020-12-05 16:51:38","1","3","Nuevo","Nuevo cliente");
INSERT INTO tbl_bitacora VALUES("32","2020-12-05 16:52:17","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("33","2020-12-05 16:52:18","1","3","Nuevo","Nuevo cliente");
INSERT INTO tbl_bitacora VALUES("34","2020-12-05 16:53:33","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("35","2020-12-05 16:54:45","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("36","2020-12-05 16:55:44","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("37","2020-12-05 16:55:48","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("38","2020-12-05 16:55:51","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("39","2020-12-05 18:04:53","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("40","2020-12-05 18:05:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("41","2020-12-05 18:05:49","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("42","2020-12-05 18:07:07","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("43","2020-12-05 18:46:15","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("44","2020-12-05 18:51:50","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("45","2020-12-05 18:52:10","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("46","2020-12-05 18:54:50","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("47","2020-12-05 18:54:54","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("48","2020-12-05 18:54:57","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("49","2020-12-05 18:55:18","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("50","2020-12-05 18:56:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("51","2020-12-05 18:59:14","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("52","2020-12-05 19:11:08","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("53","2020-12-05 19:15:04","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("54","2020-12-05 19:15:40","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("55","2020-12-05 19:15:46","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("56","2020-12-05 19:17:22","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("57","2020-12-05 19:21:10","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("58","2020-12-05 19:21:36","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("59","2020-12-05 19:32:18","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("60","2020-12-05 19:32:42","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("61","2020-12-05 19:33:07","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("62","2020-12-05 19:33:15","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("63","2020-12-05 19:58:50","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("64","2020-12-05 20:14:37","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("65","2020-12-05 20:16:21","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("66","2020-12-05 20:20:43","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("67","2020-12-05 20:22:46","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("68","2020-12-05 20:25:45","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("69","2020-12-05 20:25:53","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("70","2020-12-05 20:26:07","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("71","2020-12-05 20:26:15","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("72","2020-12-05 20:28:25","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("73","2020-12-05 20:28:45","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("74","2020-12-05 21:02:40","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("75","2020-12-05 21:03:27","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("76","2020-12-05 21:15:10","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("77","2020-12-05 21:15:30","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("78","2020-12-05 21:15:57","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("79","2020-12-05 21:16:25","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("80","2020-12-05 21:25:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("81","2020-12-05 21:25:53","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("82","2020-12-05 21:26:53","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("83","2020-12-05 21:27:05","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("84","2020-12-05 21:40:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("85","2020-12-05 21:40:13","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("86","2020-12-05 21:40:17","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("87","2020-12-06 07:17:54","1","6","Ingreso"," Ingreso a Login");
INSERT INTO tbl_bitacora VALUES("88","2020-12-06 07:17:56","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("89","2020-12-06 07:18:09","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("90","2020-12-06 07:18:12","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("91","2020-12-06 07:18:41","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("92","2020-12-06 07:18:47","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("93","2020-12-06 07:18:52","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("94","2020-12-06 07:30:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("95","2020-12-06 07:30:08","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("96","2020-12-06 07:34:05","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("97","2020-12-06 07:35:01","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("98","2020-12-06 07:35:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("99","2020-12-06 07:35:52","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("100","2020-12-06 07:36:49","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("101","2020-12-06 07:36:58","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("102","2020-12-06 07:37:52","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("103","2020-12-06 07:38:02","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("104","2020-12-06 07:39:59","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("105","2020-12-06 07:41:31","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("106","2020-12-06 07:41:44","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("107","2020-12-06 07:43:34","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("108","2020-12-06 07:43:47","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("109","2020-12-06 07:55:47","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("110","2020-12-06 07:56:04","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("111","2020-12-06 08:00:57","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("112","2020-12-06 08:09:41","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("113","2020-12-06 08:09:48","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("114","2020-12-06 08:09:51","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("115","2020-12-06 08:11:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("116","2020-12-06 08:14:37","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("117","2020-12-06 08:16:54","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("118","2020-12-06 08:19:18","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("119","2020-12-06 08:19:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("120","2020-12-06 08:22:34","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("121","2020-12-06 08:22:41","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("122","2020-12-06 08:22:52","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("123","2020-12-06 08:26:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("124","2020-12-06 08:28:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("125","2020-12-06 08:29:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("126","2020-12-06 08:30:19","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("127","2020-12-06 08:32:12","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("128","2020-12-06 08:34:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("129","2020-12-06 08:35:26","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("130","2020-12-06 08:38:14","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("131","2020-12-06 08:38:15","1","3","Nuevo","Nuevo cliente");
INSERT INTO tbl_bitacora VALUES("132","2020-12-06 08:39:58","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("133","2020-12-06 08:39:59","1","3","Nuevo","Nuevo cliente");
INSERT INTO tbl_bitacora VALUES("134","2020-12-06 08:40:25","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("135","2020-12-06 08:42:36","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("136","2020-12-06 08:44:18","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("137","2020-12-06 08:44:22","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("138","2020-12-06 08:44:56","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("139","2020-12-06 08:45:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("140","2020-12-06 08:45:17","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("141","2020-12-06 08:45:22","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("142","2020-12-06 08:45:45","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("143","2020-12-06 08:51:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("144","2020-12-06 08:53:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("145","2020-12-06 08:57:59","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("146","2020-12-06 12:44:53","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("147","2020-12-06 12:45:07","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("148","2020-12-06 12:45:58","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("149","2020-12-06 12:49:25","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("150","2020-12-06 12:50:13","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("151","2020-12-06 12:53:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("152","2020-12-06 12:53:18","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("153","2020-12-06 12:54:13","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("154","2020-12-06 12:57:13","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("155","2020-12-06 12:57:24","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("156","2020-12-06 12:57:34","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("157","2020-12-06 12:58:02","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("158","2020-12-06 12:58:09","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("159","2020-12-06 12:58:14","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("160","2020-12-06 12:58:25","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("161","2020-12-06 13:08:38","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("162","2020-12-06 13:09:08","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("163","2020-12-06 13:10:02","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("164","2020-12-06 13:10:14","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("165","2020-12-06 13:20:38","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("166","2020-12-06 13:20:54","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("167","2020-12-06 13:21:57","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("168","2020-12-06 13:23:41","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("169","2020-12-06 13:23:47","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("170","2020-12-06 13:23:59","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("171","2020-12-06 13:24:01","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("172","2020-12-06 13:24:12","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("173","2020-12-06 13:24:13","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("174","2020-12-06 13:24:42","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("175","2020-12-06 13:24:49","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("176","2020-12-06 13:25:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("177","2020-12-06 13:25:32","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("178","2020-12-06 13:25:42","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("179","2020-12-06 13:33:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("180","2020-12-06 13:35:49","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("181","2020-12-06 13:36:11","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("182","2020-12-06 13:40:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("183","2020-12-06 13:40:16","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("184","2020-12-06 13:41:11","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("185","2020-12-06 13:41:44","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("186","2020-12-06 13:42:27","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("187","2020-12-06 13:44:04","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("188","2020-12-06 13:45:04","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("189","2020-12-06 13:45:15","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("190","2020-12-06 13:45:32","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("191","2020-12-06 13:46:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("192","2020-12-06 13:46:39","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("193","2020-12-06 13:47:05","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("194","2020-12-06 13:49:22","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("195","2020-12-06 13:49:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("196","2020-12-06 13:50:01","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("197","2020-12-06 13:50:30","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("198","2020-12-06 13:50:38","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("199","2020-12-06 13:50:49","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("200","2020-12-06 13:50:57","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("201","2020-12-06 13:51:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("202","2020-12-06 13:51:39","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("203","2020-12-06 14:18:07","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("204","2020-12-06 14:18:29","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("205","2020-12-06 14:18:50","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("206","2020-12-06 14:19:18","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("207","2020-12-06 14:22:39","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("208","2020-12-06 14:22:52","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("209","2020-12-06 14:23:41","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("210","2020-12-06 14:24:15","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("211","2020-12-06 14:24:25","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("212","2020-12-06 14:24:43","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("213","2020-12-06 14:27:46","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("214","2020-12-06 14:44:34","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("215","2020-12-06 14:50:13","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("216","2020-12-06 14:55:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("217","2020-12-06 14:55:24","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("218","2020-12-06 14:57:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("219","2020-12-06 14:57:56","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("220","2020-12-06 15:01:25","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("221","2020-12-06 15:01:41","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("222","2020-12-06 15:02:12","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("223","2020-12-06 15:02:14","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("224","2020-12-06 15:17:01","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("225","2020-12-06 15:17:09","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("226","2020-12-06 15:17:36","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("227","2020-12-06 15:17:45","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("228","2020-12-06 15:18:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("229","2020-12-06 15:18:40","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("230","2020-12-06 15:19:15","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("231","2020-12-06 15:20:49","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("232","2020-12-06 15:21:01","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("233","2020-12-06 15:24:10","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("234","2020-12-06 15:25:25","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("235","2020-12-06 15:26:58","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("236","2020-12-06 15:27:08","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("237","2020-12-06 15:28:08","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("238","2020-12-06 15:28:16","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("239","2020-12-06 15:29:40","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("240","2020-12-06 15:30:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("241","2020-12-06 15:30:12","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("242","2020-12-06 15:30:57","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("243","2020-12-06 15:32:27","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("244","2020-12-06 15:33:17","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("245","2020-12-06 15:33:48","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("246","2020-12-06 15:34:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("247","2020-12-06 15:37:25","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("248","2020-12-06 15:37:42","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("249","2020-12-06 15:38:30","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("250","2020-12-06 15:43:33","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("251","2020-12-06 15:43:46","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("252","2020-12-06 15:43:58","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("253","2020-12-06 15:45:21","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("254","2020-12-06 15:45:36","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("255","2020-12-06 15:46:37","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("256","2020-12-06 15:46:47","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("257","2020-12-06 15:47:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("258","2020-12-06 15:48:10","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("259","2020-12-06 15:50:04","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("260","2020-12-06 15:53:27","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("261","2020-12-06 15:53:56","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("262","2020-12-06 15:54:22","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("263","2020-12-06 15:54:42","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("264","2020-12-06 15:55:40","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("265","2020-12-06 16:00:08","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("266","2020-12-06 16:06:41","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("267","2020-12-06 16:08:54","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("268","2020-12-06 16:09:23","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("269","2020-12-06 16:16:49","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("270","2020-12-06 16:17:11","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("271","2020-12-06 16:18:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("272","2020-12-06 16:18:34","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("273","2020-12-06 16:18:45","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("274","2020-12-06 16:19:09","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("275","2020-12-06 16:19:28","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("276","2020-12-06 16:19:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("277","2020-12-06 16:19:47","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("278","2020-12-06 16:20:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("279","2020-12-06 16:21:28","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("280","2020-12-06 16:21:30","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("281","2020-12-06 16:21:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("282","2020-12-06 16:21:52","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("283","2020-12-06 16:22:04","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("284","2020-12-06 16:23:22","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("285","2020-12-06 16:23:23","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("286","2020-12-06 16:23:44","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("287","2020-12-06 16:28:50","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("288","2020-12-06 16:29:08","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("289","2020-12-06 16:31:27","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("290","2020-12-06 16:36:55","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("291","2020-12-06 16:39:44","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("292","2020-12-06 16:40:27","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("293","2020-12-06 16:41:04","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("294","2020-12-06 16:44:27","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("295","2020-12-06 16:44:30","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("296","2020-12-06 16:44:42","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("297","2020-12-06 16:49:28","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("298","2020-12-06 16:49:34","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("299","2020-12-06 16:50:41","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("300","2020-12-06 16:51:10","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("301","2020-12-06 16:51:53","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("302","2020-12-06 16:53:51","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("303","2020-12-06 16:54:02","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("304","2020-12-06 16:54:31","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("305","2020-12-06 16:55:07","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("306","2020-12-06 17:01:07","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("307","2020-12-06 17:01:21","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("308","2020-12-06 17:02:36","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("309","2020-12-06 17:02:37","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("310","2020-12-06 17:06:54","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("311","2020-12-06 17:07:05","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("312","2020-12-06 17:07:07","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("313","2020-12-06 17:07:59","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("314","2020-12-06 17:08:21","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("315","2020-12-06 17:08:29","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("316","2020-12-06 18:11:42","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("317","2020-12-06 18:13:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("318","2020-12-06 18:13:29","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("319","2020-12-06 18:13:56","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("320","2020-12-06 18:15:04","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("321","2020-12-06 18:15:16","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("322","2020-12-06 18:16:42","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("323","2020-12-06 18:21:05","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("324","2020-12-06 18:21:23","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("325","2020-12-06 18:21:51","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("326","2020-12-06 18:21:56","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("327","2020-12-06 18:29:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("328","2020-12-06 18:30:25","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("329","2020-12-06 18:30:38","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("330","2020-12-06 18:32:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("331","2020-12-06 18:34:43","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("332","2020-12-06 18:35:13","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("333","2020-12-06 18:35:22","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("334","2020-12-06 18:37:04","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("335","2020-12-06 18:39:05","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("336","2020-12-06 18:40:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("337","2020-12-06 18:40:49","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("338","2020-12-06 18:41:28","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("339","2020-12-06 18:41:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("340","2020-12-06 18:41:45","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("341","2020-12-06 18:41:52","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("342","2020-12-06 18:41:56","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("343","2020-12-06 18:43:58","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("344","2020-12-06 18:44:20","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("345","2020-12-06 18:44:33","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("346","2020-12-06 18:45:54","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("347","2020-12-06 18:46:30","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("348","2020-12-06 18:46:34","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("349","2020-12-06 18:46:59","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("350","2020-12-06 18:49:08","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("351","2020-12-06 18:50:05","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("352","2020-12-06 18:50:21","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("353","2020-12-06 18:50:51","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("354","2020-12-06 18:51:06","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("355","2020-12-06 18:51:23","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("356","2020-12-06 18:54:24","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("357","2020-12-06 18:54:40","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("358","2020-12-06 18:54:44","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("359","2020-12-06 18:56:11","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("360","2020-12-06 18:58:30","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("361","2020-12-06 18:58:53","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("362","2020-12-06 18:59:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("363","2020-12-06 18:59:15","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("364","2020-12-06 18:59:36","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("365","2020-12-06 18:59:44","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("366","2020-12-06 19:00:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("367","2020-12-06 19:00:29","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("368","2020-12-06 19:02:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("369","2020-12-06 19:02:02","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("370","2020-12-06 19:05:27","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("371","2020-12-06 19:05:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("372","2020-12-06 19:05:55","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("373","2020-12-06 19:14:31","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("374","2020-12-06 19:15:19","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("375","2020-12-06 19:16:09","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("376","2020-12-06 19:16:11","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("377","2020-12-06 19:16:11","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("378","2020-12-06 19:17:07","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("379","2020-12-06 19:17:14","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("380","2020-12-06 19:17:28","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("381","2020-12-06 19:17:36","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("382","2020-12-06 19:17:40","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("383","2020-12-06 19:25:07","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("384","2020-12-06 19:25:17","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("385","2020-12-06 19:28:36","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("386","2020-12-06 19:28:55","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("387","2020-12-06 19:29:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("388","2020-12-06 19:30:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("389","2020-12-06 19:30:23","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("390","2020-12-06 19:40:35","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("391","2020-12-06 19:46:55","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("392","2020-12-06 19:53:03","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("393","2020-12-06 19:56:01","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("394","2020-12-06 19:56:26","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("395","2020-12-06 19:56:29","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("396","2020-12-06 19:56:40","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("397","2020-12-06 19:56:45","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("398","2020-12-06 19:57:34","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("399","2020-12-06 19:57:52","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("400","2020-12-06 19:58:19","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("401","2020-12-06 20:08:15","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("402","2020-12-06 20:08:18","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("403","2020-12-06 20:08:22","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("404","2020-12-06 20:08:45","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("405","2020-12-06 20:08:49","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("406","2020-12-06 20:10:00","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("407","2020-12-06 20:11:15","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("408","2020-12-06 20:11:17","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("409","2020-12-06 20:11:20","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("410","2020-12-07 00:32:42","1","6","Ingreso"," Ingreso a Login");
INSERT INTO tbl_bitacora VALUES("411","2020-12-07 00:32:44","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("412","2020-12-07 00:32:51","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("413","2020-12-07 00:32:54","1","3","consulta"," Consulto la pantalla de cliente");
INSERT INTO tbl_bitacora VALUES("414","2020-12-07 00:33:02","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("415","2020-12-07 00:33:09","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("416","2020-12-07 00:33:19","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("417","2020-12-07 00:33:19","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("418","2020-12-07 00:34:43","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("419","2020-12-07 00:34:43","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("420","2020-12-07 00:35:29","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("421","2020-12-07 00:35:29","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("422","2020-12-07 00:35:58","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("423","2020-12-07 00:35:58","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("424","2020-12-07 00:37:09","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("425","2020-12-07 00:37:09","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("426","2020-12-07 00:43:05","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("427","2020-12-07 00:45:35","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("428","2020-12-07 00:45:35","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("429","2020-12-07 00:47:34","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("430","2020-12-07 00:47:34","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("431","2020-12-07 00:48:46","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("432","2020-12-07 00:48:46","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("433","2020-12-07 00:49:04","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("434","2020-12-07 00:49:04","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("435","2020-12-07 00:49:18","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("436","2020-12-07 00:49:18","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("437","2020-12-07 00:49:52","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("438","2020-12-07 00:49:52","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("439","2020-12-07 00:49:54","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("440","2020-12-07 00:49:54","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("441","2020-12-07 00:50:03","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("442","2020-12-07 00:50:03","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("443","2020-12-07 00:51:04","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("444","2020-12-07 00:51:04","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("445","2020-12-07 00:53:12","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("446","2020-12-07 00:53:46","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("447","2020-12-07 01:01:10","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("448","2020-12-07 01:17:43","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("449","2020-12-07 01:18:02","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("450","2020-12-07 01:18:02","1","6","Nuevo","Nueva inscripcion del gimnasio");
INSERT INTO tbl_bitacora VALUES("451","2020-12-07 01:18:04","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("452","2020-12-07 01:18:30","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("453","2020-12-07 01:18:37","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("454","2020-12-07 01:19:48","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("455","2020-12-07 01:20:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("456","2020-12-07 01:20:45","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("457","2020-12-07 01:20:50","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("458","2020-12-07 01:21:24","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("459","2020-12-07 01:21:29","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("460","2020-12-07 01:22:12","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("461","2020-12-07 01:23:26","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("462","2020-12-07 02:01:25","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("463","2020-12-07 02:01:54","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("464","2020-12-07 02:01:54","1","6","Nuevo","Nueva inscripcion del gimnasio");
INSERT INTO tbl_bitacora VALUES("465","2020-12-07 02:01:56","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("466","2020-12-07 02:02:03","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("467","2020-12-07 02:02:16","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("468","2020-12-07 02:02:29","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("469","2020-12-07 02:03:07","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("470","2020-12-07 02:06:07","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("471","2020-12-07 02:06:11","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("472","2020-12-07 02:06:16","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("473","2020-12-07 02:06:21","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("474","2020-12-07 02:06:27","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("475","2020-12-07 02:06:32","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("476","2020-12-07 02:06:32","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("477","2020-12-07 02:37:49","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("478","2020-12-07 02:37:56","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("479","2020-12-07 02:38:05","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("480","2020-12-07 02:38:12","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("481","2020-12-07 02:38:13","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("482","2020-12-07 02:38:18","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("483","2020-12-07 02:42:39","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("484","2020-12-07 02:42:42","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("485","2020-12-07 02:43:18","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("486","2020-12-07 02:54:29","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("487","2020-12-07 03:00:04","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("488","2020-12-07 03:01:03","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("489","2020-12-07 03:05:17","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("490","2020-12-07 03:09:03","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("491","2020-12-07 03:10:49","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("492","2020-12-07 03:12:34","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("493","2020-12-07 03:13:09","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("494","2020-12-07 03:16:46","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("495","2020-12-07 03:17:14","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("496","2020-12-07 03:17:19","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("497","2020-12-07 03:18:25","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("498","2020-12-07 03:18:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("499","2020-12-07 03:22:32","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("500","2020-12-07 03:22:47","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("501","2020-12-07 03:23:08","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("502","2020-12-07 03:23:30","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("503","2020-12-07 03:23:33","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("504","2020-12-07 03:24:13","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("505","2020-12-07 03:24:47","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("506","2020-12-07 03:25:13","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("507","2020-12-07 03:25:31","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("508","2020-12-07 03:27:58","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("509","2020-12-07 03:29:55","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("510","2020-12-07 03:30:14","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("511","2020-12-07 03:30:18","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("512","2020-12-07 03:33:03","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("513","2020-12-07 03:40:46","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("514","2020-12-07 17:39:01","1","6","Ingreso"," Ingreso a Login");
INSERT INTO tbl_bitacora VALUES("515","2020-12-07 17:39:04","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("516","2020-12-07 17:39:54","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("517","2020-12-07 18:07:06","1","4","consulta"," Consulto la pantalla de Administracion de Ventas");
INSERT INTO tbl_bitacora VALUES("518","2020-12-07 18:07:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("519","2020-12-07 18:10:48","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("520","2020-12-07 18:10:48","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("521","2020-12-07 18:11:03","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("522","2020-12-07 18:39:51","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("523","2020-12-07 18:40:29","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("524","2020-12-07 18:41:57","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("525","2020-12-07 18:47:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("526","2020-12-07 18:48:26","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("527","2020-12-07 18:49:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("528","2020-12-07 18:49:44","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("529","2020-12-07 18:50:46","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("530","2020-12-07 18:50:46","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("531","2020-12-07 18:50:56","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("532","2020-12-07 18:51:04","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("533","2020-12-07 18:51:04","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("534","2020-12-07 18:59:57","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("535","2020-12-07 19:00:57","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("536","2020-12-07 19:00:57","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("537","2020-12-07 19:01:02","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("538","2020-12-07 19:01:52","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("539","2020-12-07 19:01:52","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("540","2020-12-07 23:45:20","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("541","2020-12-07 23:45:25","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("542","2020-12-08 02:20:55","1","2","consulta"," Consulto la pantalla de Usuario");
INSERT INTO tbl_bitacora VALUES("543","2020-12-08 02:21:03","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("544","2020-12-08 02:21:03","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("545","2020-12-08 02:21:08","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("546","2020-12-08 02:24:12","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("547","2020-12-08 02:24:12","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("548","2020-12-08 02:24:13","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("549","2020-12-08 02:24:18","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("550","2020-12-08 02:24:22","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("551","2020-12-08 02:24:28","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("552","2020-12-08 02:24:28","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("553","2020-12-08 02:24:30","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("554","2020-12-08 02:24:36","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("555","2020-12-08 02:25:25","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("556","2020-12-08 02:25:29","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("557","2020-12-08 02:25:33","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("558","2020-12-08 02:25:36","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("559","2020-12-08 02:25:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("560","2020-12-08 02:25:49","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("561","2020-12-08 02:25:49","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("562","2020-12-08 02:25:51","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("563","2020-12-08 02:25:56","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("564","2020-12-08 02:28:54","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("565","2020-12-08 02:29:43","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("566","2020-12-08 02:29:53","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("567","2020-12-08 02:29:53","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("568","2020-12-08 02:29:53","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("569","2020-12-08 02:29:55","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("570","2020-12-08 02:29:58","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("571","2020-12-08 02:31:27","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("572","2020-12-08 02:32:24","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("573","2020-12-08 02:33:25","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("574","2020-12-08 02:33:25","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("575","2020-12-08 02:33:25","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("576","2020-12-08 02:33:27","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("577","2020-12-08 02:34:01","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("578","2020-12-08 02:34:04","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("579","2020-12-08 02:34:11","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("580","2020-12-08 02:34:11","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("581","2020-12-08 02:34:12","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("582","2020-12-08 02:34:20","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("583","2020-12-08 02:38:52","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("584","2020-12-08 02:39:23","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("585","2020-12-08 02:39:23","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("586","2020-12-08 02:39:25","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("587","2020-12-08 02:39:28","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("588","2020-12-08 02:39:39","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("589","2020-12-08 02:39:39","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("590","2020-12-08 02:39:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("591","2020-12-08 02:39:43","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("592","2020-12-08 02:39:51","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("593","2020-12-08 02:39:59","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("594","2020-12-08 02:40:22","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("595","2020-12-08 02:40:22","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("596","2020-12-08 02:40:23","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("597","2020-12-08 02:40:27","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("598","2020-12-08 02:40:34","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("599","2020-12-08 02:40:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("600","2020-12-08 02:41:36","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("601","2020-12-08 02:41:36","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("602","2020-12-08 02:41:38","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("603","2020-12-08 02:41:43","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("604","2020-12-08 02:41:50","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("605","2020-12-08 02:41:53","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("606","2020-12-08 02:41:58","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("607","2020-12-08 02:42:16","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("608","2020-12-08 02:42:16","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("609","2020-12-08 02:42:17","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("610","2020-12-08 02:42:20","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("611","2020-12-08 02:43:01","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("612","2020-12-08 02:43:17","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("613","2020-12-08 02:43:17","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("614","2020-12-08 02:43:18","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("615","2020-12-08 02:45:22","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("616","2020-12-08 02:46:05","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("617","2020-12-08 02:46:13","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("618","2020-12-08 02:46:16","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("619","2020-12-08 02:46:19","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("620","2020-12-08 02:46:22","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("621","2020-12-08 02:46:38","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("622","2020-12-08 02:46:41","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("623","2020-12-08 02:46:42","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("624","2020-12-08 02:47:04","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("625","2020-12-08 02:47:04","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("626","2020-12-08 02:47:06","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("627","2020-12-08 02:47:09","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("628","2020-12-08 02:47:55","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("629","2020-12-08 02:49:05","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("630","2020-12-08 02:50:39","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("631","2020-12-08 02:50:39","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("632","2020-12-08 02:50:39","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("633","2020-12-08 02:50:41","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("634","2020-12-08 02:50:45","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("635","2020-12-08 02:51:15","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("636","2020-12-08 02:51:34","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("637","2020-12-08 02:51:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("638","2020-12-08 02:51:47","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("639","2020-12-08 02:51:59","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("640","2020-12-08 02:51:59","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("641","2020-12-08 02:51:59","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("642","2020-12-08 02:52:01","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("643","2020-12-08 02:52:05","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("644","2020-12-08 02:52:12","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("645","2020-12-08 02:52:16","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("646","2020-12-08 02:52:23","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("647","2020-12-08 02:52:26","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("648","2020-12-08 02:52:28","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("649","2020-12-08 02:54:15","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("650","2020-12-08 02:54:32","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("651","2020-12-08 02:54:36","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("652","2020-12-08 02:54:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("653","2020-12-08 02:57:05","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("654","2020-12-08 02:57:09","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("655","2020-12-08 02:59:50","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("656","2020-12-08 02:59:53","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("657","2020-12-08 03:00:37","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("658","2020-12-08 03:00:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("659","2020-12-08 03:00:43","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("660","2020-12-08 03:00:48","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("661","2020-12-08 03:05:01","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("662","2020-12-08 03:05:24","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("663","2020-12-08 03:05:28","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("664","2020-12-08 03:05:31","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("665","2020-12-08 03:05:36","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("666","2020-12-08 03:06:50","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("667","2020-12-08 03:07:06","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("668","2020-12-08 03:07:09","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("669","2020-12-08 03:07:16","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("670","2020-12-08 03:09:03","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("671","2020-12-08 03:09:20","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("672","2020-12-08 03:09:23","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("673","2020-12-08 03:09:51","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("674","2020-12-08 03:11:37","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("675","2020-12-08 03:11:49","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("676","2020-12-08 03:11:52","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("677","2020-12-08 03:12:42","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("678","2020-12-08 03:12:54","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("679","2020-12-08 03:12:58","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("680","2020-12-08 03:13:42","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("681","2020-12-08 03:13:58","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("682","2020-12-08 03:14:00","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("683","2020-12-08 03:14:04","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("684","2020-12-08 03:14:04","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("685","2020-12-08 03:14:04","1","7","consulta"," Consulto la pantalla de Restauracion");
INSERT INTO tbl_bitacora VALUES("686","2020-12-08 03:14:07","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("687","2020-12-08 03:15:28","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("688","2020-12-08 03:15:30","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("689","2020-12-08 03:17:25","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("690","2020-12-08 03:17:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("691","2020-12-08 03:17:44","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("692","2020-12-08 03:17:55","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("693","2020-12-08 03:20:33","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("694","2020-12-08 03:20:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("695","2020-12-08 03:21:04","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("696","2020-12-08 03:21:04","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("697","2020-12-08 03:21:04","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("698","2020-12-08 03:21:05","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("699","2020-12-08 03:21:08","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("700","2020-12-08 03:21:17","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("701","2020-12-08 03:21:17","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("702","2020-12-08 03:21:17","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("703","2020-12-08 03:21:19","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("704","2020-12-08 03:21:23","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("705","2020-12-08 03:22:54","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("706","2020-12-08 03:23:43","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("707","2020-12-08 03:23:49","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("708","2020-12-08 03:24:13","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("709","2020-12-08 03:24:13","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("710","2020-12-08 03:24:13","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("711","2020-12-08 03:24:15","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("712","2020-12-08 03:24:19","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("713","2020-12-08 03:26:36","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("714","2020-12-08 03:26:41","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("715","2020-12-08 03:26:41","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("716","2020-12-08 03:26:54","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("717","2020-12-08 03:28:01","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("718","2020-12-08 03:28:01","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("719","2020-12-08 03:28:01","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("720","2020-12-08 03:28:02","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("721","2020-12-08 03:28:07","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("722","2020-12-08 03:28:26","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("723","2020-12-08 03:28:36","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("724","2020-12-08 03:28:47","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("725","2020-12-08 03:28:48","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("726","2020-12-08 03:28:48","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("727","2020-12-08 03:28:49","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("728","2020-12-08 03:28:54","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("729","2020-12-08 03:29:06","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("730","2020-12-08 03:30:31","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("731","2020-12-08 03:30:59","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("732","2020-12-08 03:30:59","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("733","2020-12-08 03:30:59","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("734","2020-12-08 03:31:01","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("735","2020-12-08 03:31:07","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("736","2020-12-08 03:34:22","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("737","2020-12-08 03:34:26","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("738","2020-12-08 03:34:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("739","2020-12-08 03:34:40","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("740","2020-12-08 03:34:40","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("741","2020-12-08 03:34:43","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("742","2020-12-08 03:36:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("743","2020-12-08 03:38:24","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("744","2020-12-08 03:38:39","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("745","2020-12-08 03:38:39","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("746","2020-12-08 03:38:39","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("747","2020-12-08 03:38:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("748","2020-12-08 03:38:46","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("749","2020-12-08 03:39:20","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("750","2020-12-08 03:39:25","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("751","2020-12-08 03:39:25","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("752","2020-12-08 03:39:25","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("753","2020-12-08 03:39:26","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("754","2020-12-08 03:39:37","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("755","2020-12-08 03:39:39","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("756","2020-12-08 03:45:08","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("757","2020-12-08 03:45:09","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("758","2020-12-08 03:45:11","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("759","2020-12-08 03:45:13","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("760","2020-12-08 03:45:13","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("761","2020-12-08 03:45:14","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("762","2020-12-08 03:45:22","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("763","2020-12-08 11:51:31","1","6","Ingreso"," Ingreso a Login");
INSERT INTO tbl_bitacora VALUES("764","2020-12-08 11:51:32","1","1","consulta"," Consulto Inicio");
INSERT INTO tbl_bitacora VALUES("765","2020-12-08 11:56:54","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("766","2020-12-08 11:57:01","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("767","2020-12-08 11:57:18","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("768","2020-12-08 11:57:18","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("769","2020-12-08 11:57:18","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("770","2020-12-08 11:57:20","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("771","2020-12-08 11:57:24","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("772","2020-12-08 11:57:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("773","2020-12-08 11:58:12","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("774","2020-12-08 11:58:12","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("775","2020-12-08 11:58:12","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("776","2020-12-08 11:58:14","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("777","2020-12-08 11:58:17","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("778","2020-12-08 12:00:03","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("779","2020-12-08 12:00:17","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("780","2020-12-08 12:00:17","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("781","2020-12-08 12:00:17","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("782","2020-12-08 12:00:18","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("783","2020-12-08 12:00:22","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("784","2020-12-08 12:00:36","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("785","2020-12-08 12:00:36","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("786","2020-12-08 12:00:36","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("787","2020-12-08 12:00:38","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("788","2020-12-08 12:00:42","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("789","2020-12-08 12:01:05","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("790","2020-12-08 12:01:05","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("791","2020-12-08 12:01:05","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("792","2020-12-08 12:01:08","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("793","2020-12-08 12:01:12","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("794","2020-12-08 12:02:35","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("795","2020-12-08 12:02:40","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("796","2020-12-08 12:08:46","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("797","2020-12-08 12:09:11","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("798","2020-12-08 12:09:11","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("799","2020-12-08 12:09:11","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("800","2020-12-08 12:09:13","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("801","2020-12-08 12:09:17","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("802","2020-12-08 12:09:27","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("803","2020-12-08 12:09:33","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("804","2020-12-08 12:09:33","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("805","2020-12-08 12:09:33","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("806","2020-12-08 12:09:35","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("807","2020-12-08 12:09:38","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("808","2020-12-08 12:12:13","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("809","2020-12-08 12:12:35","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("810","2020-12-08 12:12:35","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("811","2020-12-08 12:12:35","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("812","2020-12-08 12:12:37","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("813","2020-12-08 12:12:41","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("814","2020-12-08 12:13:06","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("815","2020-12-08 12:13:09","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("816","2020-12-08 12:13:15","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("817","2020-12-08 12:13:32","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("818","2020-12-08 12:14:19","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("819","2020-12-08 12:14:27","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("820","2020-12-08 12:14:27","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("821","2020-12-08 12:14:27","1","2","Actualizo","Actualizo rol");
INSERT INTO tbl_bitacora VALUES("822","2020-12-08 12:14:28","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("823","2020-12-08 12:14:31","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("824","2020-12-08 12:14:32","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("825","2020-12-08 12:14:49","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("826","2020-12-08 12:15:00","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("827","2020-12-08 12:15:04","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("828","2020-12-08 12:15:06","1","6","consulta"," Consulto la pantalla de mantenimiento");
INSERT INTO tbl_bitacora VALUES("829","2020-12-08 12:15:17","1","7","consulta"," Consulto la pantalla de Respaldo");
INSERT INTO tbl_bitacora VALUES("830","2020-12-08 12:15:17","1","7","consulta"," Consulto la pantalla de Restauracion");



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
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cliente_inscripcion`),
  KEY `id_inscripcion` (`id_inscripcion`),
  KEY `id_cliente` (`id_cliente`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_cliente_inscripcion_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_cliente_inscripcion_ibfk_2` FOREIGN KEY (`id_inscripcion`) REFERENCES `tbl_inscripcion` (`id_inscripcion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_cliente_inscripcion_ibfk_3` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_cliente_inscripcion VALUES("1","15","1","2020-04-01","2020-07-01","2020-07-31","2020-07-31","0","1");
INSERT INTO tbl_cliente_inscripcion VALUES("10","15","2","2020-12-06","2020-12-06","2020-12-21","2020-12-21","1","");
INSERT INTO tbl_cliente_inscripcion VALUES("11","21","2","2020-08-01","2020-08-01","2020-08-31","2020-08-31","0","");
INSERT INTO tbl_cliente_inscripcion VALUES("12","21","1","2020-12-06","2020-12-06","2021-01-05","2021-01-05","1","");



DROP TABLE IF EXISTS tbl_clientes;

CREATE TABLE `tbl_clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) DEFAULT NULL,
  `tipo_cliente` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_matricula` int(11) DEFAULT NULL,
  `id_descuento` int(11) DEFAULT NULL,
  `compras` int(11) DEFAULT NULL,
  `ultima_compra` datetime DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `id_persona` (`id_persona`),
  KEY `id_matricula` (`id_matricula`),
  KEY `id_descuento` (`id_descuento`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_descuentocliente` FOREIGN KEY (`id_descuento`) REFERENCES `tbl_descuento` (`id_descuento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_matriculacliente` FOREIGN KEY (`id_matricula`) REFERENCES `tbl_matricula` (`id_matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_personacliente` FOREIGN KEY (`id_persona`) REFERENCES `tbl_personas` (`id_personas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_usuariocliente` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_clientes VALUES("15","22","Gimnasio","1","1","","","1");
INSERT INTO tbl_clientes VALUES("21","30","Gimnasio","1","3","","","");



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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_descuento VALUES("1","2x1","50","1","2020-12-04 23:19:49","");
INSERT INTO tbl_descuento VALUES("2","gratis","100","1","2020-12-04 23:20:57","");
INSERT INTO tbl_descuento VALUES("3","tercera edad","25","1","2020-12-04 23:22:02","");



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
  `cantidad_dias` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_inscripcion`),
  KEY `creado_por` (`creado_por`),
  CONSTRAINT `tbl_usuaricliente` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_inscripcion VALUES("1","mensual","300","30","1","2020-12-04 23:32:32","");
INSERT INTO tbl_inscripcion VALUES("2","quincenal","180","15","1","2020-12-04 23:33:42","");
INSERT INTO tbl_inscripcion VALUES("3","diaria","20","1","1","2020-12-04 23:34:15","");
INSERT INTO tbl_inscripcion VALUES("4","SEMANAL","50","5","1","2020-12-07 01:18:02","");



DROP TABLE IF EXISTS tbl_inventario;

CREATE TABLE `tbl_inventario` (
  `id_inventario` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_producto` int(11) DEFAULT NULL,
  `codigo` int(20) DEFAULT NULL,
  `nombre_producto` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio_venta` float DEFAULT NULL,
  `producto_minimo` int(11) DEFAULT NULL,
  `producto_maximo` int(11) DEFAULT NULL,
  `venta` int(45) DEFAULT NULL,
  `devolucion` int(45) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `id_proveedor` int(11) DEFAULT NULL,
  `precio_compra` int(11) NOT NULL,
  PRIMARY KEY (`id_inventario`),
  KEY `id_tipo_producto` (`id_tipo_producto`),
  KEY `id_proveedor` (`id_proveedor`),
  CONSTRAINT `tbl_proveedor_inventario` FOREIGN KEY (`id_proveedor`) REFERENCES `tbl_proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_tipoproducto_iventario` FOREIGN KEY (`id_tipo_producto`) REFERENCES `tbl_tipo_producto` (`id_tipo_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_objetos VALUES("1","Dashboard","dashboard","fas fa-tachometer-alt","2020-12-04 23:40:13","");
INSERT INTO tbl_objetos VALUES("2","Usuarios","usuarios","fas fa-users","2020-12-04 23:42:36","");
INSERT INTO tbl_objetos VALUES("3","Clientes","clientes","fas fa-user-circle","2020-12-04 23:43:34","");
INSERT INTO tbl_objetos VALUES("4","Stock","stock","fas fa-layer-group","2020-12-04 23:48:10","");
INSERT INTO tbl_objetos VALUES("5","Ventas","ventas","fas fa-cart-plus","2020-12-04 23:49:40","");
INSERT INTO tbl_objetos VALUES("6","Mantenimiento","mantenimiento","fas fa-sliders-h","2020-12-04 23:51:12","");
INSERT INTO tbl_objetos VALUES("7","Respaldo y Restauracion","respaldoyrestauracion","fas fa-download","2020-12-04 23:53:24","");
INSERT INTO tbl_objetos VALUES("8","Bitacora","bitacora","fas fa-bold","2020-12-04 23:54:21","");



DROP TABLE IF EXISTS tbl_pagos_cliente;

CREATE TABLE `tbl_pagos_cliente` (
  `id_pagos_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente_inscripcion` int(11) NOT NULL,
  `pago_matricula` float DEFAULT NULL,
  `pago_descuento` float DEFAULT NULL,
  `pago_inscripcion` float DEFAULT NULL,
  `pago_total` float DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pagos_cliente`),
  KEY `creado_por` (`creado_por`),
  KEY `id_cliente_inscripcion` (`id_cliente_inscripcion`),
  CONSTRAINT `tbl_pagos_cliente_ibfk_1` FOREIGN KEY (`id_cliente_inscripcion`) REFERENCES `tbl_cliente_inscripcion` (`id_cliente_inscripcion`),
  CONSTRAINT `tbl_usuario_pagos` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_pagos_cliente VALUES("4","1","50","25","300","325","1");
INSERT INTO tbl_pagos_cliente VALUES("7","1","","","300","300","");
INSERT INTO tbl_pagos_cliente VALUES("23","10","0","0","180","180","");
INSERT INTO tbl_pagos_cliente VALUES("24","11","0","0","180","180","");
INSERT INTO tbl_pagos_cliente VALUES("25","12","0","0","300","300","");



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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_parametros VALUES("1","ADMIN_CPASS","Grupo_6s","2020-12-04 23:57:16","");
INSERT INTO tbl_parametros VALUES("2","ADMIN_CORREO","grupo6ctrls@gmail.com","2020-12-04 23:58:17","");
INSERT INTO tbl_parametros VALUES("3","ADMIN_INTENTOS","0","2020-12-04 23:58:55","");
INSERT INTO tbl_parametros VALUES("4","ADMIN_VIGENCIA_CORREO","24","2020-12-05 00:00:41","");
INSERT INTO tbl_parametros VALUES("5","ADMIN_DIAS_VIGENCIA","365","2020-12-05 00:01:56","");
INSERT INTO tbl_parametros VALUES("6","ADMIN_CPUERTO","465","2020-12-05 00:03:19","");
INSERT INTO tbl_parametros VALUES("7","ADMIN_CHOST","smtp.gmail.com","2020-12-05 00:04:59","");
INSERT INTO tbl_parametros VALUES("8","ADMIN_CSMTP","ssl","2020-12-05 00:06:25","");
INSERT INTO tbl_parametros VALUES("9","ADMIN_PREGUNTAS","3","2020-12-05 00:07:19","");
INSERT INTO tbl_parametros VALUES("10","ADMIN_VIGENCIA_CLIENTE_MES","30","2020-12-05 00:08:26","");
INSERT INTO tbl_parametros VALUES("11","ADMIN_VIGENCIA_CLIENTE_QUINCENAL","15","2020-12-05 00:09:02","");
INSERT INTO tbl_parametros VALUES("12","ADMIN_VIGENCIA_CLIENTE_DIA","1","2020-12-05 00:09:32","");
INSERT INTO tbl_parametros VALUES("13","ADMIN_IMPUESTO","15","2020-12-05 00:10:12","");
INSERT INTO tbl_parametros VALUES("14","ADMIN_NOMBRE_EMPRESA","GIMNASIO LA ROCA ","2020-12-05 00:13:04","");
INSERT INTO tbl_parametros VALUES("15","ADMIN_DIRECCION_EMPRESA","VALLE DE ÁNGELES ","2020-12-05 00:13:56","");
INSERT INTO tbl_parametros VALUES("16","ADMIN_TELEFONO_EMPRESA","(504) 9988-9988","2020-12-05 00:15:18","");



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
  CONSTRAINT `tbl_rol_permisos` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_usuario_permisos` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_permisos VALUES("1","1","1","1","1","1","1","2020-12-05 00:22:28","");
INSERT INTO tbl_permisos VALUES("2","1","2","1","1","1","1","2020-12-05 00:23:13","");
INSERT INTO tbl_permisos VALUES("3","1","3","1","1","1","1","2020-12-05 00:23:44","");
INSERT INTO tbl_permisos VALUES("4","1","4","1","1","1","1","2020-12-05 00:23:54","");
INSERT INTO tbl_permisos VALUES("5","1","5","1","1","1","1","2020-12-05 00:24:06","");
INSERT INTO tbl_permisos VALUES("6","1","6","1","1","1","1","2020-12-05 00:24:18","");
INSERT INTO tbl_permisos VALUES("7","1","7","1","1","1","1","2020-12-05 00:24:27","");
INSERT INTO tbl_permisos VALUES("8","1","8","1","1","1","1","2020-12-08 03:24:11","");
INSERT INTO tbl_permisos VALUES("13","2","1","1","1","1","1","2020-12-08 03:11:47","");
INSERT INTO tbl_permisos VALUES("14","2","3","1","1","1","1","2020-12-08 03:12:53","");
INSERT INTO tbl_permisos VALUES("16","2","6","1","1","1","1","2020-12-08 03:17:38","");
INSERT INTO tbl_permisos VALUES("24","2","5","1","1","1","1","2020-12-08 12:09:09","");
INSERT INTO tbl_permisos VALUES("25","2","7","1","1","0","1","2020-12-08 12:12:33","");



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
  CONSTRAINT `tbl_documento_personas` FOREIGN KEY (`id_documento`) REFERENCES `tbl_documento` (`id_documento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_usuario_personas` FOREIGN KEY (`creado_por`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_personas VALUES("1","Super","Admin","1","000000000","usuarios","0000-00-00","","","","superadmin@correo.com","2020-12-05 00:30:28","");
INSERT INTO tbl_personas VALUES("22","JESUS","ZUNIGA","1","0801199907678","clientes","1990-01-22","M","50499999999","VALLE","jesus@correo.com","2020-12-05 19:09:02","1");
INSERT INTO tbl_personas VALUES("30","MARIA","AMADOR","2","0801199907645","clientes","1960-09-09","M","(504) 9966-7788","VALLE","maria@correo.com","2020-12-06 08:39:58","");



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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;




DROP TABLE IF EXISTS tbl_proveedores;

CREATE TABLE `tbl_proveedores` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;




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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_roles VALUES("1","Administrador","2020-12-05 00:19:03","","1","");
INSERT INTO tbl_roles VALUES("2","Default","2020-12-05 00:19:53","","1","");



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
  CONSTRAINT `tbl_rol_usuario` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_usuarios VALUES("1","1","SUPERADMIN","$2a$07$asxx54ahjppf45sd87a5au.1UP6zDSXc3b.CkjVjQR/OCpZlYz4hq","vistas/img/usuarios/SUPERADMIN/854.jpg","1","0","","","","2020-12-08 11:51:30","1");



DROP TABLE IF EXISTS tbl_venta;

CREATE TABLE `tbl_venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `numero_factura` int(11) NOT NULL,
  `productos` varchar(1000) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `impuesto` float DEFAULT NULL,
  `neto` float DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_venta`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `tbl_cliente_venta` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_usuario_venta` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;




SET FOREIGN_KEY_CHECKS=1;