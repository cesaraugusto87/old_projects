<html>
   <head>
      <title>Indique su Tipo de Usuario......</title>
      <script language="JavaScript" type="text/JavaScript">
         <!--
         function MM_openBrWindow(theURL,winName,features) { //v2.0
            window.open(theURL,winName,features);
         }
         function MM_jumpMenu(targ,selObj,restore){ //v3.0
            eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
            if (restore) selObj.selectedIndex=0;
         }
         //-->
      </script>
      <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
   </head>

<body>
   <form name="form1" method="post" action="">
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="187" height="58" border="5" align="center" class="Estilo4">
         <tr>
           <td height="44" align="center" valign="middle">
               <label>
			      <span class="boton">
				     Indique su Tipo Usuario  <br>
				     <select name="Seleccion" class="Estilo19" onChange="MM_jumpMenu('self',this,0)">
                        <option value="#" selected>-- Seleccione --</option>
	                    <option value="IngresarDatosProfesor.php">Profesor</option>
                        <option value="IngresarDatosPersonales.php">Estudiante</option>
                  </select>
                  </span>
               </label>
            </td>
         </tr>
     </table>
      <table width="87" border="1" align="center" bordercolor="#999999">
        <tr>
          <td><div align="center" class="boton"><a href="logearse.php">Regresar</a></div></td>
        </tr>
     </table>
</form>      
</body>
</html>
