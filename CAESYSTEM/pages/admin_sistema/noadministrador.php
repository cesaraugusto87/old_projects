<?php
session_start();
?>

<html>
<head>

<title>ERROR ADMINISTRADOR</title>



<style type="text/css">
<!--
.color {
	color: #0FA1ED;
}
#bodyPan #bodyRightPan .contact a {
	font-size: 14px;
	font-family: Verdana, Geneva, sans-serif;
}
#bodyPan #bodyRightPan h3 a {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 14px;
}
.negrita {
	font-weight: bold;
}
-->
</style>
</head>

<body>
<div id="topPan">
  <p>&nbsp;</p>
  <div id="topContactPan2"></div>
</div>
<div id="bodyPan">
  <table width="682" border="0">
    <tr>
      <td><span class="negrita">Bienvenido</span>,
<?php if(isset($_SESSION["aceptado"])) { echo $_SESSION["login"];}else{echo Invitado;}?></td>
    </tr>
  </table>
<div id="bodyLeftPan">
    <h2>Advertencia:<span class="color"></span></h2>
    <table width="442" height="97" border="0">
      <tr>
        <td colspan="2"><hr /></td>
      </tr>
      <tr>
        <td colspan="2"><p>* Disculpa no tienes privilegios de administrador para usar esta funcion.</p></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  <div id="bodyRightPan">
    <h3 class="color">Login</h3>
    <form id="form1" name="form1" method="post" action="logueo.php">
      <table width="235" border="0">
        <tr>
          <td width="60"> Login:</td>
          <td width="144"><label>
            <input type="text" name="login" id="login" />
          </label></td>
        </tr>
        <tr>
          <td>Contrase&ntilde;a:</td>
          <td><label>
            <input type="password" name="clave" id="clave" />
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><label>
            <input type="submit" name="enviar" id="enviar" value="Enviar" />
          </label></td>
        </tr>
      </table>
    </form>
    
    <table width="231" border="0">
      <tr>
        <td colspan="2">&nbsp;
       
        </td>
      </tr>
      <tr>
        <td colspan="2"><a href="registro_usuarios.php">Registrar Nuevo Usuario</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
<h3><a href="salir.php">Cerrar sesi&oacute;n</a></h3>

		
</div>
</div>


</body>
</html>