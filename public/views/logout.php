<?php

require_once("../auth/Login.php");

session_start();
session_unset();

$_SESSION['token'] = '';

session_destroy();

header("Location: ../")

?>