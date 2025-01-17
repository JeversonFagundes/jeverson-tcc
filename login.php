<?php

//LOGIN.PHP

//incluir o arquivo das notificações do sistema. Dentro desse arquivo também iniciamos a sessão (session_start()).
require_once "boasPraticas/notificacoes.php";

//conectar com o banco de dados jeverson-tcc.
require_once "conecta.php";

//declarar a veriável de conexão com o banco de dados jeverson-tcc. Esta variavélç vem do arquivo conecta.php.
$mysql = conectar();

//receber os valores vindos do formulário de login.
//Limpar os dados que foram colocados nos campos de email e senha.

//O real_escape_string() é usado para escapar caracteres especiais em uma string, tornando-a segura para ser usada em uma consulta SQL, evitando que caracteres especiais quebrem a excução do comando sql.

//O trim() em PHP é utilizado para remover os espaços em branco (ou outros caracteres) do início e do final de uma string. Isso é útil quando você deseja limpar entradas de dados de usuários ou formatar strings de maneira mais adequada.

$email = trim($mysql->real_escape_string($_POST['email']));

$senha = trim($mysql->real_escape_string($_POST['senha']));

//O comando COUNT(*) é usado para contar o número total de registros (linhas) em uma tabela sem retornar o valor dos registros.
//O comando sql mysqli_fetch_row() é usado para obter uma linha de dados de um conjunto de resultados e retorná-la como um array enumerado

// Verifica se o e-mail informado existe na tabela de alunos.
$consulta_alunos = excutarSQL($mysql, "SELECT COUNT(*) FROM aluno WHERE email = '$email'");
$quantidade_alunos = mysqli_fetch_row($consulta_alunos)[0];

// Verifica se o e-mail informado existe na tabela de coordenadores.
$consulta_coordenadores = excutarSQL($mysql, "SELECT COUNT(*) FROM coordenador_curso WHERE email = '$email'");
$quantidade_coordenadores = mysqli_fetch_row($consulta_coordenadores)[0];

// Verifica se o e-mail informado existe na tabela de administradores.
$consulta_administradores = excutarSQL($mysql, "SELECT COUNT(*) FROM administrador WHERE email = '$email'");
$quantidade_administradores = mysqli_fetch_row($consulta_administradores)[0];

//com a quantidade de cada uma das buscas nas tabelas podemos agora fazer as devidas verificações refentes a essas variaveis de quantidade.
if ($quantidade_alunos == 0 && $quantidade_coordenadores == 0 && $quantidade_administradores == 0) {

    //gerar a notificação de que o email informado não existe no sistema.
    notificacoes(2, "O email informado não está cadastrado no sistema.");

    //redirecionar para a tela de login.
    header("location: index.php");
} else {

    //se uma das variaveis de quantidade for diferente de zero, quer dizer o email digitado existe em alguma tabela dentro do banco de dados e por isso devemos agora verificar de qual tabela é esse email informado e quem é esse usuário. 

    //Depois achar a tabela e o usuário do email informado, devemos declarar um comendo sql que retorne as informações necessários do usuario como seu nome, id_curso, id_usuario e sua senha. Com isso em mãoes, agora para finalizar o validação do usuário, devemos verificar se a senha informada na tela de login confere com a senha que venho do banco de dados, se a senha não confere quer dizer que o usuário errou sua senha, se a senha confere, nós temos a informação da tebela onde está este usuário e consequentemente sabemos o nivél de acesso desse usuário, com isso podemos redirecionar ele para as respectivas páginas que ele tem acesso.

    if ($quantidade_alunos != 0) {

        $sql = "SELECT a.nome, a.id_curso, a.id_aluno, a.senha FROM aluno a WHERE email = '$email'";

        $query = excutarSQL($mysql, $sql);

        $aluno = mysqli_fetch_assoc($query);

        //password_verify() é utilizado para verificar se uma senha fornecida corresponde a um hash previamente gerado.

        //password_verify("senha que recebemos do formulário de loigin", "senha vinda do banco de dados")

        if (password_verify($senha, $aluno['senha'])) {

            $_SESSION['aluno'][0] = $aluno['nome'];
            $_SESSION['aluno'][1] = $aluno['id_aluno'];
            $_SESSION['aluno'][2] = $aluno['id_curso'];

            //echo "A senha  do aluno confere! <p><a href = \"logout.php\">Voltar</a></p>";

            header("location: inicialAluno.php");
        } else {

            //gerar a notificação de que a senha está incorreta.
            notificacoes(2, "A senha informada está incorreta.");

            //redirecionar o usuário para a  tela de login
            header("location: index.php");
        }
    } else {

        if ($quantidade_coordenadores != 0) {

            $sql2 = "SELECT cc.nome, cc.senha, cc.id_coordenador, cc.id_curso FROM coordenador_curso cc
                    WHERE email = '$email'";

            $query2 = excutarSQL($mysql, $sql2);

            $coordenador = mysqli_fetch_assoc($query2);

            if (password_verify($senha, $coordenador['senha'])) {

                $_SESSION['coordenador'][0] = $coordenador['nome'];
                $_SESSION['coordenador'][1] = $coordenador['id_coordenador'];
                $_SESSION['coordenador'][2] = $coordenador['id_curso'];

                //echo "A senha do coordenador confere! <p><a href = \"logout.php\">Voltar</a></p>";

                header("location: inicialCoordenador.php");
            } else {
                //gerar a notificação de que a senha está incorreta.
                notificacoes(2, "A senha informada está incorreta.");

                //redirecionar o usuário para a  tela de login
                header("location: index.php");
            }
        } else {

            if ($quantidade_administradores != 0) {

                $sql3 = "SELECT adm.email, adm.senha FROM administrador adm WHERE email = '$email'";

                $query3 = excutarSQL($mysql, $sql3);

                $administrador = mysqli_fetch_assoc($query3);

                if (password_verify($senha, $administrador['senha'])) {

                    $_SESSION['administrador'][0] = $administrador['email'];

                    header("location: inicialAdmin.php");
                } else {

                    //gerar a notificação de que a senha está incorreta.
                    notificacoes(2, "A senha informada está incorreta.");

                    //redirecionar o usuário para a  tela de login
                    header("location: index.php");
                }
            }
        }
    }
}
