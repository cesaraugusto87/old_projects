								<div id="formAgregar">
									{mensajes}
									{errores}
									<form id="formAdd" enctype="multipart/form-data" method="post" action="{submitPage}">
										<fieldset>
											<br />
											<label>Enviar a:</label>
											{departamentos}
											<br />
											<label>Asunto:</label>
											<input type="text" name="Asunto"  class="inputText" />
											<br />
											<br />
											
											<label>Contenido:</label>
											<br />
											<textarea name="Contenido" cols="50" rows="10"></textarea> 
											<br />
											<br />
											<label>Adjuntar Archivo:</label>
											<input type="file" name="adjunto" />
											<br />
											<br />
											
											
											<input type="hidden" name="Estado" value="{Estado}" />
											<input type="hidden" name="accion" value="{accion}" />
											<input type="hidden" name="IdUsuario" value="{IdUsuario}" />
	
											<div class="holderSubmit">
											<input type="submit" name="registrar"  value="Registrar" />
											</div>
										</fieldset>
									</form>
								</div>