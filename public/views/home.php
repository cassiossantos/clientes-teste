
<?php

session_start();

require_once("../../app/database.php");

require_once("../auth/Login.php");


$login = new Login;

if (!empty($_SESSION['cliente_id'])) {
    $login->logarCliente($_SESSION['cliente_id']);
}

$login->logado() ? null : header("Location: ../");

$db = new Database;

$id = $_SESSION['cliente_id'];

$cliente_id = $_SESSION['cliente_id'];

$cliente = $db->conn->query("SELECT * FROM clientes where id = $id")->fetch();

$alertas = '';

if (isset($_POST['enviar'])) {
    if (!empty($_POST['divida'])) {
        $db = new Database;
        $s = $db->conn->prepare("INSERT INTO dividas(cliente_id, valor) values(:id, :valor)");
        $s->execute(array(
            "id" => $_SESSION['cliente_id'],
            "valor" => $_POST['divida'],
        ));
        $alertas = "<div class='alert alert-success'><a href='' class='close' aria-label='close'>&times;</a>Dívida adicionada com sucesso.</div>";


    } else {
        $alertas = "<div class='alert alert-info'><a href='' class='close' aria-label='close'>&times;</a>Por favor, preencha o campo dívida.</div>";
    }
}
// remover dívida

if (isset($_POST['remove_divida'])) {
    $divida_id = $_POST['divida'];
    $db = new Database;

    $db->conn->query("DELETE FROM dividas where id = $divida_id");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/home.css">
    <style>
        .panel-body{
            padding: 20px !important;
        }
       
    
    </style>
</head>
<body>
    
    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
        <div style='margin: 20px;' class='text-right'>
            <a  href="./logout.php">Sair</a>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
              <p><b>Nome: </b><?= $cliente['nome'] . " " . $cliente['sobrenome'] ?></p>
              <p><b>E-mail: </b><?= $cliente['email'] ?></p>
            </div>
        </div>

        <?= $alertas ?>

        <div class="panel panel-default">
              <div class="panel-body">

                  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                      <div class="form-group">        
                             <input name='divida'  list='divida' class="form-control" placeholder='R$ 1.000'>
                            <datalist id='divida'>
                                <option value="R$ 2.000">
                                <option value="R$ 5.000">
                                <option value="R$ 7.000">
                                <option value="R$ 10.000">
                                <option value="R$ 15.000">
                                <option value="R$ 20.000">
                            </datalist>   
                        </div>
                        <button name='enviar' class='btn btn-warning' type="submit">Adicionar dívida</button>         
                    </form> 
                </div>    
        </div>
        
            <h2>Minhas dívidas</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Valor</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $conn = new Database;

                empty($cliente_id) ? header('Location: ../') : null;

                $dividas = $conn->conn->query("SELECT * FROM dividas where cliente_id = $cliente_id order by criado_em desc");
                foreach ($dividas as $value) {
                    $valor = $value['valor'];
                    $data = $value['criado_em'];
                    $divida_id = $value['id'];
                    echo <<<edo
                    <tr>
                        <td>$valor</td>
                        <td>$data 
                        <form action='' method='POST'>
                            <input name='divida' type='hidden' value='$divida_id'>
                             <button name='remove_divida' class='pull-right btn btn-danger'>Já quitei</button>
                        </form>
                         
                         </td>
                    </tr>
edo;
                }
                ?>
                </tbody>
            </table>
        </div>
        

     
        
    </div>
    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function () {
        $('.close').click(function (e) { 
            e.preventDefault();
            $('.alert').fadeOut()
            
        });
    });



</script>
</html>