<?php

class Conexion{

	public static function conectar(){

		$link = new PDO("mysql:host=localhost:3308;dbname=gym",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}

}