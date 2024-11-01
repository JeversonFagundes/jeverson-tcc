<?php
$paginaCorrente = basename($_SERVER['SCRIPT_NAME']);
// Obtém o nome do arquivo atual e o armazena na variável $paginaCorrente.
// basename() retorna o nome do arquivo a partir de um caminho completo, e $_SERVER['SCRIPT_NAME'] fornece o caminho do script sendo executado.


if (isset($_SESSION['aluno'])) {

?>

    <div class="navbar-fixed">
        <!-- Cria um contêiner fixo para a barra de navegação. -->
        <nav class="brown  lighten-3">
            <!-- Define a barra de navegação com uma cor marrom clara. -->
            <div class="nav-wrapper container">
                <!-- Cria um contêiner para o conteúdo da navegação. -->
                <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <!-- Cria um ícone de menu para a navegação móvel. -->

                <ul class="right hide-on-med-and-down">
                    <!-- Cria uma lista de navegação que é ocultada em dispositivos médios e pequenos. -->

                    <li <?php if ($paginaCorrente == 'inicialAluno.php') {
                            echo 'class="active"';
                        } ?>>
                        <!-- Verifica se a página atual é inicialAluno.php e, se for, adiciona a classe "active" ao item da lista. -->
                        <a class="black-text" <?php if ($paginaCorrente != 'inicialAluno.php') {
                                                    echo 'href="/jeverson-tcc/inicialAluno.php"';
                                                } ?>>Tela inicial</a>
                        <!-- Se a página atual não for inicialAluno.php, define o atributo href para redirecionar para inicialAluno.php. Caso contrário, não faz nada. -->
                    </li>

                    <li <?php if ($paginaCorrente == 'formcadEntrega.php') {
                            echo 'class="active"';
                        } ?>>
                        <!-- Verifica se a página atual é inicialAluno.php e, se for, adiciona a classe "active" ao item da lista. -->
                        <a class="black-text" <?php if ($paginaCorrente != 'formcadEntrega.php') {
                                                    echo 'href="/jeverson-tcc/crudEntrega/formcadEntrega.php"';
                                                } ?>>Entregar Atividade</a>
                        <!-- Se a página atual não for inicialAluno.php, define o atributo href para redirecionar para inicialAluno.php. Caso contrário, não faz nada. -->
                    </li>

                    <li <?php if ($paginaCorrente == 'perfilAluno.php') {
                            echo 'class="active"';
                        } ?>>
                        <!-- Verifica se a página atual é inicialAluno.php e, se for, adiciona a classe "active" ao item da lista. -->
                        <a class="black-text" <?php if ($paginaCorrente != 'perfilAluno.php') {
                                                    echo 'href="/jeverson-tcc/crudAluno/perfilAluno.php"';
                                                } ?>>Perfil</a>
                        <!-- Se a página atual não for inicialAluno.php, define o atributo href para redirecionar para inicialAluno.php. Caso contrário, não faz nada. -->
                    </li>

                    <li>
                        <!-- Verifica se a página atual é inicialAluno.php e, se for, adiciona a classe "active" ao item da lista. -->
                        <a class="black-text" href="logout.php">Sair</a>
                        <!-- Se a página atual não for inicialAluno.php, define o atributo href para redirecionar para inicialAluno.php. Caso contrário, não faz nada. -->
                    </li>

                </ul>
            </div>
        </nav>
    </div>

<?php
}
?>