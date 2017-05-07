<html>
<head>
   <title>Validar entrada de datos</title>
   <script type="text/javascript">
   function validar(e) { // 1
      tecla = (document.all) ? e.keyCode : e.which; // 2
      if (tecla==8) 
	     return true; // 3
      patron =/[A-Z-Ña-z-ñ\s]/; // 4
      te = String.fromCharCode(tecla); // 5
      return patron.test(te); // 6
   } 
   </script>
   <script type="text/javascript">
      function verifMailSintaxis($email){
         if(!eregi("^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)+$", $email)){
            return TRUE;
         }else
            return FALSE;
      }
   </script>
</head>
   <body></body>
</html>
 

