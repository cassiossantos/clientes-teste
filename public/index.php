<?php

session_start();

$token = md5("12345" . rand(1, 100));

$_SESSION['token'] = $token;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/main.css">
</head>
<body>

<div class="container">
    
    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
        
        <div class="panel panel-default">
           
            <div  class="panel-body">
               
               <form action="../app/requests/cadastrar.php" method="POST" class="form-horizontal" role="form">
                        <input value='<?= $token ?>' type="hidden" name="token_">
                       <div class="form-group"> 
                            <legend>Cadastro: </legend>
                       </div>
                       <div class="form-group">
                            <input  required name='nome' type="text" class="form-control" placeholder='Nome'>
                       </div>
                       <div class="form-group">
                            <input required name='sobrenome'type="text" class="form-control" placeholder='Sobrenome'>
                       </div>
                       <div class="form-group">
                            <input required name='email' type="email" class="form-control" placeholder='E-mail'>
                       </div>
                       <div class="form-group">
                            <input required name='senha' type="password" class="form-control" placeholder='Senha'>
                       </div>
               
                       <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                            <a style='margin-left: 20px' href="./views/login.php">Já sou um cliente</a>
                        </div>
                      
               </form>
               
            </div>
        </div>
        
    </div>
    
</div>

    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</html>