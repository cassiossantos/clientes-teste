<?php



class Database

{

    protected $db_host = 'localhost';
    protected $db_user = 'root';
    protected $db_name = 'revict-test';
    protected $db_password = '1422012';

    public $conn = null;

    public function __construct()
    {
        //cria um banco de dados e as tabelas caso ainda não existam

        try {
            $db = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);

            $db->query("
            CREATE TABLE IF NOT EXISTS `clientes`(
                `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
                `nome` VARCHAR(124) NOT NULL , 
                `sobrenome` VARCHAR(124) NOT NULL , 
                `email` VARCHAR(124) NOT NULL , 
                `senha` VARCHAR(124) NOT NULL  
            );
            CREATE TABLE IF NOT EXISTS `dividas`(
                `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
                `cliente_id` INT(6), 
                `valor` VARCHAR(160) NOT NULL , 
                `criado_em` TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) 
              )");

            $this->conn = $db;


        } catch (Exception $error) {
            die("Error: $error->getMessage");
        }

    }
}


?>
