<?php
header("Content-type: text/html; charset-utf8");

require_once "classes/Movimentacao.php";

require_once "classes/Conta.php";

$movimentacoes = new Movimentacao();

$contas = new Conta();

$listaContas = $contas->listarTodos();

$listaMovimentacoes = $movimentacoes->listarTodos();

$saldo = $movimentacoes->saldo();
$receita = $movimentacoes->receita();
$despesa = $movimentacoes->despesa();


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lançamentos</title>
    <link rel="stylesheet" type="text/css" href="estilo/lancamentos.css">
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
<article class="contas">
    <!--DADOS-->
    <div class="contas_div">
        <h2 class="contas_div_h2">Receitas</h2>
        <footer>
            <p class="contas_div_p contas_receita_p">R$ <?php echo $receita; ?></p>
        </footer>
    </div>


    <div class="contas_div">
        <h2 class="contas_div_h2">Despesas</h2>
        <footer>
            <p class="contas_div_p contas_despesa_p">R$ <?php echo $despesa; ?></p>
        </footer>
    </div>


    <div class="contas_div">
        <h2 class="contas_div_h2">Saldo</h2>
        <footer>
            <p class="contas_div_p">R$ <?php echo $saldo; ?></p>
        </footer>
    </div>
</article>
<article>
    <!--FORMULARIO-->
    <form action="metodos.php" method="post">
        <h2>Gerencie seus Lançamentos</h2>
        <div class="form-group">
            <label for="conta">Conta</label>
            <select name="conta" id="conta" class="form-control" required>
                <option value="">Selecione uma conta</option>
                <?php foreach ($listaContas as $conta) { ?>
                    <option value="<?php echo $conta->id; ?>"><?php echo $conta->nome; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <input type="text" name="movimentacao_valor" class="form-control" required placeholder="Valor" autocomplete="off">
        </div>
        <div>
            <button type="submit" name="SalvarLancamento">Salvar</button>
        </div>
    </form>
    <!--LISTA-->
    <div>
        <table>
            <thead>
            <tr>
                <th>Conta</th>
                <th>Valor</th>
                <th></th> <!--coluna vazia para os botões editar excluir-->
            </tr>
            </thead>
            <tbody>
            <!--importar dados ta tabela movimentacao-->
            <?php if ($listaMovimentacoes) :
                foreach ($listaMovimentacoes as $movimentacao) : ?>
                    <tr>
                        <td><?php echo $conta->nome; ?></td>
                        <td><?php echo $movimentacao->valor; ?></td>
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