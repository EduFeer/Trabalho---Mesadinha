<?php

require_once "Conexao.php";

class Categoria
{
    //atributos
    public $id;
    public $nome;

    //metodos (select insert delete update)
    public function listarTodos()
    {
        try {
            //instanciar classe conexao
            $bd = new Conexao();
            //criar o objeto contendo a conexao
            $con = $bd->conectar();
            //cria o comando sql para enviar ao banco
            $sql = $con->prepare("select * from categoria");
            //executar o comando
            $sql->execute();
            //testar se retornou valores
            if ($sql->rowCount() > 0) {
                //se tem resultado devolver valores ao html
                return $result = $sql->fetchAll(PDO::FETCH_CLASS);
                //fetchAll -> linhas / colunas
            }
        } catch (PDOException $msg) {
            echo "Não foi possível listar as categorias. {$msg->getMessage()}";
        }
    }

    public function inserir(){
        try {
            //verificar se recebeu valores do formulário
            if(isset($_POST["categoria_nome"])){
                $this->nome = $_POST["categoria_nome"];
                //instanciar classe conexao
                $bd = new Conexao();
                //criar o objeto contendo a conexao
                $con = $bd->conectar();
                //cria o comando sql para enviar ao banco passando parametros
                $sql = $con->prepare("insert into categoria(id,nome)
                                values(null,?)");
                //executar o comando passando os valores recebidos do formulário
                $sql->execute(array(
                    $this->nome
                ));
                //var_dump($sql->errorInfo());
                //testar se retornou valor
                if ($sql->rowCount() > 0){
                    //se conseguiu gravar no banco de dados retornar para a página de categoria de novo
                    header("location:gerenciarCategorias.php");
                }else{
                    echo "A categoria não foi cadastrada.";
                }
            }else{ //se o usuario nao preencheu os valores devolver para a página de categoria
                header("location:gerenciarCategorias.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível registrar a categoria. {$msg->getMessage()}";
        }
    }

    public function excluir($id){
        try {
            if (isset($id)) {

                $this->id = $id;

                $bd = new Conexao();

                $con = $bd->conectar();

                $sql = $con->prepare("delete from categoria where id = ?");

                $sql->execute(array($this->id));

                if ($sql->rowCount() > 0) {

                    header("location:gerenciarCategorias.php");
                }else{
                    echo "A categoria não foi excluída.";
                }
            }else{

                header("location:gerenciarCategorias.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível excluir a categoria. ".$msg->getMessage();
        }
    }

    public function alterar(){
        try {

            if (isset($_POST["SalvarCategoria"])) {
                $this->id = $_GET["id"];
                $this->nome = $_POST["categoria_nome"];

                $bd = new Conexao();

                $con = $bd->conectar();

                $sql = $con->prepare("update categoria set nome = ? where id = ?");

                $sql->execute(array(
                    $this->id,
                    $this->nome
                ));
                if ($sql->rowCount() > 0) {
                    header("location:gerenciarCategoria.php");
                }else{
                    echo "A categoria não foi alterada.";
                }
            }else{
                header("location:gerenciarCcategoria.php");
            }
        }catch (PDOException $msg){
            echo "Não foi possível alterar a categoria. ".$msg->getMessage();
        }
    }
}