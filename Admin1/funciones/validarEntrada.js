<html>
   <head>
      <title>Validando...</title>
      <script language="JavaScript" type="text/JavaScript">
      
	  //Funcion que permite validar que los campos no esten vacios y posiciona en el campo requerido
      function validarlogin(formulario){ 
	     alert('Entro...');
		 formulario.nombreusuario.focus(); 
		 return false;
         //validacion del formulario 
         //Comprobación Del Campo Login
         if (formulario.ingresando.value == 'xxx'){
            if (formulario.nombreusuario.value == ''){ 
               // informamos del error 
               alert('No Ingreso Login Favor Intente de Nuevo...'); 
               // seleccionamos el campo incorrecto 
               formulario.nombreusuario.focus(); 
               return false; 
            } 
            //Comprobacion del Campo Password
            if(formulario.claveusuario.value == ''){ 
               // informamos del error 
               alert('Error con la Clave Intente de Nuevo...'); 
               // seleccionamos el campo incorrecto 
               formulario.claveusuario.focus(); 
               return false; 
            }
         }
         return true; 
      } 









	  function validaraspirante(formulario){ 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
  if(formulario.cedula_a.value == '')
  { 
// informamos del error 
    alert('Ingrese La Cedula'); 
// seleccionamos el campo incorrecto 
    formulario.cedula_a.focus(); 
    return false; 
  } 
  
// segunda comprobacion 
if(formulario.nombres_a.value == '')
  { 
// informamos del error 
    alert('Ingrese El nombre'); 
// seleccionamos el campo incorrecto
    formulario.nombres_a.focus(); 
    return false; 
  } 

// Tercera comprobacion 
   if(formulario.apellidos_a.value == '')
   { 
// informamos del error 
    alert('Ingrese El apellido'); 
// seleccionamos el campo incorrecto 
    formulario.apellidos_a.focus(); 
    return false; 
  }
  // cuarta comprobacion 
   if(formulario.fecha_nac_a.value == '')
   { 
// informamos del error 
    alert('Ingrese La fecha de nacimiento'); 
// seleccionamos el campo incorrecto 
    formulario.fecha_nac_a.focus(); 
    return false; 
  }
  // quinta comprobacion 
   if(formulario.edad_a.value == '')
   { 
// informamos del error 
    alert('Ingrese la edad'); 
// seleccionamos el campo incorrecto 
    formulario.edad_a.focus(); 
    return false; 
  }
  // Sexta comprobacion 
   if(formulario.sexo_a.value == '')
   { 
// informamos del error 
    alert('Indique sexo del aspirante'); 
// seleccionamos el campo incorrecto 
    formulario.sexo_a.focus(); 
    return false; 
  }
   //comprobacion 
   if(formulario.nacionalidad_a.value == '0')
   { 
// informamos del error 
    alert('Indique nacionalidad del aspirante'); 
// seleccionamos el campo incorrecto 
    formulario.nacionalidad_a.focus(); 
    return false; 
  }
   //comprobacion 
   if(formulario.estado_civil_a.value == '0')
   { 
// informamos del error 
    alert('Indique estado civil del aspirante'); 
// seleccionamos el campo incorrecto 
    formulario.estado_civil_a.focus(); 
    return false; 
  }
  //comprobacion 
   if(formulario.direccion_a.value == '')
   { 
// informamos del error 
    alert('Ingrese direccion '); 
// seleccionamos el campo incorrecto 
    formulario.direccion_a.focus(); 
    return false; 
  }
 //comprobacion 
   if(formulario.telefono1_a.value == '')
   {   
  // informamos del error 
    alert('Ingrese telefono de habitacion del aspirante'); 
// seleccionamos el campo incorrecto 
    formulario.telefono1_a.focus(); 
    return false; 
  }
 //comprobacion 
   if(formulario.telefono2_a.value == '')
   {   
  // informamos del error 
    alert('Ingrese telefono celular del aspirante'); 
// seleccionamos el campo incorrecto 
    formulario.fecha_inicio_e.focus(); 
    return false; 
  }  
   //comprobacion 
   if(formulario.correo_a.value == '')
   {   
  // informamos del error 
    alert('Ingrese direccion de correo'); 
// seleccionamos el campo incorrecto 
    formulario.correo_a.focus(); 
    return false; 
  } 
  }    
  return true; 

}

function validarcurso(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
 
// Tercera comprobacion 
   if(formulario.nombrecurso.value == '')
   { 
// informamos del error 
    alert('Ingrese El Nombre Del curso'); 
// seleccionamos el campo incorrecto 
    formulario.nombrecurso.focus(); 
    return false; 
  }
   }    
  return true; 

}

function validartitulo(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
 
// Tercera comprobacion 
   if(formulario.nombretitulo.value == '')
   { 
// informamos del error 
    alert('Ingrese El Nombre Del titulo'); 
// seleccionamos el campo incorrecto 
    formulario.nombretitulo.focus(); 
    return false; 
  }
   }    
  return true; 

}

function validarcargo(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
 
// Tercera comprobacion 
   if(formulario.nombrecargo.value == '')
   { 
// informamos del error 
    alert('Ingrese El Nombre Del cargo'); 
// seleccionamos el campo incorrecto 
    formulario.nombrecargo.focus(); 
    return false; 
  }
   }    
  return true; 

}

function validarespecialidad(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
 
// Tercera comprobacion 
   if(formulario.nombreespecialidad.value == '')
   { 
// informamos del error 
    alert('Ingrese El Nombre De la especializacion'); 
// seleccionamos el campo incorrecto 
    formulario.nombreespecialidad.focus(); 
    return false; 
  }
   }    
  return true; 

}

function validarinstituto(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
 
// Tercera comprobacion 
   if(formulario.nombreinstituto.value == '')
   { 
// informamos del error 
    alert('Ingrese El Nombre Del Instituto'); 
// seleccionamos el campo incorrecto 
    formulario.nombreinstituto.focus(); 
    return false; 
  }
   }    
  return true; 

}

function validarconocimiento(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
if(formulario.cedula_a.value == '')
  { 
// informamos del error 
    alert('Ingrese La Cedula'); 
// seleccionamos el campo incorrecto 
    formulario.cedula_a.focus(); 
    return false; 
  }  
// Tercera comprobacion 
   if(formulario.conocimiento.value == '')
   { 
// informamos del error 
    alert('Ingrese Conocimiento'); 
// seleccionamos el campo incorrecto 
    formulario.conocimiento.focus(); 
    return false; 
  }
   }    
  return true; 

}

//Funcion que permite validar que los campos no esten vacios y posiciona en el campo requerido
function validarempresa(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
  if (formulario.nombreempresa.value == '') 
  { 
// informamos del error 
    alert('Ingrese El Nombre De La Empresa'); 
// seleccionamos el campo incorrecto 
    formulario.nombreempresa.focus(); 
    return false; 
  } 
  
// segunda comprobacion 
if(formulario.direccionempresa.value == '')
  { 
// informamos del error 
    alert('Ingrese La Direccion De la empresa'); 
// seleccionamos el campo incorrecto
    formulario.direccionempresa.focus(); 
    return false; 
  } 

// Tercera comprobacion 
   if(formulario.tlfempresa.value == '')
   { 
// informamos del error 
    alert('Ingrese Numero telefonico empresa'); 
// seleccionamos el campo incorrecto 
    formulario.tlfempresa.focus(); 
    return false; 
  }
  }
  return true; 

} 
//Funcion que permite validar que los campos no esten vacios y posiciona en el campo requerido
function validarusuario(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
  if (formulario.nombreusuario.value == '') 
  { 
// informamos del error 
    alert('Ingrese El Nombre Del Usuario'); 
// seleccionamos el campo incorrecto 
    formulario.nombreusuario.focus(); 
    return false; 
  } 
  
// segunda comprobacion 
if(formulario.tipousuario.value == '0')
  { 
// informamos del error 
    alert('Ingrese El Tipo De usuario'); 
// seleccionamos el campo incorrecto
    formulario.tipousuario.focus(); 
    return false; 
  } 

// Tercera comprobacion 
   if(formulario.cedula.value == '')
   { 
// informamos del error 
    alert('Ingrese La Cedula Del Usuario'); 
// seleccionamos el campo incorrecto 
    formulario.cedula.focus(); 
    return false; 
  }
  }
  return true; 

} 
function validarcargo(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
  if (formulario.nombrecargo.value == '') 
  { 
// informamos del error 
    alert('Ingrese El Nombre Del Cargo'); 
// seleccionamos el campo incorrecto 
    formulario.nombrecargo.focus(); 
    return false; 
  } 
  
// segunda comprobacion 
if(formulario.funcionescargo.value == '')
  { 
// informamos del error 
    alert('Ingrese Las Funciones Del Cargo'); 
// seleccionamos el campo incorrecto
    formulario.funcionescargo.focus(); 
    return false; 
  } 
}
  return true; 

} 

function validarmision(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
  if (formulario.nombremision.value == '') 
  { 
// informamos del error 
    alert('Ingrese El Nombre De La Mision'); 
// seleccionamos el campo incorrecto 
    formulario.nombremision.focus(); 
    return false; 
  } 
  
// segunda comprobacion 
if(formulario.fechacreacion.value == '')
  { 
// informamos del error 
    alert('Ingrese La Fecha Creacion De La Mision'); 
// seleccionamos el campo incorrecto
    formulario.fechacreacion.focus(); 
    return false; 
  } 
  }
  return true; 

} 
 //Funcion que permite validar que los campos no esten vacios y posiciona en el campo requerido
function validarcursoxaspirante(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
  if (formulario.nombrecurso.value == '0')and(nombrecurso2== '') 
  { 
// informamos del error 
    alert('Ingrese El nombre del curso '); 
// seleccionamos el campo incorrecto 
    formulario.nombrecurso.focus(); 
    return false; 
  } 
    if (formulario.nombreinstituto.value == '0')and(nombreinstituto2== '') 
  { 
// informamos del error 
    alert('Indique el nombre del instituto '); 
// seleccionamos el campo incorrecto 
    formulario.nombreinstituto.focus(); 
    return false; 
  } 
// segunda comprobacion 
if(formulario.direccionempresa.value == '')
   { 
// informamos del error 
    alert('Ingrese la direccion de la empresa'); 
// seleccionamos el campo incorrecto 
    formulario.direccionempresa.focus(); 
    return false; 
  }

if(formulario.tlfempresa.value == '0')
  { 
// informamos del error 
    alert('Ingrese numero telefonico de la empresa'); 
// seleccionamos el campo incorrecto
    formulario.tlfempresa.focus(); 
    return false; 
  } 
  }
  return true; 
} 
//Funcion que permite validar que los campos no esten vacios y posiciona en el campo requerido
function validarcurso(formulario)
  { 
//validacion del formulario 
// primera comprobación 
if (formulario.ingresando.value == 'xxx'){
  if (formulario.nombrecurso.value == '') 
  { 
// informamos del error 
    alert('Ingrese El Nombre Del Curso'); 
// seleccionamos el campo incorrecto 
    formulario.nombrecurso.focus(); 
    return false; 
  } 
  
// segunda comprobacion 
if(formulario.fecha_inicio_c.value == '')
   { 
// informamos del error 
    alert('Ingrese La Fecha De Inicio Del Curso'); 
// seleccionamos el campo incorrecto 
    formulario.fecha_inicio_c.focus(); 
    return false; 
  }

if(formulario.fecha_finalizacion_c.value == '')
  { 
// informamos del error 
    alert('Ingrese fecha_finalizacion_c'); 
// seleccionamos el campo incorrecto
    formulario.fecha_finalizacion_c.focus(); 
    return false; 
  } 
  
   if(formulario.duracion_c.value == '')
  { 
// informamos del error 
    alert('Ingrese duracion_c'); 
// seleccionamos el campo incorrecto
    formulario.duracion_c.focus(); 
    return false; 
  } 
   if(formulario.lugar_c.value == '')
  { 
// informamos del error 
    alert('Ingrese lugar_c'); 
// seleccionamos el campo incorrecto
    formulario.lugar_c.focus(); 
    return false; 
  } 
  }
  return true; 

} 

//Funcion que permite validar que los campos no esten vacios y posiciona en el campo requerido
   function validarsede(formulario){ 
      //validacion del formulario 
      // primera comprobación 
      if (formulario.ingresando.value == 'xxx'){
         if (formulario.nombresede.value == ''){ 
            // informamos del error 
            alert('Ingrese nombre sede'); 
            // seleccionamos el campo incorrecto 
            formulario.nombresede.focus(); 
            return false; 
         } 
         // segunda comprobacion 
         if(formulario.direccionsede.value == ''){ 
            // informamos del error 
            alert('Ingrese direccion sede'); 
            // seleccionamos el campo incorrecto
            formulario.direccionsede.focus(); 
            return false; 
         } 
         // Tercera comprobacion 
         if(formulario.telefonosede.value == ''){ 
            // informamos del error 
            alert('Ingrese telefono sede'); 
            // seleccionamos el campo incorrecto 
            formulario.telefonosede.focus(); 
            return false; 
         }
      }
      return true; 
   } 
   </script> 
</head>
<body>
</body>
</html>
