<?php

//conectar com o banco de dados.
include ("conecta.php");

include ("protecao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela inicial do administrador</title>

</head>

<body>

<nav>
    <ul>
        <li><a href="perfil.php">Perfil</a></li>
        <li><a href="logout.php">Sair</a></li>
    </ul>
</nav>

<h1>Bem vindo!</h1>

<h2><?php echo $_SESSION['email']; ?></h2>

<p><a href="crudCurso/formcadcurso.html">Cadastrar curso</a></p>

<p><a href="crudCoordenador/formcadCoordenador.php">Cadastrar coordenador de curso</a></p>

<hr>

<?php

$sql = "SELECT * FROM curso ORDER BY nome_curso ASC";

$resultado = mysqli_query($mysql, $sql);

if ($mysql->error) {
    
    die("Falha ao listar" . $mysql->error);

}else {
    
    //Lista os itens
echo '<table border=4;">
<tr>
<th>Nome do curso</th>
<th>Carga horaria</th>

<th colspan=3>Opções</th>
</tr>';

while ($dados = mysqli_fetch_assoc($resultado)) {
    echo '<tr>';    
    echo '<td>'.$dados['nome_curso'].'</td>';
    echo '<td>'.$dados['carga_horaria'] .'</td>';

    echo '<td> <a href="crudCurso/formeditCurso.php?id='.$dados['id_curso'].'"> Alterar</a> </td>';
    
    echo '<td> <a href="crudCurso/excluirCurso?id='.$dados['id_curso'].'"> Excluir </a> </td>';
    
    echo '</tr>';
    }
    
    echo '</table> <br><br>';


}

echo '</table>';

$sql2 = "SELECT cc.id_coordenador, cc.nome_coordenador, cc.email, c.nome_curso FROM coordenador_curso cc

INNER JOIN curso c

ON cc.id_curso = c.id_curso

ORDER BY cc.nome_coordenador ASC

;";

$resultado2 = mysqli_query($mysql, $sql2);

if ($mysql->error) {
    
    die("Falha ao listar" . $mysql->error);

}else {
    
    //Lista os itens
echo '<table border=4;">
<tr>
<th>Nome do coordenador de curso</th>
<th>Email</th>
<th>Curso</th>

<th colspan=3>Opções</th>
</tr>';

while ($dados2 = mysqli_fetch_assoc($resultado2)) {
    echo '<tr>';    
    echo '<td>'.$dados2['nome_coordenador'].'</td>';
    echo '<td>'.$dados2['email'] .'</td>';
    echo '<td>'.$dados2['nome_curso'] .'</td>';

    echo '<td> <a href="crudCoordenador/formeditCoordenador.php?id='.$dados2['id_coordenador'].'"> Alterar</a> </td>';
    
    echo '<td> <a href="crudCoordenador/excluirCoordenador?id='.$dados2['id_coordenador'].'"> Excluir </a> </td>';
    
    echo '</tr>';
    }
    
    echo '</table> <br><br>';


}

echo '</table> <br><br>';


?>


</body>

</html>