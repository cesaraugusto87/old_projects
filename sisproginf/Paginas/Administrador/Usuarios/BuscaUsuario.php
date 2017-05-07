<?php 
   $tipousuario = $_GET['Tipo'];
?>
<html>
   <head>
      <title>Busca Por Cedula...</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
   </head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form action="VerificaParticipante.php" method="post" name="formulariocontraceña">
  <table width="167" border="5" align="center">
    <tr>
      <td><table width="399" height="100" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo4">
        <!--DWLayoutTable-->
        <tr>
          <th height="25">&nbsp;</th>
          <th valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</th>
          <th valign="middle"><div align="center">Ingresa C&eacute;dula </div></th>
          <th align="left" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</th>
        </tr>
        <tr>
          <th height="25">&nbsp;</th>
          <th valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</th>
          <th valign="middle"><div align="center">
              <input name="CampoCedula" type="text" class="entradas" id="cedula7" size="11" maxlength="8">
          </div></th>
          <th align="left" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</th>
        </tr>
        <tr>
          <th height="25">&nbsp;</th>
          <th valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</th>
          <th valign="middle"><div align="center">
              <input name="submit" type="submit" class="boton" value="Buscar">
          </div></th>
          <th align="left" valign="middle" ><!--DWLayoutEmptyCell-->&nbsp;</th>
        </tr>
        <tr>
          <th width="8" height="25">&nbsp;</th>
          <th width="118" valign="middle"> <p align="center" class="Estilo4">
              <input type="hidden" name="TipoUsuario" value="<?php echo $tipousuario;?>" >
          </p></th>
          <th width="139" valign="middle"><div align="center" class="boton"><a href="TipoParticipante.php">Atras</a></div></th>
          <th width="134" align="left" valign="middle" ><!--DWLayoutEmptyCell-->&nbsp;</th>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>