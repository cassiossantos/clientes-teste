<?php

require_once('../../app/database.php');

class Login
{

    protected $autorizado = false;


    protected $id;
    protected $nome;
    protected $sobrenome;
    protected $email;



    public function logarCliente($id)
    {

        $this->id = $id;
        $this->autorizado = true;

    }
    public function logado()

    {
        return $this->autorizado;
    }

}



?>