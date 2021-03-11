<?php
header("Content-type: text/html; charset-utf8");
//importar a classe conta
require_once "classes/Conta.php";
//importar a classe categoria para carregar a chave estrangeira
require_once "classes/Categoria.php";

//criar uma instancia da classe conta
$contas = new Conta();

//criar uma instancia da classe categoria
$categorias = new Categoria();

//criar uma variável para reber a lista de contas
$listaContas = $contas->listarTodos();

//criar uma variável para reber a lista de categoria
$listaCategorias = $categorias->listarTodos();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Contas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo/contas.css">
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
        <h2>Gerencie seus Lançamentos</h2>
        <div class="form-group">
            <input type="text" name="conta_nome" class="form-control" required placeholder="Nome" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select name="conta_tipo" id="tipo" class="form-control">
                <option value="">Selecione um tipo</option>
                <option value="despesa">Despesa</option>
                <option value="receita">Receita</option>
            </select>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="form-control" required>
                <option value="">Selecione uma categoria</option>
                <?php foreach ($listaCategorias as $categoria) { ?>
                    <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nome; ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <button type="submit" name="SalvarConta">Salvar</button>
        </div>
    </form>
<!--LISTA-->
<div>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Categoria</th>
                <th></th> <!--coluna vazia para os botões editar excluir-->
            </tr>
        </thead>
        <tbody>
            <!--importar dados ta tabela conta-->
            <?php if ($listaContas) :
                foreach ($listaContas as $conta) : ?>
                    <tr>
                        <td><?php echo $conta->nome; ?></td>
                        <td><?php echo $conta->tipo; ?></td>
                        <td><?php echo $categoria->nome; ?></td>
                        <td>
                            <button>Editar</button>
                            <button>Excluir</button>
                        </td>
                    </tr>
                <?php endforeach;?>
                <?php else : ?>
                    <tr>
                        <td>Nenhuma conta cadastrada</td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table>
</div>
</article>
</body>
</html>