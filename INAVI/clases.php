<?php 

include_once('Connections/bd_inavi.php');

function cambiar_fecha($fecha){ 
	if ($fecha!=""){
		list($dia,$mes,$anno)=split("-",$fecha);
		$lafecha=$anno."-".$mes."-".$dia; 
		return $lafecha; 
	}
	else return "";
} 


function mostrar_fecha($fecha){ 
	if ($fecha!=""){
		list($anno,$mes,$dia)=split("-",$fecha);
		return ($dia."-".$mes."-".$anno); 
	}
	else return "";
} 

/****************************************** FUNCIONES INSERT *************************************/


	function insertar_usuario($bd_inavi,$login,$clave){
		$sql = "INSERT INTO usuario (Usuario, Clave) values ('$login', '$clave')";
		return mysql_query($sql,$bd_inavi);
	
	}
	
	
		function  insertar_saldo_contr($bd_inavi,$contrato,$retencion,$oenr,$fecha){
		$sql = "INSERT INTO saldocontratista (fk_idcontrato,retencion,fecha,oenr)
				VALUES ('$contrato','$retencion','$fecha',$oenr)";
		return mysql_query($sql,$bd_inavi);	
	}
	
	function insertar_saldo_inst($bd_inavi,$contrato,$indemniz,$multa,$anticipo,$obra_rel,$fecha){
		$sql = "INSERT INTO saldoinstitucion (fk_idcontrato,indemnizacion,multaatrasada,obrarelacionadanoejecutada,
				anticipoporamortizar,fecha)
				VALUES ('$contrato','$indemniz','$multa','$obra_rel','$anticipo','$fecha')";
				
				echo $sql;
		return mysql_query($sql,$bd_inavi);
	}
	
		
	function insertar_fianza_contrato($bd_inavi,$contrato,$fianza,$emitida_por,$poliza,$monto){
		$sql = "INSERT INTO fianzacontrato (fk_idcontrato,fk_idfianza,emitida_por,numeropoliza,monto)
				VALUES ('$contrato','$fianza','$emitida_por','$poliza',$monto)";
		return mysql_query($sql,$bd_inavi);	
	}
	
	function insertar_obra_noejecutada($bd_inavi,$contrato,$fecha,$monto){
		$sql = "insert into obranoejecutada (fk_idcontrato,obraporejecutar,fecha) values ('$contrato',$monto,'$fecha')";
		return mysql_query($sql,$bd_inavi);	
	}
	
	function insertar_valuacion_contrato($bd_inavi,$fianza,$valuacion,$fecha,$monto,$anticipo){
		$sql = "INSERT INTO cuentavaluaciones (fk_idvaluaciones,fk_idfianzacontrato,fecha, monto_bruto,anticipo)
				VALUES ('$valuacion','$fianza','$fecha',$monto,$anticipo)";
		return mysql_query($sql,$bd_inavi);	
	}
	
	
	function insertar_obra_ejecutada($bd_inavi,$contrato,$fecha_oejec,$monto){
		$sql = "INSERT INTO obraverificada (fk_idcontrato,fechaoverificada,saldo)
				VALUES ('$contrato','$fecha_oejec','$monto')";
		return mysql_query($sql,$bd_inavi);
	}

	
	function insertar_actas_contrato($bd_inavi,$acta,$contrato,$fecha,$descripcion,$fechad,$fechah){
		$sql = "INSERT INTO actas_contrato (fk_id_actas,fk_idcontrato,fecha_actas,descripcion,desde,hasta)
				VALUES ('$acta','$contrato','$fecha','$descripcion','$fechad','$fechah')";
		return mysql_query($sql,$bd_inavi);
	}		

	function insertar_cuentas_contrato($bd_inavi,$contrato,$disminuciones,$obrasextras,$aumentos,$fecha){
		$sql = "INSERT INTO cuentacontrato (fk_idcontrato,disminuciones,obrasextras,aumentos,fecha)
				VALUES ('$contrato','$disminuciones','$obrasextras','$aumentos','$fecha')";
		return mysql_query($sql,$bd_inavi);
	}
	
	function insertar_valuacion($bd_inavi,$nombre_val){
		$sql="insert into valuaciones (descripcion) values ('$nombre_val')";
		return mysql_query($sql,$bd_inavi);
	}
	
	function insertar_empresa($bd_inavi,$empresa,$rif,$represent,$cedula){
		$sql="insert into empresa (id_empresa,nombre_e,representante,ced_representant) values ('$rif','$empresa','$represent','$cedula')";
		 return mysql_query($sql,$bd_inavi);
	
	}
	
	function insertar_contrato($bd_inavi,$num_contrato,$f_firma,$empresa,$entidad,$objeto,$monto,$limite,$inicio,$terminacion){
		$sql = "INSERT INTO contrato (id_contrato,fecha,fk_idempresa,fk_identidad,objeto,monto_original,limite,inicio,terminacion)
				VALUES ('$num_contrato','$f_firma','$empresa','$entidad','$objeto',$monto,$limite,'$inicio','$terminacion')";
		return mysql_query($sql,$bd_inavi);
	}
	
	function insertar_acta($bd_inavi,$nombre_acta){
		
		$sql="insert into actas (descripcion_actas) values ('$nombre_acta')";
		return mysql_query($sql,$bd_inavi);
	}

	function insertar_fianza($bd_inavi,$nombre_fianza){
		$sql="insert into fianza (descripcionf) values ('$nombre_fianza')";
		return mysql_query($sql,$bd_inavi);
	}
	
	function insertar_entidad($bd_inavi,$nombre){
		$nombre = ucfirst($nombre);
		$sql="insert into entidad (descripcion_ent) values ('$nombre')";
		return mysql_query($sql,$bd_inavi);
	}
	
	
/****************************************** FUNCIONES SELECT *************************************/

	
	function concat_query($tablas,$campos,$condiciones){
		$query="SELECT ".$campos." FROM ".$tablas." WHERE ".$condiciones;
		return $query; 
	}
	
	
	function construir_consulta($contrato,$empr,$fecha1,$fecha2){
		$cond="";
		if ($empr!=""){	
			//$id_empresa=buscar_id_empresa($bd_inavi,$empr);
			$cond=" fk_idempresa='$empr' ";
		}
		if ($contrato!="")
			if ($cond=="")
				$cond=" id_contrato like '%$contrato%' ";
			else
				$cond=$cond." AND id_contrato like '%$contrato%' ";

		if ($fecha1!="")
			if ($cond=="")
				$cond=" fecha>='$fecha1' && fecha<='$fecha2'";
			else
				$cond=$cond." AND (fecha>='$fecha1' && fecha<='$fecha2') ";

		return $cond;
	}
	
	function buscar_nombre_e($bd_inavi,$id){
		$regs=mysql_query("SELECT nombre_e FROM empresa WHERE id_empresa='$id'", $bd_inavi);
		$empr=mysql_fetch_assoc($regs);
		return($empr['nombre_e']);
	}

	function buscar_id_empresa($bd_inavi,$empresa){
		$regs=mysql_query("SELECT id_empresa FROM empresa WHERE nombre_e='$empresa'", $bd_inavi);
		$empr=mysql_fetch_assoc($regs);
		return($empr['id_empresa']);
	}
	
	function consultar_contrato($bd_inavi,$contrato){
		$regs=mysql_query("SELECT * FROM contrato WHERE id_contrato='$contrato'", $bd_inavi);
		return mysql_fetch_assoc($regs);
	}	
	
	function consultar_empresa($bd_inavi,$empresa){
		$regs=mysql_query("SELECT * FROM empresa WHERE id_empresa='$empresa'", $bd_inavi);
		return mysql_fetch_assoc($regs);
	}		
	
	function consultar_cuenta_c($bd_inavi,$contrato){
		$regs=mysql_query("SELECT * FROM cuentacontrato WHERE fk_idcontrato='$contrato'", $bd_inavi);
		return mysql_fetch_assoc($regs);
	}			
	
	function consultar_obra_v($bd_inavi,$contrato){
		$sql = "SELECT * FROM obraverificada WHERE id_obraverificada = 
				(SELECT id_obraverificada FROM obraverificada where fechaoverificada = 
				(SELECT MAX(fechaoverificada) FROM obraverificada WHERE fk_idcontrato = '$contrato') AND fk_idcontrato = '$contrato')";

		 return mysql_fetch_assoc(mysql_query($sql, $bd_inavi));
	}
	
	function consultar_garantias($bd_inavi,$contrato){
		return mysql_query("SELECT * FROM fianzacontrato,fianza WHERE fk_idfianza=id_fianza AND fk_idcontrato='$contrato'", $bd_inavi);
		//return $regs;
	}			
	
	function nombre_entidad($bd_inavi,$entidad){
		$regs=mysql_query("SELECT descripcion_ent FROM entidad WHERE id_entidad='$entidad'", $bd_inavi);
		$ent=mysql_fetch_assoc($regs);
		return($ent['descripcion_ent']);

	}			
	
	function buscar_id_entidad($bd_inavi,$entidad){
		$regs=mysql_query("SELECT id_empresa FROM empresa WHERE nombre_e='$entidad'", $bd_inavi);
		$empr=mysql_fetch_assoc($regs);
		return($empr['id_empresa']);
	}	
	
	function select_empresas($bd_inavi, $condicion){
		if ($condicion=="")
			$sql = "select * from empresa order by nombre_e ASC";
		else
			$sql = "select * from empresa WHERE ".$condicion." order by nombre_e ASC";
		
		return (mysql_query($sql,$bd_inavi));
	}
	
	function select_entidades($bd_inavi){
		$sql = "select * from entidad order by descripcion_ent ASC";
		return (mysql_query($sql,$bd_inavi));
	}
	

	function verificar_existente($bd_inavi,$tabla,$campo_desc,$campo){
		$sql="SELECT * FROM $tabla WHERE $campo_desc='$campo'";
		return (mysql_num_rows(mysql_query($sql,$bd_inavi)));
	}
	

	
	function select_actas($bd_inavi){
		$sql = "select * from actas order by descripcion_actas ASC";
		return (mysql_query($sql,$bd_inavi));
	}

	function select_fianzas($bd_inavi){
		$sql = "select * from fianza order by descripcionf ASC";
		return (mysql_query($sql,$bd_inavi));
	}
	
	function select_contratos($bd_inavi){
		$sql = "select id_contrato from contrato order by id_contrato ASC";
		return (mysql_query($sql,$bd_inavi));
	}
	

	function consultar_monto_contrato($bd_inavi,$contrato){
		$sql = "SELECT monto_original FROM contrato WHERE id_contrato = '$contrato'";
		$ent = mysql_fetch_assoc(mysql_query($sql,$bd_inavi));
		return ($ent['monto_original']);
	}


	function select_valuaciones($bd_inavi){
		$sql = "select * from valuaciones order by descripcion ASC";
		return (mysql_query($sql,$bd_inavi));
	}

	function buscar_anticipo_contrato($bd_inavi,$contrato){
		$sql = "select id_fianzacontrato,monto from fianzacontrato,fianza where fianzacontrato.fk_idcontrato = '$contrato' 
				AND fianzacontrato.fk_idfianza = fianza.id_fianza AND fianza.descripcionf = 'Anticipo'";
		return mysql_fetch_assoc(mysql_query($sql,$bd_inavi));
	}
	

	
	function sumar_anticipos($bd_inavi,$contrato){
		$sql = "SELECT SUM(cuentavaluaciones.anticipo) as suma FROM cuentavaluaciones,fianzacontrato WHERE cuentavaluaciones.fk_idfianzacontrato = 
				fianzacontrato.id_fianzacontrato AND fianzacontrato.fk_idcontrato = '$contrato'";
		$consulta_total = mysql_fetch_assoc(mysql_query($sql,$bd_inavi));
		return $consulta_total['suma'];
	}
	
	function calcular_anticipo($bd_inavi,$contrato){
		$suma_ant = sumar_anticipos($bd_inavi,$contrato);
		$consulta_ant = buscar_anticipo_contrato($bd_inavi,$contrato);
		$anticipo = $consulta_ant['monto'];
		return ($anticipo-$suma_ant); // Anticipo amortizado - Anticipo Entregado
	
	}
	
	function calcular_indemnizacion($bd_inavi,$contrato){
		$verif = consultar_obra_v($bd_inavi,$contrato);
		$total_v = $verif['saldo'];
		$cont = consultar_contrato($bd_inavi,$contrato);
		$inicial_contrato = $cont['monto_original'];
		return ($inicial_contrato - $total_v) * 0.12;
	
	}
	
	function sumar_montos_brutos($bd_inavi,$contrato){
		$sql = "SELECT SUM(cuentavaluaciones.monto_bruto) as suma FROM cuentavaluaciones,fianzacontrato WHERE cuentavaluaciones.fk_idfianzacontrato = 
				fianzacontrato.id_fianzacontrato AND fianzacontrato.fk_idcontrato = '$contrato'";
		$consulta_total = mysql_fetch_assoc(mysql_query($sql,$bd_inavi));
		return $consulta_total['suma'];
	}
	
	function consultar_obra_verif($bd_inavi,$contrato){
		$sql = "SELECT saldo FROM obraverificada WHERE id_obraverificada = 
				(SELECT id_obraverificada FROM obraverificada where fechaoverificada = 
				(SELECT MAX(fechaoverificada) FROM obraverificada WHERE fk_idcontrato = '$contrato') AND fk_idcontrato = '$contrato')";

		$consulta_total = mysql_fetch_assoc(mysql_query($sql,$bd_inavi));
		return $consulta_total['saldo'];		
	}
	
	function calcular_oenr($bd_inavi,$contrato){	//OBRA EJECUTADA NO RELACIONADA
		$ov=consultar_obra_verif($bd_inavi,$contrato);
		$brutos=sumar_montos_brutos($bd_inavi,$contrato);
		$ant = sumar_anticipos($bd_inavi,$contrato);
		return $ov-($brutos-$ant);
	}
	

	
	function consultar_valuaciones($bd_inavi,$contrato){
		$sql = "SELECT * FROM cuentavaluaciones, fianzacontrato, valuaciones WHERE cuentavaluaciones.fk_idfianzacontrato = 
		fianzacontrato.id_fianzacontrato AND fianzacontrato.fk_idcontrato = '$contrato' AND cuentavaluaciones.fk_idvaluaciones 
		= valuaciones.id_valuaciones ORDER BY fecha";
		return mysql_query($sql,$bd_inavi);	
	}
	
	function consultar_saldo_contr($bd_inavi,$contrato){
		$sql = "SELECT * FROM saldocontratista WHERE id_saldocontratista = 
				(SELECT id_saldocontratista FROM saldocontratista where fecha = 
				(SELECT MAX(fecha) FROM saldocontratista WHERE fk_idcontrato = '$contrato') AND fk_idcontrato = '$contrato')";

				
		 return mysql_fetch_assoc(mysql_query($sql, $bd_inavi));	
	}
	
	function consultar_saldo_instituto(&$cant,$bd_inavi,$contrato){
		$sql = "SELECT * FROM saldoinstitucion WHERE id_saldoinstitucion = 
				(SELECT id_saldoinstitucion FROM saldoinstitucion where fecha = 
				(SELECT MAX(fecha) FROM saldoinstitucion WHERE fk_idcontrato = '$contrato') AND fk_idcontrato = '$contrato')";

		
		$query = mysql_query($sql,$bd_inavi);
		$cant = mysql_num_rows($query);
		return mysql_fetch_assoc($query);	
		}
	
	function consultar_actas_contrato($bd_inavi,$contrato){
		$sql = "SELECT * FROM actas_contrato, actas WHERE fk_idcontrato = '$contrato' AND fk_id_actas = id_actas";
		return mysql_query($sql,$bd_inavi);		
	}
	
	function ver_disponible($bd_inavi,$login){
		$cons = mysql_query("SELECT * FROM usuario WHERE Usuario = '$login'", $bd_inavi);
		return mysql_num_rows($cons);
	}
	
	function validar_fk_empresa($bd_inavi,$rif){
		$sql = "SELECT * FROM contrato WHERE fk_idempresa = '$rif'";
		$cons = mysql_query($sql,$bd_inavi);
		return mysql_num_rows($cons);
	}
	
	function validar_fk_entidad($bd_inavi,$entidad){
		$sql = "SELECT * FROM contrato WHERE fk_identidad = '$entidad'";
		$cons = mysql_query($sql,$bd_inavi);
		return mysql_num_rows($cons);
	}	
	
/****************************************** FUNCIONES UPDATE *************************************/

	function cambiar_clave($bd_inavi,$usuario,$nueva){
		$sql = "UPDATE usuario SET Clave = '$nueva' WHERE Usuario = '$usuario'";
		//echo $sql;
		return (mysql_query($sql,$bd_inavi));
	}

		function modificar_contrato($bd_inavi,$num_contrato,$f_firma,$empresa,$entidad,$objeto,$monto,$limite,$inicio,$terminacion){
		$sql = "UPDATE contrato SET
				fecha = '$f_firma',  fk_idempresa = '$empresa', fk_identidad = '$entidad', objeto = '$objeto',
				monto_original = $monto, limite = '$limite', inicio = '$inicio', terminacion = '$terminacion'
				WHERE id_contrato = '$num_contrato'";
		return mysql_query($sql,$bd_inavi);
	}
	
	function modificar_actas_contrato($bd_inavi,$id_acta,$tipo_acta,$fecha,$descripcion,$fechad,$fechah){
		$sql = "UPDATE actas_contrato SET
				fk_id_actas = '$tipo_acta', fecha_actas = '$fecha', descripcion = '$descripcion', desde = '$fechad',
				hasta = '$fechah'  WHERE id_actas_contrato = '$id_acta'";
		return mysql_query($sql,$bd_inavi);
	}
	
	function modificar_fianza_contrato($bd_inavi,$id_fianza,$tipo_fianza,$emitida_por,$poliza,$monto){
		$sql = "UPDATE fianzacontrato SET
				fk_idfianza = '$tipo_fianza', emitida_por = '$emitida_por', numeropoliza = '$poliza', monto = $monto
				WHERE id_fianzacontrato = '$id_fianza'";
		return mysql_query($sql,$bd_inavi);
	}
	
	function modificar_valuacion_contrato($bd_inavi,$id_val,$valuacion,$fecha,$monto,$anticipoa){
		$sql = "UPDATE cuentavaluaciones SET
				fk_idvaluaciones = '$valuacion', fecha = '$fecha', monto_bruto = $monto, anticipo = $anticipoa
				WHERE id_cuentavaluaciones = '$id_val'";
		return mysql_query($sql,$bd_inavi);
	}
	
/****************************************** FUNCIONES DELETE *************************************/

	function eliminar_contrato($bd_inavi,$contrato){
		$sql = "DELETE FROM contrato WHERE id_contrato = '$contrato'";
		return mysql_query($sql,$bd_inavi);			
	}
	
	function eliminar_empresa($bd_inavi,$rif){
		$sql = "DELETE FROM empresa WHERE id_empresa = '$rif'";
		return mysql_query($sql,$bd_inavi);			
	}
	
	function eliminar_entidad($bd_inavi,$entidad){
		$sql = "DELETE FROM entidad WHERE id_entidad = '$entidad'";
		return mysql_query($sql,$bd_inavi);			
	}
		
	function modificar_empresa($bd_inavi,$empresa,$rif,$represent,$cedula){
		$sql = "UPDATE empresa SET nombre_e = '$empresa', representante = '$represent', ced_representant = '$cedula'
				WHERE id_empresa = '$rif'";
		return mysql_query($sql,$bd_inavi);
	}
	

	
	
function paginacion($page,$total_pages,$ruta,$contrato="",$empresa="",$fecha1="",$fecha2=""){
	if ($total_pages<=8){
		if ($page > 1) { //enlace anterior
			$url = $page - 1;
			echo "<a href='$ruta?page=$url&contrato=$contrato&empresa=$empresa&fecha_1=$fecha1&fecha_2=$fecha2'>Anterior</a>&nbsp;";
		} else 
			echo " ";
		for ($i = 1; $i <= $total_pages; $i++) {
			if ($i == $page)
				echo "<a>".$i."&nbsp;<a>";
			else { 
				echo "<a href='$ruta?page=".($i)."&contrato=$contrato&empresa=$empresa&fecha_1=$fecha1&fecha_2=$fecha2'>";
				echo $i."</a>&nbsp";
			}
		}
		if ($page < $total_pages) {
			$url = $page + 1;
			echo "<a href='$ruta?page=$url&contrato=$contrato&empresa=$empresa&fecha_1=$fecha1&fecha_2=$fecha2'>Siguiente</a>";
		} else
			echo " ";
		echo "</p>";
	}
	else {
		$min=$page; $max=$page; $cant=1;
		while ($cant<9) {
			if ($min>1){
				$min--; $cant++;
			}
			if ($max<$total_pages){
				$max++; $cant++;
			}
		}

		if ($page > 1) { //enlace anterior
			$url = $page - 1;
			echo "<a href='$ruta?page=$url&contrato=$contrato&empresa=$empresa&fecha_1=$fecha1&fecha_2=$fecha2'>Anterior</a>&nbsp;";
		} else 
			echo " ";
		for ($i = $min; $i <= $max; $i++) {
			if ($i == $page)
				echo "<a>".$i."&nbsp;<a>";
			else { 
				echo "<a href='$ruta?page=".($i)."&contrato=$contrato&empresa=$empresa&fecha_1=$fecha1&fecha_2=$fecha2'>";
				echo $i."</a>&nbsp";
			}
		}
		if ($page < $total_pages) {
			$url = $page + 1;
			echo "<a href='$ruta?page=$url&contrato=$contrato&empresa=$empresa&fecha_1=$fecha1&fecha_2=$fecha2'>Siguiente</a>";
		} else
			echo " ";
		echo "</p>";
	}
}
	
?>
