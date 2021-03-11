<?php

require_once "Conexao.php";

class Usuario
{
    //atributos
    public $id;
    public $nome;
    public $endereco;
    public $telefone;
    public $email;
    public $senha;

    //metodos (select insert delete update)
    public function login(){
        try {
            //testar se recebeu email e senha
            if (isset($_POST["login"]) && isset($_POST["senha"])){
                //preencher os atributos com os valores recebidos da tela
                $this->email = $_POST["login"];
                $this->senha = $_POST["senha"];
                //criar a instancia da classe conexao
                $bd = new Conexao();
                //criar a variavel para recebr a conexao
                $con = $bd->conectar();
                //criar o comando sql para ser executado no banco de dados
                $sql = $con->prepare("select * from usuario where email = ? and senha = ?");
                //executar o comando no banco de dados
                $sql->execute(array($this->email, $this->senha));
                //testar se o comando deu certo
                if($sql->rowCount() > 0){
                    //login funcionou coretamente usuário vai para a tela dashboard
                    header("location: dashboard.php");
                }else{ //email ou senha incorretos, devolver para tela de login
                    header("location: index.html");
                }
            }else{ //não recebeu valores devolver para tela de login
                header("location: index.html");
            }
        }catch (PDOException $msg){
            echo "Não foi possível fazer o login. {$msg->getMessage()}";
        }
    }

    public function inserir(){
        try {
            //verificar se recebeu valores do formulário
            if(isset($_POST["nome"]) && isset($_POST["endereco"]) && isset($_POST["Rtel"]) && isset($_POST["Rlogin"]) && isset($_POST["Rsenha"])){
                $this->nome = $_POST["nome"];
                $this->endereco = $_POST["endereco"];
                $this->telefone = $_POST["Rtel"];
                $this->email = $_POST["Rlogin"];
                $this->senha = $_POST["Rsenha"];
                //instanciar classe conexao
                $bd = new Conexao();
                //criar o objeto contendo a conexao
                $con = $bd->conectar();
                //cria o comando sql para enviar ao banco passando parametros
                $sql = $con->prepare("insert into usuario(id,nome,endereco,telefone,email,senha)
                                values(null,?,?,?,?,?)");
                //executar o comando passando os valores recebidos do formulário
                $sql->execute(array(
                    $this->nome,
                    $this->endereco,
                    $this->telefone,
                    $this->email,
                    $this->senha
                ));
                //var_dump($sql->errorInfo());
                //testar se retornou valor
                if ($sql->rowCount() > 0){
                    //se conseguiu gravar no banco de dados retornar para página de login
                    header("location:index.html");
                }else{
                    echo "O usuário não foi cadastrado.";
                }
            }else{ //se o usuario nao preencheu os valores devolver par o registro.html
                header("location:registro.html");
            }
        }catch (PDOException $msg){
            echo "Não foi possível registrar. {$msg->getMessage()}";
        }
    }
}