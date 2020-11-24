

<?php
include './connet.php';

$usuario=$_POST['usuario'];
$servidor=$_POST['servidor'];
$nombrebd=$_POST['nombrebd'];
$contrasenia=$_POST['contrasenia'];
$restorePointP=$_POST['restorePoint'];
//var_dump($usuario,$servidor,$nombrebd,$contrasenia,$restorePointP);
$restorePoint=SGBD::limpiarCadena($restorePointP);
$sql=explode(";",file_get_contents($restorePoint));
$totalErrors=0;
set_time_limit (100);
$con=mysqli_connect($servidor, $usuario, $contrasenia, $nombrebd);//parametros enduro
$con->query("SET FOREIGN_KEY_CHECKS=0");
for($i = 0; $i < (count($sql)-1); $i++){
    if($con->query($sql[$i].";")){  }else{ $totalErrors++; }
}
$con->query("SET FOREIGN_KEY_CHECKS=1");
$con->close();
if($totalErrors<=0){
	echo json_encode(1);
	/*echo "Restauración completada con éxito";*/
}else{
	echo "Ocurrio un error inesperado, no se pudo hacer la restauración completamente";
}


