<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Untitled Document</title>
	</head>
	<body>
		<div id="formSearch">
							<form name="buscar" method="post" action="{submitPageBuscar}">
								<fieldset>
									<legend>Buscar</legend>
									<label>Criterio</label>
									<input type="text" name="criterio" value="{criterio}" class="inputText" />
									<br />
									<br />
									<label>Buscar por: </label>
									<input type="checkbox" name="Nombre" {checked_nombre}  /> Nombre
									<input type="checkbox" name="Apellido" {checked_apellido} /> Apellido
									<input type="checkbox" name="Login" {checked_login} /> Login
									<br />
									<br />
									<label>Departamento</label>
									<select name="IdDepartamento">
											<option value="1" {seleccion_dep}>Departamento de susana</option>
											<option value="3" {seleccion_depp}>Departamento de susana leon</option>
											<option value="-1" {seleccion_deppp}>indiferente</option>
									</select>
									<br />
									<br />
									<label>Tipo</label>
									<select name="IdTipo">
											<option value="1"{seleccion_tipo}>Administrador</option>
											<option value="2"{seleccion_tipoo}>Usuario</option>
											<option value="-1"{seleccion_tipooo}>indiferente</option>
									</select>
									<br />
									<br />
									<input type="submit" name="buscar"  value="Buscar" />
								</fieldset>
								
							</form>
						</div>
		{resultados}
		
	</body>
</html>
