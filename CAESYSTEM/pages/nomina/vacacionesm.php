<style type="text/css">

body1 {
margin: 0;
padding: 30px;
background: #FFF;
color: #666;
}

h1 {
font: bold 16px Arial, Helvetica, sans-serif;
}

p {
font: 11px Arial, Helvetica, sans-serif;
}

a {
color: #900;
text-decoration: none;
}

a:hover {
background: #900;
color: #FFF;
}

/*no es por molestar lo que pasa es que no me dio tiempo a entender por completo su css*/
</style>

<link type="text/css" href="../../js/dialog/demos/demos.css" rel="stylesheet" />
<link type="text/css" href="../../js/dialog/themes/base/ui.all.css" rel="stylesheet" />

<script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../../js/dialog/ui/i18n/ui.datepicker-es.js"></script>
<script type="text/javascript" src="../../js/dialog/ui/ui.datepicker.js" ></script>
<script type="text/javascript"  src="../../js/funcionesgenerales.js" ></script>	 


<script type="text/javascript">
var gente = new Array();
var contador=0;
  	$(document).ready(function(){
		$("a").click(function(){
			var title = $(this).attr("title");
			cargadores(title);
 		});//END CLICK	
	});


   function cargadores(title){
	   switch (title){
    				case "1":
					     var vo="2";
					  $("#bloque").html("");
					  enviardiv("vacaciones.php?tipo="+vo,"bloque");
					   break
    				case "2":
					    $("#bloque").html("");
						enviardiv("vacaciones2.php?","bloque");
       				  break
   				    case "3":
					 $("#bloque").html("");
      				 enviardiv("vacaciones4.php?","bloque");
       			     break
    			    default:
       				 document.write("Ese día no existe")
				}//fin el case 
			}//fin de cargadores
	
	
	


</script>

<table width="70%">
<tr align="center">
<td colspan="3" style="font-size:16px; color:#FFF" bgcolor="#0000FF"  >MODULO DE VACACIONES</td>
</tr>
<tr>
<td><a href="#" title="1" >Listado de personal en Vacaciones</a></td>
<td><a href="#" title="2">Mandar personal de Vacaciones</a></td>
<td><a href="#" title="3">Modificar Vacaciones</a></td>
</tr>
</table>
<table width="100%">
<tr>
<td ><div id="bloque" align="center"></div></td>
</tr>
</table>