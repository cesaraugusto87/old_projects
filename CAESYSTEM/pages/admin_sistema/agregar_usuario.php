<?php
session_start();

	if(isset($_SESSION["aceptado"])) { echo $_SESSION["login"];}
	
	            else{echo Invitado;}

// conectamos con la base de datos
$con=pg_connect("host=localhost port=5432 user=postgres password=12345 dbname=proyecto");
if(!$con)
{
echo "Conexion no establecida, verifique sus datos";
}

$login2=$_POST['login'];
$clave2=$_POST['clave'];
$reclave2=$_POST['reclave'];

$cnivel=$_POST['nivel'];

$SQL="SELECT login FROM usuarios WHERE login='$login2'";
$busqueda=pg_query($SQL);
$compara=pg_fetch_array($busqueda);

if($compara["login"]==$login2)//SI DE NOMBRE DE USUARIO
{
	echo "Este nombre de usuario ya existe";
?>
	<br>
<?  echo "Por favor, selecciona otro";
	exit;
}
else //SINO DEL SI DE NOMBRE DE USUARIO
{

if($clave2 != $reclave2)
{
	echo "error de registro vuelve a intentar verifica contraseña";
	
}
else
{
$ingreso=pg_query ("INSERT INTO usuarios (login, clave, id_nivel) VALUES ('".$login2."', '".$clave2."', '".$cnivel."')");

if($ingreso)
{
echo "       Datos agregados con exito";
exit;
}
else{echo "      datos no agregados intenta de nuevo"; 

exit;}

pg_close($con);

}//FIN DEL SI DE CONTRASEÑA

}//FIN DEL SI DE NOMBRE DE USUARIO
?>     