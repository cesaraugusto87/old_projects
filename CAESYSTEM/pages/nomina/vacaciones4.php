<?php
//include('../../permisos.php');
	    
?>
     


<script type="text/javascript">
var gentepu= new Array();
var contador=0;
  	$(document).ready(function(){
		refres();
		ponercalendarios();
	});


   function confir(){
	   var aux,inicio,fin;
	   var gente = new Array();
	   inicio=$("#inicio").val();
	   fin=$("#fin").val();
	   gente=iguala(gente);
	       if (fin!="" && gente.length>0) {
				if (confirm ("Desea reincorporar a estas personas?")){
				for (h=0;h<gente.length;h++){
						aux=gente[h];
						enviardiv("vacaciones3.php?gente="+aux+"&ini="+inicio+"&final="+fin+"&desi="+3);
						     }//for final
							 refres();
							}else{
							alert("Desechando campos");
							}//fin de selector
								}else{
								alert("Complete todos los campos!!!");
								refres();
							}//inicio debe ser algo!!
							refres();
						}//fin de funcion
		
	
	
	function refres(){
		$("conte").html("");
		var jo="3";
		enviardiv("vacaciones.php?tipo="+jo,"conte");
			}	

	
		
	function apunta(obj) {
    if (obj.checked == true){
	   gentepu[contador]=obj.value;
	   contador++;
   }else{
       for (i=0;i<gentepu.length;i++){
		   if (gentepu[i]==obj.value){
			    delete gentepu[i];
				gentepu[i]=null;
			   }
		   }
	   			}
	}//fin de apuntador  

	function iguala(gente){
		var conta=0;
		for (i=0;i<gentepu.length;i++){
			if (gentepu[i]!=null){
				gente[conta]=gentepu[i];
				conta++;
				}
			}
			return gente;
		}

</script>

<body>
<div id="izq" align="center">
<table width="70%"  border="1" align="center" style="font-size:12px"  >
<tr class="ReportTableHeaderCell">
<td>Tmp Vacaciones</td>
<td style="font-size:12px">Fecha Fin</td>
<td ><input name="fin" type="text" id="fin" value="" class="date" readonly="readonly"/></td>
</tr>
</table>
</div>
<div id="conte"></div>
<div align="center"><input type="button" name="confirmar" id="confir" value="Confirmar" onClick="confir();"  /></div>
</body>
</html>
