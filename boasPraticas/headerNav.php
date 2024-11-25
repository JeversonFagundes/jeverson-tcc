<?php
$paginaCorrente = basename($_SERVER['SCRIPT_NAME']);
// Obtém o nome do arquivo atual e o armazena na variável $paginaCorrente.
// basename() retorna o nome do arquivo a partir de um caminho completo, e $_SERVER['SCRIPT_NAME'] fornece o caminho do script sendo executado.

if (isset($_SESSION['aluno'])) {

?>

    <div class="navbar-fixed">
        <nav class="white lighten-3">
            <div class="nav-wrapper container"> <a href="#" data-target="mobile" class="sidenav-trigger"> <i class="material-icons" style="color: black;">menu</i> </a>
                <ul class="right hide-on-med-and-down">
                    <li> <a class="black-text" <?php if ($paginaCorrente == 'inicialAluno.php') {
                                                    echo 'style="text-decoration: underline;"';
                                                } ?> href="/jeverson-tcc/inicialAluno.php"> Tela inicial </a> </li>
                    <li> <a class="black-text" <?php if ($paginaCorrente == 'formcadEntrega.php') {
                                                    echo 'style="text-decoration: underline;"';
                                                } ?> href="/jeverson-tcc/crudEntrega/formcadEntrega.php">Entregar atividade</a> </li>
                    <li> <a class="black-text" <?php if ($paginaCorrente == 'perfilAluno.php') {
                                                    echo 'style="text-decoration: underline;"';
                                                } ?> href="/jeverson-tcc/crudAluno/perfilAluno.php"> Perfil </a> </li>
                    <li> <a class="black-text" href="/jeverson-tcc/logout.php"> Sair </a> </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Sidenav para Mobile -->
    <ul id="mobile" class="sidenav">
        <li><a href="/jeverson-tcc/inicialAluno.php"><i class="material-icons">home</i>Tela inicial</a></li>
        <li><a href="/jeverson-tcc/crudEntrega/formcadEntrega.php"><i class="material-icons">home</i>Entregar atividade</a></li>
        <li><a href="/jeverson-tcc/crudAluno/perfilAluno.php"><i class="material-icons">person_outline</i>Perfil</a></li>
        <li><a href="/jeverson-tcc/logout.php"><i class="material-icons">exit_to_app</i>Sair</a></li>

    </ul>

    <?php
} else {

    if (isset($_SESSION['coordenador'])) {

    ?>

        <div class="navbar-fixed">
            <nav class="white lighten-3">
                <div class="nav-wrapper container"> <a href="#" data-target="mobile" class="sidenav-trigger"> <i class="material-icons" style="color: black;">menu</i> </a>
                    <ul class="right hide-on-med-and-down">
                        <li> <a class="black-text" <?php if ($paginaCorrente == 'inicialCoordenador.php') {
                                                        echo 'style="text-decoration: underline;"';
                                                    } ?> href="/jeverson-tcc/inicialCoordenador.php"> Tela inicial </a> </li>
                        <li> <a class="black-text" <?php if ($paginaCorrente == 'formcadAtividade.php') {
                                                        echo 'style="text-decoration: underline;"';
                                                    } ?> href="/jeverson-tcc/crudAtividade/formcadAtividade.php">Entregar atividade</a> </li>
                        <li> <a class="black-text" <?php if ($paginaCorrente == 'perfilCoordenador.php') {
                                                        echo 'style="text-decoration: underline;"';
                                                    } ?> href="/jeverson-tcc/crudContaCo/perfilCoordenador.php"> Perfil </a> </li>
                        <li> <a class="black-text" href="/jeverson-tcc/logout.php"> Sair </a> </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Sidenav para Mobile -->
        <ul id="mobile" class="sidenav">
            <li><a href="/jeverson-tcc/inicialCoordenador.php"><i class="material-icons">home</i>Tela inicial</a></li>
            <li><a href="/jeverson-tcc/crudAtividade/formcadAtividade.php"><i class="material-icons">home</i>Cadastrar atividade</a></li>
            <li><a href="/jeverson-tcc/crudContaCo/perfilCoordenador.php"><i class="material-icons">person_outline</i>Perfil</a></li>
            <li><a href="/jeverson-tcc/logout.php"><i class="material-icons">exit_to_app</i>Sair</a></li>

        </ul>

<?php
    }
}
?>