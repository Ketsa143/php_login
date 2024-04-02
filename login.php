<?php 

session_start();

//SI YA ESTA INICIADA LA SESIÓN, NO PODER ENTRAR POR URL A LOGIN.PHP
if(isset($_SESSION['user_id'])){
    header('Location: /php-login');
}

require 'database.php';

//TRAER DESDE LA BASE DE DATOS LAS CREDENCIALES PARA COMPARARLAS CON LAS QUE EL USUARIO INGRESA

if (!empty($_POST['email']) && 
    !empty($_POST['pswd'])) {
    
        $records = $conn->prepare('SELECT id, email, pswd FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);


        $message = '';
        
        //SI TODO ESTA CORRECTO ENVIARLO A LA PÁGINA DE INICIO
        if(count($results) > 0 && password_verify($_POST['pswd'], $results['pswd'])){
            $_SESSION['user_id'] = $results['id'];
            header('Location: /php-login');
            //SI NO ENVIAR UN MENSAJE DE CREDENCIALES INCORRECTAS:
        } else {
            $message = 'Contraseña o correo no coinciden';
        }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<?php require 'partials/header.php'?>

<!-- CONDICIONAL PARA MOSTRAR MENSAJE DE COINCIDENCIA DE CREDENCIALES -->
<?php if(!empty($message)): ?>
<p><?= $message ?></p>
<?php endif; ?> 

        <!-- FORMULARIO INICIO DE SESIÓN-->

    <div class="container">

        <h1>INICIO DE SESIÓN</h1>
        <span>o <a href="signup.php">Regístrate<a>

<form class="form" action="login.php" method="post">
<input class="input" type="text" name="email" placeholder="Introduzca su email">
<input class="input"  type="password" name="pswd" placeholder="Introduzca su contraseña">
<input class="sumit" type="submit" value="Enviar">

</form>
    </div>
    
</body>
</html>