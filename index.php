<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <<link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>

</head>

<body>

    <!--INDEX.PHP-->

    <!--Esta é a tela de login dos usuários do sistema.-->

    <main>
        <h1>Tela de login</h1>

        <form action="login.php" method="post">

            <label for="email">Email: </label>
            <input type="email" name="email" id="email"><br><br>

            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha"><br>

            <ul>
                <li><a href="recuperarSenha/form-recuperar-senha.html">Esqueci minha senha</a></li>
                <li><a href="crudAluno/formcadAluno.php">Não possui conta? Clique aqui!</a></li>
            </ul>

            <button type="submit">Entrar</button>
        </form>


    </main>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>

</html>