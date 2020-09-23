<?php

include('config.php');
session_start();

if (isset($_POST['registrar'])) {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $cod_postal = $_POST['cod_postal'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo '<p class="error">El email que intenta registrar ya está en uso!</p>';
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://webservicetest.gaolania.com.es/ine.json/id/" . $cod_postal);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    $items  = json_decode($res);


    curl_close($ch);


        $query = $connection->prepare("INSERT INTO users(NOMBRE, APELLIDOS, DIRECCION, EMAIL, COD_POSTAL, PASSWORD) VALUES (:nombre, :apellidos, :direccion, :email, :cod_postal, :password_hash)");
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
        $query->bindParam("direccion", $direccion, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("cod_postal", $cod_postal, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);

        $result = $query->execute();

        if ($result) {
            echo '<p class="success">Te has registrado correctamente!</p>';
            header("Location: /php-proyects/formulario-gana-energia/logged.php");

        } else {
            echo '<p class="error">Algo salió mal!</p>';
        }

}
