					<div id="formAtender">
							{mensajes}
							{errores}
							<form id="formAdd" enctype="multipart/form-data" method="post" action="{submitPage}">
								<fieldset>
									<label>Contenido:</label>
									<br />
									<textarea name="Contenido" cols="50" rows="10"></textarea> 
									<br />
									<br />
									<label>Adjuntar Archivo:</label>
									<input type="file" name="adjunto" />
									<br />
									<br />
									<label>Atender</label>
									<select name="estado">
										<option value="Atendido" {estado_atendido}>Atendido</option>
										<option value="Rechazado" {estado_rechazado}>Rechazado</option>
									</select>
									<br />
									<br />
									<input type="hidden" name="IdSolicitud" value="{IdSolicitud}" />
									<div class="holderSubmit">
										<input type="submit" name="atender"  value="Atender" />
									</div>
								</fieldset>
							</form>
						</div>