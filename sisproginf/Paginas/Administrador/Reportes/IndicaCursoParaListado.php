<?php
   $cursos = $_GET['Id'];   
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
      <style type="text/css">
<!--
.Estilo22 {color: #990000}
-->
      </style>
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

<body>
<form action="ListadoParticipantesPorCurso.php" method="post" name="form1" target="_blank">
<table width="200" border="5" align="center" background="../../../images/fondo.jpg">
  <tr>
    <td><table width="185" height="150" border="0" align="center" cellpadding="0" cellspacing="0" class="Estilo4">
      <!--DWLayoutTable-->
      <tr>
        <th height="25" valign="middle" class="boton Estilo22"><div align="center" class="Estilo22">Indica Curso </div></th>
      </tr>
      <tr>
        <th height="25" valign="middle"><div align="center">
          <?php 
		     if($cursos == ""){
			      //Libreria que permite conectarse a la base de datos 
                  include('../../../funciones/conexion.php');
				  include('../../../funciones/calendario/calendario.php');
                  $conex = Conectarse(); 							   
               	  $sql="SELECT * FROM ofertacurso WHERE (Status=1) group by IdCursos order by FechaIni";
			   	  $resultado_set = mysql_query ($sql, $conex);
			      $ifilas = mysql_num_rows ($resultado_set);
		   	   ?>
          <select name="CampoCurso" class="Estilo12"  maxlength="50" onChange="MM_jumpMenu('self',this,0)">
		    <option value="0">-- Seleccione --</option>
            <?php
					    for ($ij=0; $ij < $ifilas; $ij++) {
						   $id = mysql_result($resultado_set, $ij, 0); 
						   $sql2="SELECT * FROM curso WHERE (IdCurso='".$id."') order by Nombre";
			   	           $resultado_set2 = mysql_query ($sql2, $conex);
						   $row = mysql_fetch_assoc($resultado_set2); 						
						   $nombrecurso = $row['Nombre']; 						   
				     ?>
            <option value="IndicaCursoParaListado.php?Id=<?php echo $id; ?>"><?php echo $nombrecurso; }?></option>
          </select>
		  <? }else{ 
		    //Libreria que permite conectarse a la base de datos 
                  include('../../../funciones/conexion.php');
				  include('../../../funciones/calendario/calendario.php'); 
		    $conex = Conectarse(); 
		    $sql = "SELECT * FROM curso where IdCurso = '".$cursos."'";
   	   	    $resultado_set = mysql_query ($sql, $conex);
            $ifilas = mysql_num_rows ($resultado_set);
		  ?>	   
		     <select name="CampoCurso" class="Estilo12"  maxlength="50" onChange="MM_jumpMenu('self',this,0)">		    
            <?php
					    for ($ij=0; $ij < $ifilas; $ij++) {
					       $nombrecurso = mysql_result($resultado_set, $ij, 1); 
						   $id = mysql_result($resultado_set, $ij, 0);  						
				     ?>
            <option value="<?php echo $id; ?>"><?php echo $nombrecurso; }?></option>
          </select>
		  <? }?>
        </div></th>
      </tr>
      <tr>
        <th height="25" valign="middle" class="boton Estilo22"><div align="center" class="Estilo22">Indica Secuencia </div></th>
      </tr>
      <tr>
        <th height="25" valign="middle"><div align="center">
		   <?php
		         $sqloferta="SELECT * FROM ofertacurso where ((IdCursos = '".$cursos."')and(Status=1)) order by Secuencia";
			     $resultado_oferta = mysql_query ($sqloferta, $conex);
			     $ifilasOferta = mysql_num_rows ($resultado_oferta);
			  
		   ?>	  
          <select name="CampoOferta" class="Estilo12"  maxlength="50" >
            <option value="0">-- Seleccione --</option>
            <?php
			   for ($ij=0; $ij < $ifilasOferta; $ij++) {
			      $secuencia = mysql_result($resultado_oferta, $ij, 1); 
			?>
            <option value="<?php echo $secuencia; ?>"><?php echo $secuencia; }?></option>
          </select>
        </div></th>
      </tr>
      <tr>
        <th height="25" valign="middle"><div align="center">
          <input name="Listar" type="submit" class="boton" value="Listar">
        </div></th>
        </tr>
      <tr>
        <th height="25" valign="middle"><table width="56" border="0" align="center" class="boton">
            <tr>
              <td><div align="center"><a href="../Buzon/reportes.php">Regresar</a></div></td>
            </tr>
                </table></th>
        </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
