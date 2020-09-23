<?php

include('config.php');
session_start();

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
//    var_dump($result['password']); die();
    if (!$result) {
        echo '<p class="error">Email o password incorrectos!</p>';
    } else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['id'];
            echo '<p class="success">Estás logueado!</p>';
            header("Location: /php-proyects/formulario-gana-energia/welcome.php");
        } else {
            echo '<p class="error">Email o password incorrectos!</p>';
        }
    }
}
