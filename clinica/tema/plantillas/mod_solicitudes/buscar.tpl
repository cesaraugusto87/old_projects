				<div id="formSearch">
							<form name="buscar" method="post" action="{submitPageBuscar}">
								<fieldset>
									<label class="alignRight">N&uacute;mero de Solicitud:</label>
									<input type="text" name="solicitud" value="{solicitud}" class="inputMedium" />
									<input type="submit" name="buscarEsp"  value="Buscar" />
									
								</fieldset>
							</form>
				</div>
				<div id="formSearchGral">
							<form name="buscarGral" method="post" action="{submitPageBuscar}">
								<fieldset>
									
									<label class="twoColumns">Estado:</label>
									<select name="estado">
										<option value="Todos" {estado_todos}>Todos</option>
										<option value="Nuevo" {estado_nuevo}>Nuevo</option>
										<option value="Atendido" {estado_atendido}>Atendido</option>
										<option value="Rechazado" {estado_rechazado}>Rechazado</option>
									</select>
									<br />
									<br />
									<label>Rango de Fecha: </label>
									<br />
									<br />
									<label class="twoColumns">Inicio:</label>
									<input type="text" name="fecha_inicio" class="inputFecha" value="{fecha_inicio}" />
									<input type="button" value="Cal" class="btnCal" readonly="readonly" onclick="displayCalendar(document.forms['buscarGral'].fecha_inicio,'yyyy-mm-dd',this);" />
									<label class="twoColumns">Fin:</label> 
									<input type="text" name="fecha_fin" class="inputFecha" value="{fecha_fin}" />
									<input type="button" value="Cal" class="btnCal" readonly="readonly" onclick="displayCalendar(document.forms['buscarGral'].fecha_fin,'yyyy-mm-dd',this);" />
									<br />
									<input type="submit" name="buscar"  value="Buscar" />
									<input type="hidden" name="Imprimir" value="Imprimir" />
								</fieldset>
								
							</form>
				</div>
		