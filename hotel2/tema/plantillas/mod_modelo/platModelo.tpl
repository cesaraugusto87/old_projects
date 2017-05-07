	<div id="formAgregar">
							{mensajes}
							{errores}
							<form id="formAdd" method="post" action="{submitPage}">
								<fieldset>
									
									<label>Nombre:</label>
									<input type="text" name="Nombre" value="{Nombre}" class="inputMedium" />
									<br />
									<br />
									<label>Apellido:</label>
									<input type="text" name="Apellido" value="{Apellido}" class="inputMedium" />
									<br />
									<br />
									<label>Login:</label>
									<input type="text" name="Login" value="{Login}" class="inputMedium" />
									<br />
									<br />
									<label>Departamento:</label>
									{departamentos}
									<br />
									<br />
									<label>Password:</label>
									<input type="password" name="Password" value="{Password}" class="inputMedium" />
									<br />
									<br />
									<label>Confirmar Password:</label>
									<input type="password" name="ConfirmPassword" value="{ConfirmPassword}" class="inputMedium" />
									<br />
									<br />
									<label>Email:</label>
									<input type="text" name="Email" value="{Email}" class="inputMedium" />
									<br />
									<br />
									<input type="hidden" name="accion" value="{accion}" />
									<input type="hidden" name="IdUsuario" value="{IdUsuario}" />
									<div class="holderSubmit">
										<input type="submit" name="registrar"  value="Registrar" />
									</div>
								</fieldset>
							</form>
						</div>