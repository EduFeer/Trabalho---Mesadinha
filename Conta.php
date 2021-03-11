<?php

require_once "Conexao.php";

class Conta
{
    //atributos
    public $id;
    public $nome;
    public $tipo;
    public $categoria_id;

    //metodos (select insert delete update)
    public function listarTodos()
    {
        try {
            //instanciar classe conexao
            $bd = new Conexao();
            //criar o objeto contendo a conexao
            $con = $bd->conectar();
            //cria o comando sql para enviar ao banco
            $sql = $con->prepare("select * from conta");
            //executar o comando
            $sql->execute();
            //testar se retornou valores
            if ($sql->rowCount() > 0) {
                //se tem resultado devolver valores ao html
                return $result = $sql->fetchAll(PDO::FETCH_CLASS);
                //fetchAll -> linhas / colunas
            }
        } catch (PDOException $msg) {
            echo "Não foi possível listar as contas. {$msg->getMessage()}";
        }
    }

    public function inserir(){
        try {
            //verificar se recebeu valores do formulário
            if(isset($_POST["conta_nome"]) && isset($_POST["conta_tipo"]) && isset($_POST["categoria"])){
                $this->nome = $_POST["conta_nome"];
                $this->tipo = $_POST["conta_tipo"];
                $this->categoria_id = $_POST["categoria"];
                //instanciar classe conexao
                $bd = new Conexao();
                //criar o objeto contendo a conexao
                $con = $bd->conectar();
                //cria o comando sql para enviar ao banco passando parametros
                $sql = $con->prepare("insert into conta(id,nome,tipo,categoria_id)
                values(null,?,?,?)");
                //executar o comando passando os valores recebidos do formulário
                $sql->execute(array(
                    $this->nome,
                    $this->tipo,
                    $this->categoria_id
                ));
                //testar se retornou valor
                if ($sql->rowCount() > 0){
                    //se conseguiu gravar no banco de dados retornar para a página de contas de novo
                    header("location:gerenciarContas.php");
                }else{
                    echo "A conta não foi cadastrada.";
                }
            }else{ //se o usuario nao preencheu os valores devolver para a página de contas
                header("location:gerenciarContas.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível registrar a conta. {$msg->getMessage()}";
        }
    }

    public function excluir($id){
        try {
            if (isset($id)) {

                $this->id = $id;

                $bd = new Conexao();

                $con = $bd->conectar();

                $sql = $con->prepare("delete from conta where id = ?");

                $sql->execute(array($this->id));

                if ($sql->rowCount() > 0) {

                    header("location:gerenciarContas.php");
                }else{
                    echo "A conta não foi excluída.";
                }
            }else{

                header("location:gerenciarContas.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível excluir a conta. ".$msg->getMessage();
        }
    }

    public function alterar(){
        try {

            if (isset($_POST["SalvarConta"])) {
                $this->id = $_GET["id"];
                $this->nome = $_POST["conta_nome"];
                $this->tipo = $_POST["conta_tipo"];
                $this->categoria_id = $_POST["categoria"];

                $bd = new Conexao();

                $con = $bd->conectar();

                $sql = $con->prepare("update conta set nome = ?,tipo = ?,categoria_id = ? where id = ?");

                $sql->execute(array(
                    $this->id,
                    $this->nome,
                    $this->tipo,
                    $this->categoria_id
                ));
                if ($sql->rowCount() > 0) {
                    header("location:gerenciarContas.php");
                }else{
                    echo "A conta não foi alterada.";
                }
            }else{
                header("location:gerenciarContas.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível alterar a conta. ".$msg->getMessage();
        }
    }
}