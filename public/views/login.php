
<?php

require_once("../../app/database.php");


if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $db = new Database;

    $d = $db->conn->query("SELECT * FROM clientes where email = $email and senha = $pwd");

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