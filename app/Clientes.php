<?php

require_once("database.php");

class Clientes
{


    protected $nome;
    protected $sobrenome;
    protected $email;
    protected $password;
    protected $db;


    public function __construct($nome, $sobrenome, $email, $password)
    {
        $db = new Database;
        $this->db = $db;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->password = $password;

    }

    public function create()

    {
        $sttm = $this->db->conn->prepare("INSERT INTO clientes(nome, sobrenome, email, senha) values(:nome, :sobrenome, :email, :pwd)");
        return $sttm->execute(array(
            "nome" => $this->nome,
            "sobrenome" => $this->sobrenome,
            "email" => $this->email,
            "pwd" => $this->password

        ));
    }


    public function read($id)

    {
        $query = $this->db->conn->query("SELECT * from clientes where id = $id")->fetch();
        return $query;

    }
    public function update()
    {

    }
    public function delete()
    {

    }
    public function getId()

    {
        $query = $this->db->conn->query("SELECT id FROM clientes where email = '$this->email'");
        foreach ($query as $value) {
            return $value['id'];
        }

    }
}


?>