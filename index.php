<?php
session_start();

require 'database.php';

if(isset($_SESSION['user_id'])){
    $records = $conn->prepare('SELECT id, nombreApellido, email, pswd FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);


    $user = null;

    if(count($results)> 0) {
        $user = $results;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">

</head>
<body>

    <?php require 'partials/header.php'?>

    <?php if(!empty($user)):?>
    <br>¡BIENVENIDO! <?= $user['nombreApellido'] ?>
    <br>Ingresaste satisfactoriamente
    <a href="logout.php">CERRAR SESIÓN</a>
    <?php else:?>
    <h1>Por favor registrase o iniciar sesión</h1>

    <a href="login.php">Inicio de sesión<a> o 
    <a href="signup.php">Registro<a>
    <?php endif; ?>

    
</body>
</html>