<?php
   include('../../funciones/conexion.php');
   include('../../funciones/transformfecha.php');
   $conexion = Conectarse();   
   $sql="Select * from ofertacurso where (Status=1)"; 		
   $resultado = mysql_query($sql, $conexion);
   $totalregistros = mysql_num_rows($resultado);
   $row_cursos = mysql_fetch_assoc($resultado);   
?>
<html>
   <head>
   <title>Inicio</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
   <link href="file:///C|/xampp/htdocs/Portal_ADAW/ElementosActivos/Hojas_Estilos/estilo.css" rel="stylesheet" type="text/css">
   <script language="JavaScript" type="text/JavaScript">
   <!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
   <style type="text/css">
<!--
.Estilo22 {color: #990000}
.Estilo23 {FONT-SIZE: 13px; FONT-FAMILY: Arial, Helvetica, sans-serif; font-weight: bold;}
.Estilo24 {color: #666666}
-->
   </style>
   <link href="../../funciones/estilo.css" rel="stylesheet" type="text/css">
   <style type="text/css">
<!--
body {
	background-image: url();
}
-->
   </style></head>

<body onLoad="MM_preloadImages('../../Images/Eliminar_II.jpg')">
<table width="200" border="5" align="center" background="../../images/fondo.jpg">
  <tr>
    <td><table width="524" border="0" align="center" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr align="center" valign="middle">
        <td height="35" align="center" valign="middle" class="Estilo15">Buz&oacute;n Para PreInscribir un Curso </td>
      </tr>
      <tr>
        <td height="24" valign="top"><table width="38%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#dbeaf5">
            <!--DWLayoutTable-->
            <tr>
              <td width="506" height="24" align="center" valign="middle" bgcolor="#DEEBF7" class="Estilo20"><div align="center" class="boton">
                  <div align="center"><span class="Estilo16 Estilo23">Cursos Programa Informatica</span></div>
              </div></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="66" align="left" valign="top"><table width="485" border="1" align="center">
            <tr>
              <td colspan="3"><?php if ($totalregistros > 0){ $i=1;?>
                  <table width="812" border="1" align="center">
                    <tr class="boton">
                      <td width="17" class="boton Estilo22"><div align="center">No</div></td>
                      <td width="80" class="boton"><div align="center">Curso</div></td>
                      <td width="7" class="boton"><div align="center">Turno</div></td>
                      <td width="12" class="boton"><div align="center">Inicio</div></td>
					  <td width="12" class="boton"><div align="center">Fin</div></td>
					  <td width="7" class="boton"><div align="center">Cupos</div></td>
                      <td width="51" class="boton"><div align="center">Inscritos</div></td>
                      <td width="11" class="boton"><div align="center">Cupos Disponibles</div></td>
                      <td width="59" class="boton"><div align="center">Requisitos</div></td>
                      <td width="65" class="boton"><div align="center">Preinscribir</div></td>
                    </tr>
                    <?php do { ?>
                    <?php 
			    $a = $row_cursos['IdCursos'];
			   	$b = $row_cursos['Secuencia'];
				$c = $row_cursos['Status']; 				
			 ?>
                    <tr>
                      <td><div align="center" class="Estilo12"><?php echo $i; ?></div></td>
                      <td><div align="left"> <a href="../Administrador/modificarconocimiento.php?=&cedula=<?php echo $a; ?>"></a> <span class="Estilo12 Estilo24"> 
                          <?php 
							      $sqlcurso="Select * from curso where (IdCurso = '".$row_cursos['IdCursos']."')"; 		
                                  $resultadocurso = mysql_query($sqlcurso, $conexion);
                                  $row_curso = mysql_fetch_assoc($resultadocurso);   
							      echo $row_curso['Nombre']; 
							
							?>
                       </span> </div></td>
                      <td class="Estilo4"><div align="center" class="Estilo12"> <?php echo $row_cursos['Turno']; ?></div></td>
                      <td class="Estilo4"><div align="center"><span class="Estilo12"><?php echo cambiaf_a_normal($row_cursos['FechaIni']); ?></span></div></td>
					  <td class="Estilo12"><?php echo cambiaf_a_normal($row_cursos['FechaIni']); ?></td>
					  <td width="7" class="Estilo12"><div align="center"><?php echo $row_cursos['Cupos']; ?></div></td>
                <td class="Estilo12">
				   <div align="center">
				     <?php
				      $sqlPre="Select * from preinscripcion Where ((IdCurso='".$row_cursos['IdCursos']."')and(Secuencia='".$row_cursos['Secuencia']."'))"; 		
                      $resultadopre = mysql_query($sqlPre, $conexion);
                      $totalregistrospre = mysql_num_rows($resultadopre);                      
					  echo $totalregistrospre;
				   ?>
		           </div></td>
                <td class="Estilo12"><div align="center"><?php echo ($row_cursos['Cupos'] - $totalregistrospre);?></div></td>
                      <td class="Estilo4"><div align="center"><a href="DetalleCurso.php?Id=<? echo $row_cursos['IdCursos'];?>"><img src="../../images/ojo2.gif" alt="2" width="20" height="17" border="0"></a></div></td>
                      <td class="Estilo4"><div align="center" class="Estilo12"><a href="preinscribe.php?Curso=<?php echo $a; ?>&Sec=<?php echo $b; ?>"><img src="../../images/feather.gif" alt="1" width="22" height="16" border="0"></a></div></td>
                    </tr>
                    
                    <?php $i=$i+1;}while ($row_cursos = mysql_fetch_assoc($resultado)); ?>
                  </table>
                <?php }else{echo"<span class='Estilo12'>No existen Cursos Dispònible para la fecha en el Sistema</span>";}?>
              </tr>
            <tr>
              <td width="388" align="left" valign="top"><div align="left"><img src="../../Images/sombrilla_izq.jpg" alt="adf" width="258" height="5"></div></td>
              <td width="53"><table width="53" border="0" align="right" class="boton">
                  <tr>
                    <td width="45"><div align="center"><a href="BandejaEntrada.php">Regresar</a></div></td>
                  </tr>
              </table></td>
              <td width="359" align="left" valign="top"><div align="right"><img src="../../images/sombrilla_der.jpg" alt="q" width="227" height="5"></div></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="13" valign="top" ><div align="left">
            <p align="center" class="Estilo4"><br>
              Seleccione Curso a Pre-Inscribir.... <br>
              <br>
              Recuerde Que para Formalizar la Inscribcion debe Dirigirse a Nuestras Oficinas: </p>
        </div></td>
      </tr>
      <tr>
        <td height="13" valign="top" ><div align="center">
            <table width="519" border="0">
              <tr>
                <td><div align="center"><strong class="Estilo4"><br>
                  </strong><span class="Estilo4"><strong> CFS Manuel Piar (INCES) -Calle Universidad Frente al Palacio de Justicia<br>
                    Altavista - Pto Ordaz - Estado Bolivar - Venezuela<br>
                    Telf: 02869611710</strong></span></div></td>
              </tr>
            </table>
          <span class="Estilo4"><strong><br>
        </strong></span></div></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
