<?php

// Conectar ao BD
require_once "../conecta.php";

//variavel de conexão.
$mysql = conectar();

// receber os dados do formulário
$id = $_GET['id'];

//comando sql.
$sql = "DELETE FROM coordenador_curso WHERE id_coordenador = $id";

//excutar o comando sql acima.
excutarSQL($mysql, $sql);

header("location: ../inicialAdmin.php");
