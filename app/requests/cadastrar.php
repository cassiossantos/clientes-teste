<?php
session_start();

require_once("../Clientes.php");

$token = $_POST['token_'];
if ($_SESSION['token'] !== $token) {
    header('Location: ../../public/');
} else {


    $nome = htmlentities(htmlspecialchars($_POST['nome']));
    $sobrenome = htmlentities(htmlspecialchars($_POST['sobrenome']));
    $email = htmlentities(htmlspecialchars($_POST['email']));
    $senha = password_hash($_POST['senha'], 1);

    $cliente = new Clientes($nome, $sobrenome, $email, $senha);
    if ($cliente->create()) {
        session_start();
        $_SESSION['cliente_id'] = $cliente->getId();
        $_SESSION['nome'] = $nome . " " . $sobrenome;
        $_SESSION['email'] = $email;

        header("Location: ../../public/views/home.php");
    }

}

?>