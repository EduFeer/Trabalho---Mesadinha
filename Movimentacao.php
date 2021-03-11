<?php

require_once "Conexao.php";

class Movimentacao
{
    //atributos
    public $id;
    public $valor;
    public $conta_id;

    //metodos (select insert delete update)
    public function listarTodos()
    {
        try {
            //instanciar classe conexao
            $bd = new Conexao();
            //criar o objeto contendo a conexao
            $con = $bd->conectar();
            //cria o comando sql para enviar ao banco
            $sql = $con->prepare("select * from movimentacao");
            //executar o comando
            $sql->execute();
            //testar se retornou valores
            if ($sql->rowCount() > 0) {
                //se tem resultado devolver valores ao html
                return $result = $sql->fetchAll(PDO::FETCH_CLASS);
                //fetchAll -> linhas / colunas
            }
        } catch (PDOException $msg) {
            echo "Não foi possível listar as movimentações. {$msg->getMessage()}";
        }
    }

    public function inserir(){
        try {
            //verificar se recebeu valores do formulário
            if(isset($_POST["movimentacao_valor"]) && isset($_POST["conta"])){
                $this->valor = $_POST["movimentacao_valor"];
                $this->conta_id = $_POST["conta"];
                //instanciar classe conexao
                $bd = new Conexao();
                //criar o objeto contendo a conexao
                $con = $bd->conectar();
                //cria o comando sql para enviar ao banco passando parametros
                $sql = $con->prepare("insert into movimentacao(id,valor,conta_id)
                values(null,?,?)");
                //executar o comando passando os valores recebidos do formulário
                $sql->execute(array(
                    $this->valor,
                    $this->conta_id
                ));
                //testar se retornou valor
                if ($sql->rowCount() > 0){
                    //se conseguiu gravar no banco de dados retornar para a página de lançamento de novo
                    header("location:gerenciarLancamentos.php");
                }
            }else{ //se o usuario nao preencheu os valores devolver para a página de lançamento
                header("location:gerenciarLancamentos.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível registrar a movimentação. {$msg->getMessage()}";
        }
    }

    public function excluir($id){
        try {
            if (isset($id)) {

                $this->id = $id;

                $bd = new Conexao();

                $con = $bd->conectar();

                $sql = $con->prepare("delete from movimentacao where id = ?");

                $sql->execute(array($this->id));

                if ($sql->rowCount() > 0) {

                    header("location:gerenciarLancamentos.php");
                }
            }else{

                header("location:gerenciarLancamentos.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível excluir a movimentação. ".$msg->getMessage();
        }
    }

    public function alterar(){
        try {

            if (isset($_POST["SalvarLancamento"])) {
                $this->id = $_GET["id"];
                $this->valor = $_POST["movimentacao_valor"];
                $this->conta_id = $_POST["conta"];

                $bd = new Conexao();

                $con = $bd->conectar();

                $sql = $con->prepare("update movimentacao set valor = ?,conta_id = ? where id = ?");

                $sql->execute(array(
                    $this->id,
                    $this->valor,
                    $this->conta_id
                ));
                if ($sql->rowCount() > 0) {
                    header("location:gerenciarLancamentos.php");
                }
            }else{
                header("location:gerenciarLancamentos.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível alterar a movimentação. ".$msg->getMessage();
        }
    }

    public function saldo(){
        try {

            if (isset($_POST["movimentacao_valor"]) && isset($_POST["conta"])) {
                $bd = new Conexao();

                $con = $bd->conectar();

                $sql = $con->prepare("select sum(valor) as Valor from movimentacao");

                $sql->execute();
                if ($sql->rowCount() > 0) {
                    header("location:gerenciarLancamentos.php");
                }
            }else{
                header("location:gerenciarLancamentos.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível alterar o saldo. ".$msg->getMessage();
        }
    }

    public function receita(){
        try {

            if (isset($_POST["movimentacao_valor"]) && isset($_POST["conta"])) {
                $bd = new Conexao();

                $con = $bd->conectar();

                $sql = $con->prepare("select sum(valor) as Valor from movimentacao join conta where conta.tipo = 'receita'");

                $sql->execute();
                if ($sql->rowCount() > 0) {
                    header("location:gerenciarLancamentos.php");
                }
            }else{
                header("location:gerenciarLancamentos.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível retornar a receita. ".$msg->getMessage();
        }
    }

    public function despesa(){
        try {

            if (isset($_POST["movimentacao_valor"]) && isset($_POST["conta"])) {
                $bd = new Conexao();

                $con = $bd->conectar();

                $sql = $con->prepare("select sum(valor) as Valor from movimentacao join conta where conta.tipo = 'despesa'");

                $sql->execute();
                if ($sql->rowCount() > 0) {
                    header("location:gerenciarLancamentos.php");
                }
            }else{
                header("location:gerenciarLancamentos.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível retornar a despesa. ".$msg->getMessage();
        }
    }
}