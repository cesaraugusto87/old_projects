					<div id="formSearch">
							<form name="buscar" method="post" action="{submitPageBuscar}">
								<fieldset>
									<label>Criterio</label>
									<input type="text" name="criterio" value="{criterio}" class="inputMedium" />
									<br />
									<br />
									<label>Buscar por: </label>
									<input type="checkbox" name="Nombre" {checked_nombre} /> Nombre
									<input type="checkbox" name="Apellido" {checked_apellido} /> Apellido
									<input type="checkbox" name="Login" {checked_login} /> Login
									<br />
									<br />
									<label>Departamento</label>
									{departamentos}
									<br />
									<br />
									<label>Tipo</label>
									{tiposUsuario}
									<br />
									<br />
									<div class="holderSubmit">
										<input type="submit" name="buscar"  value="Buscar" />
									</div>
								</fieldset>
								
							</form>
						</div>