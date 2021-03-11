<?php
require_once "Conexao.php";

$bd = new Conexao();
$con = $bd->conectar();

var_dump($con);