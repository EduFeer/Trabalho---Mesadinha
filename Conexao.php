<?php


class Conexao
{
    //para crar uma conexao com banco de dados eu preciso de 4 atributos -> servidor; banco; usuario; senha;
    //atributos tem visibilidade public; private
    private $servidor;
    private $banco;
    private $usuario;
    private $senha;

    //metodos -> function
    function __construct(){ //vai ser executado toda vez que instanciar a classe
        $this->servidor = "localhost"; //this faz referencia a classe
        $this->banco = "mesadinha";
        $this->usuario = "root";
        $this->senha = "";
    }

    //metodo para criar a conexão com mysql
    public function conectar() {
        try { //validar a execução do código
            //criar a conexão utilizando o PDO
            $con = new PDO("mysql:host={$this->servidor};dbname={$this->banco};charset=utf8;",$this->usuario,$this->senha);
            return $con;

        }catch (PDOException $msg) { //desenvolvendo mensagem de erro
            echo "Não foi possível conectar ao banco de dados {$msg->getMessage()}";
        }
    }
}