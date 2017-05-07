<?php
   $tipo=$_GET['Tipo'];
?>
<html>
   <head>
      <title>Olvid&eacute; mi contrase&ntilde;a...</title>
      
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
      <style type="text/css">
<!--
.Estilo22 {color: #990000}
-->
      </style>
</head>
   <body>
   <form action="VerificaOlvidoClave.php" method="post" name="formulariocontraceña">
      <p>&nbsp;</p><input name="Tipo" type="hidden" value=<? echo $tipo;?>>
      <p>&nbsp;</p>
      <table width="200" border="5" align="center">
        <tr>
          <td background="../../images/fondo.jpg"><table width="124" height="100" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo4">
            <!--DWLayoutTable-->
            <tr>
              <th height="25" valign="middle" class="boton Estilo22"><div align="center">Ingresa tu c&eacute;dula </div></th>
            </tr>
            <tr>
              <th height="25" valign="middle"><div align="center">
                <input name="CampoCedula" type="text" class="entradas" id="cedula7" size="11" maxlength="8">
              </div></th>
            </tr>
            <tr>
              <th height="25" valign="middle"><div align="center">
                <input name="submit" type="submit" class="boton" value="Buscar">
              </div></th>
            </tr>
            <tr>
              <th width="124" height="25" valign="middle"><table width="56" border="0" align="center" class="boton">
                <tr>
                  <td><div align="center"><a href="logearse.php">Regresar</a></div></td>
                </tr>
              </table></th>
            </tr>
          </table></td>
        </tr>
      </table>
      </form>
   </body>
</html>
