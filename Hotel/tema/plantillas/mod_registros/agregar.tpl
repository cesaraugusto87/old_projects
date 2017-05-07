								<div id="formAgregar">
									{mensajes}
									{errores}
									<form id="formAdd" enctype="multipart/form-data" method="post" action="{submitPage}">
										<fieldset>
										<label>Observaciones del Paciente:</label>
											<br />
											<textarea name="Diagnostico" cols="50" rows="10" value="{Diagnostico}"></textarea> 
											
										
											
											<input type="hidden" name="accion" value="{accion}" />
											<input type="hidden" name="IdPaciente" value="{IdPaciente}" />
	
											<div class="holderSubmit">
											<input type="submit" name="Registrar"  value="Agregar Observacion" />
											</div>
										</fieldset>
									</form>
								</div>