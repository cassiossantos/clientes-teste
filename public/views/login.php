
<?php

require_once("../../app/database.php");

session_start();

$alertas = '';

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $senha = $_POST['password'];

    $db = new Database;
    $query = $db->conn->query("SELECT * FROM clientes where email = '$email'");

    if ($query->rowCount() === 1) {
        $cliente_ = $query->fetch();
        $senha_ = $cliente_['senha'];
        if (password_verify($senha, $senha_)) {
            $_SESSION['cliente_id'] = $cliente_['id'];
            header('Location: home.php');

        } else {
            $alertas = "<div class='alert alert-info'>Cliente inválido. Tente novamente ou realize um cadastro <a href='../'>aqui</a>.</div>";

        }

    } else {
        $alertas = "<div class='alert alert-info'>Cliente inválido. Tente novamente ou realize um cadastro <a href='../'>aqui</a>.</div>";

    }





}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/main.css">
</head>
<body>

<div class="container">
    
    <div class="col-xs-12 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
        <div class="panel panel-default">
            
            <div  class="panel-body">
                
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="form-horizontal" role="form">
                        <div class="form-group">
                            <legend>Login: </legend>
                            <?= $alertas ?>
                       </div>
                     
                       <div class="form-group">
                            <input requirde name='email' type="email" class="form-control" placeholder='E-mail'>
                       </div>
                       <div class="form-group">
                            <input required name='password' type="password" class="form-control" placeholder='Senha'>
                       </div>
               
                       <div class="form-group">
                            <button name='login' type="submit" class="btn btn-primary">Entrar</button>
                            <a style='margin-left: 20px' href="../">Criar meu cadastro</a>
                        </div>
                      
               </form>
               
            </div>
        </div>
        
    </div>
    
</div>

    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</html>