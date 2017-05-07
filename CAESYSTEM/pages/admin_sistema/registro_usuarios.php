<?php
session_start();
?>
<?php
if($_SESSION["nivel"]!=1) {


header('Location: noadministrador.php');
exit;

}
?>


<html>
<head>

<link href="css/styles.css" rel="stylesheet"	type="text/css" />
<style type="text/css">

.style1 {
	FONT-weight: BOLD; 
    FONT-SIZE: 7pt; 
    COLOR: white; 
    FONT-FAMILY: Arial; 
    EXT-DECORATION: none;
    } 

.style11 {	FONT-weight: BOLD; 
    FONT-SIZE: 7pt; 
    COLOR: white; 
    FONT-FAMILY: Arial; 
    EXT-DECORATION: none;
}
.style111 {FONT-weight: BOLD; 
    FONT-SIZE: 7pt; 
    COLOR: white; 
    FONT-FAMILY: Arial; 
    EXT-DECORATION: none;
}
.Estilo2 {
	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo4 {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo11 {
	color: #000000;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
</style>
<title>Registro de Usuarios</title>


<link href="../../css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<form id="form2" name="form2" method="post" action="agregar_usuario.php">
 <table border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
    <tr>
      <td><span class="negrita12">Bienvenido</span>,
<?php if(isset($_SESSION["aceptado"])) { echo $_SESSION["login"];}else{echo Invitado;}?></td>
    </tr>
  </table>
  <h2 class="Estilo1">Registro de Usuarios</h2>
  <hr/>
<br>
<br>
<table width="320" border="0" align="center" cellpadding="0" cellspacing="0" class="ReportDetails">
   <tr valign="top">
    <td>
    <div id="ReportDetails">
    <table width="320" border="1" align="center">
		<tr>
		<td  colspan="2"  class="ReportTableHeaderCell" align="center">Registro de Usuarios</td>
	 	</tr>
            <tr>
              <td width="84" class="ReportTableHeaderCell">Login:</td>
              <td width="220" align="center" class="ReportDetailsOddDataRow"><input type="text" name="login" id="login" /></td>
            </tr>
			<tr>
             <td class="ReportTableHeaderCell">clave:</td>
             <td class="ReportDetailsOddDataRow" align="center"><input type="password" name="clave" id="clave" /></td>
			</tr>
            <tr>
              <td height="27" class="ReportTableHeaderCell">Re-Clave:</td>
              <td class="ReportDetailsOddDataRow" align="center"><input type="password" name="reclave" id="reclave" /></td> 
            </tr>
            <tr>
              <td class="ReportTableHeaderCell">Nivel:</td>
			  <td width="175" class="ReportDetailsEvenDataRow"align="center">
              <select name="nivel" id="nivel" value = "#">
                <option value="2" >Usuario</option>
                <option value="1">Admisitrador</option>
              </select></td>
            </tr>
			
            <tr>
                <td colspan="2" class="ReportDetailsOddDataRow">
				<div align="center" class="ReportDetailsEvenDataRow">
                <input type="submit" name="registrar" id="registrar" value="Registrar"/>
				</label>- <label>
				<input type="reset" value="Borrar" />
			</table>
		</div>
			</td>
			</tr>
			</table>
			
    
   </form>  
</body>
</html>
