									{mensajes}
									{errores}
									<form id="formAdd" enctype="multipart/form-data" method="post" action="{submitPage}">
										
											
											<label>Cedula:</label>
											<br />
											<input type="text" name="Cedula" value="{cedula}">
											<br />
											<br />
											<label>Nombre:</label>
											<br />
											<input type="text" name="Nombre" value="{Nombre}">
							
											<label>Apellido:</label>
											<br />
											<input type="text" name="Apellido" value="{Apellido}">
											<br />
											<br />
											<label>Edad:</label>
											<br />
											<input type="text" name="Edad" value="{Edad}" size="3">
											
											
											<input type="hidden" name="accion" value="{accion}" />
											<input type="hidden" name="IdPaciente" value="{IdPaciente}" />
	
											<div class="holderSubmit">
											<input type="submit" name="preparar"  value="Registrar" />
											</div>
										</fieldset>
									</form>
								</div>