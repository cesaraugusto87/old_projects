function init()
{

ruta_url = "../sisproginf/";
ruta_url2 = "../";

	//Menú Principal
	menus[0] = new menu(140, "vertical", 120, 163, 1, 1, "#fff", "#fff", "Verdana,Helvetica", 8, "", "", "#003366", "#000033", 1, "#999999", 2, "", false, true, true, true, 12, false, 4, 4, "black");
	menus[0].addItem("#", "", 20, "center", "&nbsp;¿Quiénes somos?", 1);
	menus[0].addItem("#", "", 20, "center", "&nbsp;Cursos", 2);
	menus[0].addItem(ruta_url+"proyectos/index2.html", "", 20, "center", "&nbsp;Galeria", 5);
	menus[0].addItem("http://localhost/sisproginf/Paginas/registrarse.php", "", 20, "center", "&nbsp;Registrarse", 0);
	menus[0].addItem(ruta_url+"premios/index.php", "", 20, "center", "&nbsp;Descargas", 0);
	menus[0].addItem(ruta_url+"premios/index.php", "", 20, "center", "&nbsp;Noticias", 0);
	menus[0].addItem("#", "", 20, "center", "&nbsp;Link", 4);
	
//Sub Menu for 2nd Main Menu Item ("web building"):
	menus[1] = new menu(135, "vertical", 0, 0, 0, 0, "#ffffff", "#ffffff", "Verdana,Helvetica", 8, "", "", "003366", "#000033", 1, "#999999", 2, "rollover:/include/menu_arrow_off_horz.png:/include/menu_arrow_on_horz.png", false, true, false, true, 6, true, 1, 1, "#999999");
	menus[1].addItem(ruta_url+"Paginas/Mision.php", "", 15, "left", "&nbsp;Mision", 0);
	menus[1].addItem(ruta_url+"Paginas/Vision.php", "", 15, "left", "&nbsp;Vision", 0);
    menus[1].addItem(ruta_url+"directorio/marco_legal.php", "", 15, "left", "&nbsp;Organigrama", 0);
	menus[1].addItem(ruta_url+"directorio/marco_legal.php", "", 15, "left", "&nbsp;Nuestro Equipo", 0);	

//Sub Menu for 3rd Main Menu Item ("News"):
	menus[2] = new menu(135, "vertical", 0, 0, -5, -5, "#ffffff", "#ffffff", "Verdana,Helvetica", 8, "", 
		"", "#003366", "#000033", 1, "#999999", 2, 62, false, true, false, true, 6, true, 1, 1, "#999999");
	menus[2].addItem(ruta_url+"gestion/2000/index.php", "", 15, "left", "&nbsp;Ofertas Cursos", 0);
	menus[2].addItem(ruta_url+"gestion/2000/index.php", "", 15, "left", "&nbsp;Reservar Cupos", 0);
	

//Sub Menu for Sub Menu "Sports News":
	menus[3] = new menu(135, "vertical", 1, 1, -5, -5, "#ffffff", "#ffffff", "Verdana,Helvetica", 8, "", "", "black", "#ff6600", 1, "#cccccc", 2, 62, false, true, false, true, 6, true, 1, 1, "#999999");
	menus[3].addItem(ruta_url+"directorio/gente.php?tipogente=1", "", 15, "left", "&nbsp;Consejo General", 0);
	menus[3].addItem(ruta_url+"directorio/gente.php?tipogente=2", "", 15, "left", "&nbsp;Junta Directiva", 0);
	menus[3].addItem(ruta_url+"directorio/gente.php?tipogente=3", "", 15, "left", "&nbsp;Personal", 0);
	
//Sub Menu for 4th Main Menu Item ("Search"):
	menus[4] = new menu(135, "vertical", 0, 0, 0, 0, "#fff", "#fff", "Verdana,Helvetica", 8, "", "", "#003366", "#000033", 1, "#999999", 2, ">>", false, true, false, false, 0, false, 4, 4, "black");
	
	menus[4].addItem("http://www.google.com", "", 15, "left", "Google", 0);
	menus[4].addItem("http://www.yahoo.com", "", 15, "left", "Yahoo", 0);
	menus[4].addItem("http://www.altavista.com", "", 15, "left", "Alta Vista", 0);
	
	menus[5] = new menu(135, "vertical", 0, 0, 0, 0, "#fff", "#fff", "Verdana,Helvetica", 8, "", "", "#003366", "#000033", 1, "#999999", 2, ">>", false, true, false, false, 0, false, 4, 4, "black");
	
	menus[5].addItem("http://www.google.com", "", 15, "left", "Google", 0);
	menus[5].addItem("http://www.yahoo.com", "", 15, "left", "Yahoo", 0);
	menus[5].addItem("http://www.altavista.com", "", 15, "left", "Alta Vista", 0);

} //OUTER CLOSING BRACKET. EVERYTHING ADDED MUST BE ABOVE THIS LINE.
