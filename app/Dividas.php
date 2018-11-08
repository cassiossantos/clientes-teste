<?php

include_once("./database.php");

class Dividas extends Database
{

    public function create($id, $valor)
    {
        $db = new Database;
        $s = $db->conn->prepare("INSERT INTO dividas(cliente_id, valor) values(:id, >valor)");
        $s->execute(array(
            "id" => $id,
            "valor" => $valor
        ));

    }
    public function read()
    {

    }
    public function update()
    {

    }
    public function delete()
    {

    }
}



?>