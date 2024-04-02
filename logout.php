<?php
//PASO A PASO PARA CERRAR SESIÓN

//SESIÓN INICIADA
session_start();
//SESIÓN DESARMADA
session_unset();
//SESIÓN DESTRUIDA
session_destroy();
//REDIRECCION A PÁGINA PRINCIPAL SIN LOGEAR
header('Location: /php-login'); 

?>
