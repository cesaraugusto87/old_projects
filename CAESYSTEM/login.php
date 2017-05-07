<?php
session_start();
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
<title>:::- Login</title>
	<meta http-equiv="Pragma" content="no-cache"/>
	<meta http-equiv="cache-control" content="no-cache"/> 
	<meta http-equiv="Expires" content="-1"/>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0"
	marginheight="0">

<form action="pages/comunes/logueo.php" method="post">
<div align="center">
<div>
  </div>
  <table width="606" height="118" border="0" align="center" bgcolor="#FFFFFF">
  <tr>
  <td height="114">  </td>
  </tr>
</table>
  <table width="606" height="281" border="0" align="center" bgcolor="#FFFFFF" background="images/caesystem3_copia.png">
    <tr>
      <td width="607" height="277" align="center" valign="top"><table width="252" height="158" border="0" align="right">
          <tr>
            <td width="252">
                <div align="justify">
                  <table border="0" align="left" class="bordeTabla" >
                    <tr>
                      <td width="215" class="ReportDetailsEvenDataRow"><div align="center"><span class="Estilo11">Inicio de Sesion</span></div></td>
                    </tr>
                    <tr>
                      <td ><div align="center" class="ReportDetailsEvenDataRow">
                          <table width="100%" height="100%"  border="0" >
                            <tr>
                              <td width="71" class="negrita12">Usuario:</td>
                              <td  width="159"><input name="username" type="text"
						 id="username" style="font-size:10px; font-family:Arial, Helvetica, sans-serif"
						value="" /></td>
                            </tr>
                            <tr class="Estilo2" >
                              <td class="negrita12">Contrase&ntilde;a:</td>
                              <td width="159"><input name="password" type="password"
						id="password" style="font-size:10px; font-family:Arial, Helvetica, sans-serif" /></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td align="right"><div align="left">
                                  <input style="font-size:12px" type="submit" name="submit" value="Entrar"/>
                              </div></td>
                            </tr>
                          </table>
                      </div></td>
                    </tr>
                  </table>
              </div></td>
          </tr>
          <tr>
            <td><div align="justify"></div></td>
          </tr>
        </table>      </td>
    </tr>
  </table>
  <table width="700" border="0">
    <tr>
      <td align="center" class="msgError"> 
	  </td>
    </tr>
  </table>
  </div>
</form>
</body>
</html>
