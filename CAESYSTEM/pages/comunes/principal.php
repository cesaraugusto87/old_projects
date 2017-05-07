<?php
include('../../permisos.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>:::CAESYSTEM:::</title>
<link href="../../css/styles.css" rel="stylesheet"	type="text/css" />


<div align=rigth>
<pre>
<marquee scrolldelay="500" direction="down" align="bottom" width="100%" height="35" onMouseOver="this.stop()"
onMouseOut="this.start()"><img src="../../images/caesystem3.jpg" width="80" height="40">		<img src="../../images/caesystem3.jpg" width="80" height="40"> 		<img src="../../images/caesystem3.jpg" width="80" height="40">		<img src="../../images/caesystem3.jpg" width="80" height="40">		<img src="../../images/caesystem3.jpg" width="80" height="40">		<img src="../../images/caesystem3.jpg" width="80" height="40">		<img src="../../images/caesystem3.jpg" width="80" height="40">		<img src="../../images/caesystem3.jpg" width="80" height="40">
<marquee width="100%" onMouseOver="this.stop()"
onMouseOut="this.start()" behavior=alternate scrolldelay="10"><i><div  align="center"><img  src="../../images/caesystem4.jpg"/></div></i></marquee> 
</pre></marquee>
</div>


</head>
<body>
  <table width="79%" height="769" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr >
      <td  colspan="2"   height="123"align="center" bordercolor="#FFFFFF" ><iframe  id="iframetop" align="middle"  name="iframetop"  src="top.html" width="100%" height="100%" frameborder="0"marginwidth=0 marginheight=0></iframe></td>
    </tr>
	<tr class="cabecera" >
      <td height="23"  align="left" bordercolor="#FFFFFF" ></td>
      <td  align="right" bordercolor="#FFFFFF" >
      Ciudad Guayana- Estado Bolivar , Venezuela.</td>
	</tr>
	
    <tr>
      <td   height="500"  width="20%"><iframe src="menu.php"  id="iframemenu" name="iframemenu"  
	  height="100%" width="100%"   frameborder="0" marginwidth=0 marginheight=0></iframe></td>
      <td  height="500" width="80%"class="bordeTabla"><iframe  id="iframecenter" name="iframecenter"  src="home.html" width="100%" height="100%" frameborder="0"marginWidth=0 marginHeight=0></iframe></td>
    </tr>
	
		<tr class="cabecera" >
      <td  align="left" bordercolor="#FFFFFF" >&nbsp;</td>
      <td align="right" bordercolor="#FFFFFF" ><?php if(isset($_SESSION["aceptado"])) {?> Usuario: <?php echo $_SESSION["login"];}else{echo Invitado;}?>. <?php echo (strtoupper($_SESSION["tipo"]));?></td>
    </tr>
 
    <tr>
      <td height="100" colspan="2" bordercolor="#FFFFFF"><iframe  src="copyright.html" width="100%" height="100%" frameborder="0"marginWidth=0 marginHeight=0></iframe></td>
    </tr>
</table>

</body>
</html>
