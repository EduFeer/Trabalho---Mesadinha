<?php
header("Content-type:text/html; charset=utf8;");
//importar a classe usuario
require_once "classes/Usuario.php";

require_once "classes/Conta.php";

require_once "classes/Categoria.php";

require_once "classes/Movimentacao.php";

//criar uma instancia da classe usuarios
$usuario = new Usuario();

$conta = new Conta();

$categoria = new Categoria();

$movimentacao = new Movimentacao();

//testar se clicou no botao entrar
if (isset($_POST["entrar"])){
    //chamar a funcao de login para selecionar o usuario do bd
    $usuario->login();
}

//testar se clicou no botao cadastrar
if (isset($_POST["cadastrar"])){
    //chamar a funcao de inserir para guardar o usuario no bd
    $usuario->inserir();
}

if (isset($_POST["SalvarConta"])){
    //chamar a funcao de inserir para guardar a conta no bd
    $conta->inserir();
}

if (isset($_POST["SalvarCategoria"])){
    //chamar a funcao de inserir para guardar a categoria no bd
    $categoria->inserir();
}

if (isset($_POST["SalvarLancamento"])){
    $movimentacao->saldo();
    $movimentacao->receita();
    $movimentacao->despesa();
    //chamar a funcao de inserir para guardar a movimentação no bd
    $movimentacao->inserir();
}
?>