<?php
   
   include('../../../funciones/conexion.php');
   $conexion = Conectarse();  
    
   session_start();
   $cedula   =  $_SESSION['Usuario'];
   $Tipo     =  $_SESSION['tipo'];
		
   $sql="Select * from id_sistema "; 		
   $resultado = pg_query($sql);
   $totalregistros = pg_num_rows($resultado);
   $row_cursos = pg_fetch_assoc($resultado);
?>
<html>
   <head>
      <title>Reporte</title>
      <link href="../../../funciones/estilo.css" rel="stylesheet" type="text/css" />
   </head>
<body>
   <table width="373" border="1" align="center">
      <tr>
         <td colspan="4">
		    <div align="center" class="Estilo16">		       Listado de Ubicacion por
		      Sistemas</div>		 </td>
      </tr>
      <tr>
         <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">
		<?php if ($totalregistros > 0){ ?>
		<table width="501" border="1" align="center">
          <tr bgcolor="#F3F3F3" class="boton">
            <td width="287"><div align="center" class="Estilo45">
              <div align="center">
                <div align="center" class="Estilo45"><span class="Estilo13"><font color="#990000"><strong>Nomenclatura</strong></font></span></div>
              </div>
            </div></td>
            <td width="62"><div align="center"><font color="#990000">Detalles</font></div></td>
            <td width="62"><div align="center"><font color="#990000">Modificar</font></div></td>
            <td width="62"><div align="center" class="Estilo45"><font color="#990000"><strong>Eliminar</strong></font></div></td>
          </tr>
		  
             <?php do { ?>
             <tr>
                <td>
                   <div align="left">
				      <p><span class="Estilo4">
				         <font color="#000000">
					        <?php echo $row_cursos['idnomenclatura']; ?>  </font></span></p> 
				      <?php if ($row_cursos['id_frecuencia']<> 'M')  {?>
				      <p><span><font color="#000000" size="2"><strong>Estante	=</strong> <?php echo $row_cursos['estante']; ?>
				          <strong>Cuerpo =</strong> <?php echo $row_cursos['cuerpo']; ?> 
                          <strong>Tramo =</strong> <?php echo $row_cursos['tramo']; ?> </font>
		              </span>
				             </p>
                      <font size="2"><?php }else { ?>
                      </f