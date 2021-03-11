<?php
header("Content-type: text/html; charset-utf8");

require_once "classes/Categoria.php";

$categorias = new Categoria();

$listaCategorias = $categorias->listarTodos();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Categorias</title>
    <link rel="stylesheet" type="text/css" href="estilo/cc.css">
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
    <!--FORMULARIO-->
    <form action="metodos.php" method="post">
        <h2>Adicione uma categoria</h2>
        <div class="form-group">
            <input type="text" name="categoria_nome" class="form-control" required placeholder="Nome" autocomplete="off">
        </div>
        <div>
            <button type="submit" name="SalvarCategoria">Salvar</button>
        </div>
    </form>
<!--LISTA-->
<div>
    <table>
        <thead>
        <tr>
            <th>Nome</th>
            <th></th> <!--coluna vazia para os botões editar excluir-->
        </tr>
        </thead>
        <tbody>
        <!--importar dados ta tabela categoria-->
        <?php if ($listaCategorias) :
            foreach ($listaCategorias as $categoria) : ?>
                <tr>
                    <td><?php echo $categoria->nome; ?></td>
                    <td>
                        <button>Editar</button>
                        <button>Excluir</button>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php else : ?>
            <tr>
                <td>Nenhuma categoria cadastrada</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</article>
</body>
</html>
