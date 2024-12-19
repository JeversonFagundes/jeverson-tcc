<?php

//INICIALADMIN.PHP

//conectar com o banco de dados jeverson-tcc.
require_once "conecta.php";

require_once "boasPraticas/notificacoes.php";

//declarar a veriável de conexão com o banco de dados jeverson-tcc. Esta veriavel vem do conecta.php.
$mysql = conectar();

//Buscar todos os cursos cadastrados no sistema e lista-los em ordem alfabética.
$sql = "SELECT * FROM curso ORDER BY nome_curso ASC";

//Atribuir a veriavel resultado ($resultado) o valor da excução do comando sql ($sql).
$resultado = excutarSQL($mysql, $sql);

//pegar a quantidade de cursos retornados.
$quantidade_cursos = $resultado->num_rows;

//Buscar todos os coordenadores de curso da tebela coordenador_curso, unindo a tebala coordenador_curso com a tabela curso para que seja possivél buscar todos os coordenador de curso com o seu respectivo curso.
$sql2 = "SELECT cc.id_coordenador, cc.nome, cc.email, c.nome_curso FROM coordenador_curso cc

        INNER JOIN curso c

        ON cc.id_curso = c.id_curso

        ORDER BY cc.nome ASC

        ;";

//Atribuir a resultado ($resultado2) o valor da execução do comando sql ($sql2).
$resultado2 = excutarSQL($mysql, $sql2);

//pegar a quantidade de coordenador de cursos retornados
$quantidade_coordenadores_curso = $resultado2->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css" media="screen,projection" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela inicial do administrador</title>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        main {
            flex: 1 0 auto;
        }

        .container {
            margin-top: 50px;
        }

        table {
            margin-top: 20px;
        }

        footer {
            background-color: #f5f5f5;
            padding: 10px 0;
            text-align: center;
            color: #757575;
        }

        .teste {
            justify-content: center;
            text-align: center;
        }
    </style>

</head>

<body>

    <!--conteudo principal-->
    <main>

        <!--incluir a navbar.-->
        <?php
        require_once "boasPraticas/headerNav.php";
        ?>

        <div class="container">

            <h2>Bem-vindo ao Sistema</h2>
            <hr>

        </div>

    </main>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>

</body>

</html>


<?php

//INICIALADMIN.PHP

//conectar com o banco de dados jeverson-tcc.
require_once "conecta.php";

require_once "boasPraticas/notificacoes.php";

//declarar a veriável de conexão com o banco de dados jeverson-tcc. Esta veriavel vem do conecta.php.
$mysql = conectar();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css" media="screen,projection" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela inicial do administrador</title>

</head>

<body>

    <!--Para que não seja necessário criar toda vez um header com uma nav em todas as telas dos usuários, então aqui incluimos a pasta onde esta o arquivo onde está criado o header e o nav.-->
    <?php require_once "boasPraticas/headerNav.php"; ?>
    <main>
        <h1>Bem vindo!</h1>

        <!--Sessão com o valor do email do administrador.-->
        <h2><?php echo $_SESSION['administrador'][0]; ?></h2>

        <p><a href="crudCurso/formcadcurso.html">Cadastrar curso</a></p>

        <p><a href="crudCoordenador/formcadCoordenador.php">Cadastrar coordenador de curso</a></p>

        <hr>

        <?php
        
        //exibir a mensagem de emtrega de atividade no sistema bem sucessedida.
        exibirNotificacoes();

        //limpar as notificações do sistema.
        limpaNotificacoes();

        //Buscar todos os cursos cadastrados no sistema e lista-los em ordem alfabética.
        $sql = "SELECT * FROM curso ORDER BY nome_curso ASC";

        //Atribuir a veriavel resultado ($resultado) o valor da excução do comando sql ($sql).
        $resultado = excutarSQL($mysql, $sql);

        //verificar se houve algum erro na excução do comando sql ($sql).
        if ($mysql->error) {

            die("Falha ao listar" . $mysql->error);
        } else {

            //Se não houve erro, listamos todos os cursos em uma tabela.
            echo '<table border=4;">
            <tr>
            <th>Nome do curso</th>
            <th>Carga horaria</th>

            <th colspan=3>Opções</th>
            </tr>';

            //Atribuir um array associativo com todos os resultados que vieram do banco de dados jeverson-tcc, tabela curso a veriavél dados f($dados).
            while ($dados = mysqli_fetch_assoc($resultado)) {
                echo '<tr>';
                echo '<td>' . $dados['nome_curso'] . '</td>';
                echo '<td>' . $dados['carga_horaria'] . '</td>';

                echo '<td> <a href="crudCurso/formeditCurso.php?id=' . $dados['id_curso'] . '"> Alterar</a> </td>';

                echo '<td> <a href="crudCurso/excluirCurso?id=' . $dados['id_curso'] . '"> Excluir </a> </td>';

                echo '</tr>';
            }

            echo '</table> <br><br>';
        }

        echo '</table>';

        //Buscar todos os coordenadores de curso da tebela coordenador_curso, inindo a tebala coordenador_curso com a tabela curso para que seja possivél buscar todos os coordenador de curso com o seu respectivo curso.
        $sql2 = "SELECT cc.id_coordenador, cc.nome, cc.email, c.nome_curso FROM coordenador_curso cc

        INNER JOIN curso c

        ON cc.id_curso = c.id_curso

        ORDER BY cc.nome ASC

        ;";

        //Atribuir a resultado ($resultado2) o valor da execução do comando sql ($sql2).
        $resultado2 = excutarSQL($mysql, $sql2);

        //Verificar se houve algum erro na hora de conectar com o banco de dados jeverson-tcc.
        if ($mysql->error) {

            die("Falha ao listar" . $mysql->error);
        } else {

            //Se deu certo, listamos todos os coordenador de curso com o seu respectivo curso dentro de uma tabela.
            echo '<table border=4;">
            <tr>
            <th>Nome do coordenador de curso</th>
            <th>Email</th>
            <th>Curso</th>

            <th colspan=3>Opções</th>
            </tr>';

            //Atribuir a variavél dados ($dados2) o array associativo com os valores que vieram do banco dados jeverson-tcc ($resultado2) que será repetido e imprimido na tela enquanto houver dados.
            while ($dados2 = mysqli_fetch_assoc($resultado2)) {
                echo '<tr>';
                echo '<td>' . $dados2['nome'] . '</td>';
                echo '<td>' . $dados2['email'] . '</td>';
                echo '<td>' . $dados2['nome_curso'] . '</td>';

                echo '<td> <a href="crudCoordenador/formeditCoordenador.php?id=' . $dados2['id_coordenador'] . '"> Alterar</a> </td>';

                echo '<td> <a href="crudCoordenador/excluirCoordenador?id=' . $dados2['id_coordenador'] . '"> Excluir </a> </td>';

                echo '</tr>';
            }

            echo '</table> <br><br>';
        }

        echo '</table> <br><br>';


        ?>

    </main>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
</body>

</html>

?>

        <!-- Navbar -->
        <nav>
            <div class="nav-wrapper blue"> <a href="#" data-target="mobile" class="sidenav-trigger"> <i class="material-icons" style="color: black;">menu</i> </a>
                <a href="#" class="brand-logo center">Meu App</a>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li><a <?php if ($paginaCorrente == 'inicialCoordenador.php') {
                                echo 'style="text-decoration: underline;"';
                            } ?> href="/jeverson-tcc/inicialCoordenador.php">Tela Inicial</a></li>
                    <li><a <?php if ($paginaCorrente == 'formcadAtividade.php') {
                                echo 'style="text-decoration: underline;"';
                            } ?> href="/jeverson-tcc/crudAtividade/formcadAtividade.php">Cadastrar Atividade Complementar de Curso</a></li>
                    <li><a <?php if ($paginaCorrente == 'perfilCoordenador.php') {
                                echo 'style="text-decoration: underline;"';
                            } ?> href="/jeverson-tcc/crudContaCo/perfilCoordenador.php">
                            Perfil</a></li>
                    <li><a href="/jeverson-tcc/logout.php">Sair</a></li>
                </ul>
            </div>
        </nav>

        <!-- Sidenav para Mobile -->
        <ul id="mobile" class="sidenav">
            <li><a href="/jeverson-tcc/inicialCoordenador.php"><i class="material-icons">home</i>Tela inicial</a></li>
            <li><a href="/jeverson-tcc/crudAtividade/formcadAtividade.php"><i class="material-icons">home</i>Cadastrar Atividade</a></li>
            <li><a href="/jeverson-tcc/crudContaCo/perfilCoordenador.php"><i class="material-icons">person_outline</i>Perfil</a></li>
            <li><a href="/jeverson-tcc/logout.php"><i class="material-icons">exit_to_app</i>Sair</a></li>

        </ul>

<?php