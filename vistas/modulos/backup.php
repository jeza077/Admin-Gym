<?php
require_once "../../controladores/mantenimiento.controlador.php";
require_once "../../modelos/mantenimiento.modelo.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
include './connet.php';

$usuario=$_POST['usuario'];
$servidor=$_POST['servidor'];
$nombrebd=$_POST['nombrebd'];
$contrasenia=$_POST['contrasenia'];

$day=date("d");
$mont=date("m");
$year=date("Y");
$hora=date("H-i-s");
$fecha=$day.'_'.$mont.'_'.$year;
$DataBASE=$nombrebd."_".$fecha."_(".$hora."_hrs).sql";
$tables=array();
$sgbd=new SGBD($usuario,$servidor,$nombrebd,$contrasenia);
$result=$sgbd->sql('SHOW TABLES');
if($result){
    while($row=mysqli_fetch_row($result)){
       $tables[] = $row[0];
    }
    $sql='SET FOREIGN_KEY_CHECKS=0;'."\n\n";
    $sql.='CREATE DATABASE IF NOT EXISTS '.$nombrebd.";\n\n";
    $sql.='USE '.$nombrebd.";\n\n";
    foreach($tables as $table){
        $result=$sgbd->sql('SELECT * FROM '.$table);
        // var_dump($result);
        // return $result;
        if($result){
            $numFields=mysqli_num_fields($result);
            $sql.='DROP TABLE IF EXISTS '.$table.';';
            $row2=mysqli_fetch_row($sgbd->sql('SHOW CREATE TABLE '.$table));
            $sql.="\n\n".$row2[1].";\n\n";
            for ($i=0; $i < $numFields; $i++){
                while($row=mysqli_fetch_row($result)){
                    $sql.='INSERT INTO '.$table.' VALUES(';
                    for($j=0; $j<$numFields; $j++){
                        $row[$j]=addslashes($row[$j]);
                        $row[$j]=str_replace("\n","\\n",$row[$j]);
                        if (isset($row[$j])){
                            $sql .= '"'.$row[$j].'"' ;
                        }
                        else{
                            $sql.= '""';
                        }
                        if ($j < ($numFields-1)){
                            $sql .= ',';
                        }
                    }
                    $sql.= ");\n";
                }
            }
            $sql.="\n\n\n";
        }else{
            $error=1;
        }
        // return $sql;
    }
    if($error==1){
        echo 'Ocurrio un error inesperado al crear la copia de seguridad 1';
    }else{
        chmod(BACKUP_PATH, 0777);
        $sql.='SET FOREIGN_KEY_CHECKS=1;';
        $handle=fopen(BACKUP_PATH.$DataBASE,'w+');
        if(fwrite($handle, $sql)){
            fclose($handle);
            echo json_encode(1);
            // return 'si';

            // echo 'Copia de seguridad realizada con éxito';
        }else{
            echo 'Ocurrio un error inesperado al crear la copia de seguridad2';

        }
    }
}else{
    echo 'Ocurrio un error inesperado';
}
mysqli_free_result($result);