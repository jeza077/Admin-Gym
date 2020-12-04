<?php

class Conexion{

	public static function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=gym_la_roca2",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}

}