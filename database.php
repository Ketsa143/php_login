<?php 
$server = 'localhost';
$username = 'root';
$password = 'Chicuel03012!';
$database = 'php_login';

    try{
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);


    } catch(PDOException $e){
        die('Conexión fallida: '.$e->getMessage());
    }

?>