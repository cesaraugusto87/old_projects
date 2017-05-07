function Menu(id_Div,nombre) {
	if(id_Div.className == nombre + "Oculto") { 
		id_Div.className = nombre + "Visible";
	} else {
		id_Div.className = nombre + "Oculto";
	}
}