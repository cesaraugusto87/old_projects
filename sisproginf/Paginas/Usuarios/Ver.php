<?php
   $clave =   $_GET['Clave'];
   $login =   $_GET['Login'];
?>
<html>
   <head>
      <title>Contrase&ntilde;a</title>
      <link href="estilo.css" rel="stylesheet" type="text/css">
      <link href="../ElementosActivos/Hojas_Estilos/estilo.css" rel="stylesheet" type="text/css">
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
      <script type="text/JavaScript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
      </script>
   </head>
<body>
<form action="logearse.php" method="post" name="form1">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="402" border="5" align="center" background="../../images/fondo.jpg">
    <tr>
      <td><div align="center" class="Estilo16">Recuerda Entrar y Cambiar tu Passwor por Seguridad </div></td>
    </tr>
    <tr>
      <td><table width="156" height="123" border="0" align="center" cellpadding="0" cellspacing="0">
        <!--DWLayoutTable-->
        <tr>
          <th width="168" height="19" valign="top" class="Estilo4"><div align="center"><strong>Tu Login es: </strong></div></th>
        </tr>
        <tr>
          <th height="21" valign="top" class="Estilo4"><div align="center"><span class="cursos_despl3">
              <input name="textfield2" type="text" class="Estilo20" value="<?php echo $login; ?>" size="15">
          </span></div></th>
        </tr>
        <tr>
          <th height="21" valign="top" class="Estilo4"><div align="center"><span class="cursos_despl3"><Br>
                <strong>Tu contrase&ntilde;a es:</strong></span></div></th>
        </tr>
        <tr>
          <th height="21" valign="top" class="Estilo4"><div align="center"><span class="cursos_despl3">
              <input name="textfield" type="text" class="Estilo20" value="<?php echo $clave; ?>" size="15">
          </span></div></th>
        </tr>
        <tr>
          <th height="16"></th>
        </tr>
        <tr>
          <th height="25" valign="top"><div align="center">
              <input name="submit" type="submit" class="boton" onClick="MM_callJS('mientras()')" value="Salir">
          </div></th>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
