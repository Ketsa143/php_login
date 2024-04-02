<?php 
//CONEXIÓN PÁGINA QUE CONECTA CON BASE DE DATOS
require 'database.php';

$message = '';

//CONDICIONAL PARA VERIFICAR QUE NINGUN CAMPO ESTE VACIO
if (!empty($_POST['nombreApellido']) && 
    !empty($_POST['celular']) && 
    !empty($_POST['email']) && 
    !empty($_POST['pswd']) && 
    !empty($_POST['pswd_confirm'])) {

    // VERIFICAR QUE LAS CONTRASEÑAS COINCIDAN
    if ($_POST['pswd'] === $_POST['pswd_confirm']) {

        //ENVIAR DATOS A BASE DE DATOS POR MEDIO DEL METODO POST
        $sql = "INSERT INTO users(nombreApellido, celular, email, pswd) VALUES (:nombreApellido, :celular, :email, :pswd)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombreApellido', $_POST['nombreApellido']);
        $stmt->bindParam(':celular', $_POST['celular']);
        $stmt->bindParam(':email', $_POST['email']);
        //INCRIPTAR LA CONTRASEÑA
        $pswd = password_hash($_POST['pswd'], PASSWORD_BCRYPT);
        $stmt->bindParam(':pswd', $pswd);

        //CONDICIONAL MESANJE DE REGISTRO EXITOSO
        if ($stmt->execute()) {
            $message = 'Usuario registrado exitosamente';
            //SI NO ENVIAR MENSAJE DE EEROR
        } else {
            $message = 'Ha ocurrido un error creando su usuario';
        }
        //SI LAS CONTRASEÑAS NO COINCIDEN
    } else {
        $message = 'Las contraseñas no son iguales';
    }
}
?>

<?php /* HTML*/ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de sesión</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<!-- Cabecera desde header.php-->

<?php require 'partials/header.php'?>

<!-- CONDICIONAL PARA MOSTRAR MENSAJE DE CARGA DE DATOS EN LA PÁGINA -->
<?php if(!empty($message)): ?>
<p><?= $message ?></p>
<?php endif; ?>


<!-- FORMULARIO REGISTRO -->

<h1>REGÍSTRATE</h1>
<span>o <a href="login.php">Iniciar sesión<a>


<form class="form" action="signup.php" method="post">

    <input class="input" type="text" name="nombreApellido" placeholder="Introduzca su nombre y apellido">
    <input class="input" type="text" name="celular" placeholder="Introduzca su número celular">
    <input class="input" type="email" name="email" placeholder="Introduzca su email">
    <input class="input"  type="password" name="pswd" placeholder="Introduzca su contraseña">
    <input class="input"  type="password" name="pswd_confirm" placeholder="Confirme su contraseña">
    <input class="sumit" type="submit" value="Enviar">

</form>

</body>
</html>