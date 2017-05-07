<div id="formAgregar">
							{mensajes}
							{errores}
							<form name="" method="post" action="">
								<fieldset>
									<label>Departamento ({accion}):</label>
									<input type="text" name="Nombre" value="{Nombre}"/>
									<br />
									<br />
									
									<input type="hidden" name="accion" value="{accion}" />
									<input type="hidden" name="IdDepartamento" value="{IdDepartamento}" />	
									<input type="submit" name="registrar"  value="Registrar" />
								</fieldset>
							</form>
						</div>