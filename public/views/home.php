
<?php

session_start();


require_once("../../app/database.php");

if (isset($_POST['enviar'])) {
    if (!empty($_POST['divida'])) {
        $db = new Database;
        $s = $db->conn->prepare("INSERT INTO dividas(cliente_id, valor) values(:id, :valor)");
        $s->execute(array(
            "id" => $_SESSION['cliente_id'],
            "valor" => $_POST['divida'],
        ));

    }
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
    <link rel="stylesheet" href="../src/css/main.css">
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
              <p><b>Nome: </b><?= $_SESSION['nome'] ?></p>
              <p><b>E-mail: </b><?= $_SESSION['email'] ?></p>
             
            </div>
        </div>

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
                $cliente_id = $_SESSION['cliente_id'];
                empty($cliente_id) ? header('Location: ../') : null;

                $dividas = $conn->conn->query("SELECT * FROM dividas where cliente_id = $cliente_id");

                foreach ($dividas as $value) {
                    $valor = $value['valor'];
                    $data = $value['criado_em'];
                    echo <<<edo

                    <tr>
                        <td>$valor</td>
                        <td>$data</td>
                    </tr>
edo;
                }
                ?>
                </tbody>
            </table>
        </div>
        

     
        
    </div>
    
</body>
</html>