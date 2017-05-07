<?php
session_start();
session_destroy();
header("Location: login.php");
/* Asegúrese de que el código que aparece a continuación no se ejecutará cuando redireccionamos.*/
exit;

?>