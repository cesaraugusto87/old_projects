<html>
   <head>
   <title>Documento sin t&iacute;tulo</title>
   <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css">
   <script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
   </script>
   </head>
   <script language="JavaScript" type="text/JavaScript">
<!--

   function MM_openBrWindow(theURL,winName,features) { //v2.0
   window.open(theURL,winName,features);
   }
function compruebaFormulario(autorizado)
{
	if (! autorizado)
	{
		alert ('Contraseña o nombre de usuario icorrectos');
		return (false);
	}
	else
	{
		MM_openBrWindow("Htm/est_BuzonEntrada.php",target="_top");
	}
	return (true);
}
//-->
</script>
<body>
<form name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="311" height="299" border="8" align="center">
    <tr>
      <td height="25"><div align="right"><span class="Estilo11"><img src="../../../images/LOGOTRANS.jpg" alt="Bandeja  para Data de Usuarios" width="52" height="41" align="left">Consultar Datos de los Usuarios </span><span class="Estilo13"> </span> </div></td>
    </tr>
    <tr>
      <td height="198" background="../../../images/fondo.jpg"><p>&nbsp;</p>
      <table width="187" height="58" border="5" align="center" class="Estilo4">
        <tr>
          <td height="44" align="center" valign="middle"><label> <span class="boton"> Indique Tipo Usuario a Buscar <br>
                  <select name="select" class="Estilo19" onChange="MM_jumpMenu('self',this,0)">
                    <option value="TipoUsuario.php" selected>-- Seleccione --</option>
                    <option value="PideCedulaProfesor.php">Profesor</option>
                    <option value="PideCedula.php">Estudiante</option>
                  </select>
            </span> </label>
          </td>
        </tr>
      </table>
        <table width="87" border="1" align="center" bordercolor="#999999">
          <tr>
            <td><div align="center" class="boton"><a href="../Buzon/AdminUsuarios.php">Regresar</a></div></td>
          </tr>
        </table>
        <p>&nbsp;</p>
          <p>&nbsp;</p></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  </form> 
     
</body>
</html>
