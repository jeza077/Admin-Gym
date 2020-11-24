<?php
error_reporting(E_PARSE);

//Carpeta donde se almacenaran las copias de seguridad
//define("BACKUP_PATH", "../../backup/") ;
const BACKUP_PATH =  "./backup/";
//const BACKUP_PATH =  "./backup/";
/*Configuración de zona horaria de tu país para más información visita
    http://php.net/manual/es/function.date-default-timezone-set.php
    http://php.net/manual/es/timezones.php
*/
date_default_timezone_set('America/Tegucigalpa');


class SGBD{

    private $user = "";

    //Servidor de mysql

    private  $server = ""; 

    //Nombre de la base de datos
    
    private $bd = "";

    //Contraseña de myqsl
    
    private $pass = "";

    
    function __construct($user,$server,$bd,$pass){
        $this->user=$user;
        $this->server=$server;
        $this->pass=$pass;
        $this->bd=$bd;
    }

    //Funcion para hacer consultas a la base de datos
    public  function sql($query){
       /* var_dump($this->server);
        exit();*/
        $con=mysqli_connect($this->server, $this->user, $this->pass, $this->bd);
        mysqli_set_charset($con, "utf8_spanish_ci");
        if (mysqli_connect_errno()) {
            printf("Conexion fallida: %s\n", mysqli_connect_error());
            exit();
        }else{
            mysqli_autocommit($con, false);
            mysqli_begin_transaction($con, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
            if($consul=mysqli_query($con, $query)){
                if (!mysqli_commit($con)) {
                    print("Falló la consignación de la transacción\n");
                    exit();
                }
            }else{
                mysqli_rollback($con);
                echo "Falló la transacción";
                exit();
            }
            return $consul;
        }
    }  

    //Funcion para limpiar variables que contengan inyeccion SQL
    public static function limpiarCadena($valor) {
        $valor=addslashes($valor);
        $valor = str_ireplace("<script>", "", $valor);
        $valor = str_ireplace("</script>", "", $valor);
        $valor = str_ireplace("SELECT * FROM", "", $valor);
        $valor = str_ireplace("DELETE FROM", "", $valor);
        $valor = str_ireplace("UPDATE", "", $valor);
        $valor = str_ireplace("INSERT INTO", "", $valor);
        $valor = str_ireplace("DROP TABLE", "", $valor);
        $valor = str_ireplace("TRUNCATE TABLE", "", $valor);
        $valor = str_ireplace("--", "", $valor);
        $valor = str_ireplace("^", "", $valor);
        $valor = str_ireplace("[", "", $valor);
        $valor = str_ireplace("]", "", $valor);
        $valor = str_ireplace("\\", "", $valor);
        $valor = str_ireplace("=", "", $valor);
        return $valor;
    }
}