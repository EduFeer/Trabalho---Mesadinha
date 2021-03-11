<?php
header("Content-type: text/html; charset-utf8");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Início</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilo/home.css">
    <style type="text/css">

        body {
            width: 75%;
            margin: 0 auto;
            background-image: url('IMAGENS/site-background.jpg');
            background-attachment: fixed;
            background-size: 100%;
        }

    </style>
</head>
<body>
<!--HEADER-->
<div class="container">
    <img src="IMAGENS/home.jpg" alt="" width="60px" height="50px" class="home-icon">
    <li><a href="dashboard.php" class="home-link">Início</a> </li>
    <div class="dropdown">
        <button class="dropbtn">Usuário</button>
        <div class="dropdown-content">
            <a href="">Perfil</a>
            <a href="">Alterar Senha</a>
        </div>
    </div>
    <div class="dropdown2">
        <button class="dropbtn2">Gerenciar Cadastros</button>
        <div class="dropdown-content2">
            <a href="gerenciarCategorias.php">Categoria</a>
            <a href="gerenciarContas.php">Contas</a>
        </div>
    </div>
    <li><a href="gerenciarLancamentos.php" class="home-link">Lançamentos</a></li>
    <li><a href="index.html" class="home-link">Sair</a></li>
</div>
<!--CORPO-->
<article>
    <!--DADOS-->
    <div class="receita">
        <h2>Receitas</h2>
        <footer>
            <p>R$ 0.00</p>
        </footer>
    </div>


    <div class="despesa">
        <h2>Despesas</h2>
        <footer>
            <p>R$ 0.00</p>
        </footer>
    </div>


    <div class="saldo">
        <h2>Saldo</h2>
        <footer>
            <p>R$ 0.00</p>
        </footer>
    </div>

</article>

</body>
</html>
