<?php

//conectar com o banco de dados jeverson-tcc.
require_once "../conecta.php";

//incluir o arquivo que envia o email para o aluno quando a atividade é deferida ou indeferida.
require_once "funcaoEmail.php";

//incluir o arquivo de notificações do sistema. Dentro desse arquivo também inciamos a sessão (session_start()).
require_once "../boasPraticas/notificacoes.php";

//declarar a variavel de conexão com o banco de dados jeverson-tcc.
$mysql = conectar();

//verificar qual foi a opção que o coordenador de curso escolheu.
if ($_POST['deferir']) {

    //se escolheu a opção de indeferir o arquivo que foi entregue no sistema, realizamos o processedimento necessários.

    //receber os dados vindos do formulário que está no arquivo validar.php.
    $id = $_POST['id_atividade'];
    $cargaDefe = $_POST['cargaDefe'];
    $situacao = "Deferido";
    $observacoes = $_POST['observacoes'];
    $id_aluno = $_POST['aluno'];
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $email = $_POST['email'];
    $certificado = $_POST['certificado'];
    $descricao = $_POST['descricao'];

    //para evitar erros na contagem total das horas aprovadas, devemos verificar qual a situação que à atividade tem quando vem do banco de dados.

    //buscar pela situação da atividade que está sendo aprovada.
    $sql_busca_status = "SELECT status FROM entrega_atividade WHERE id_entrega_atividade = $id";

    //executar o camando $sql_busca_status.
    $query = excutarSQL($mysql, $sql_busca_status);

    //transformar os dados vindos do banco de dados em um array associativo
    $status = mysqli_fetch_assoc($query);

    //verificar se o status é igual a Indeferido.
    if ($status['status'] == "Indeferido" or $status['status'] == "Em análise") {

        //se o status for igual a Indeferido ou Em análise, então quer dizer que à atividade não sofreu nenhuma correção do coordenador de curso e por esse motivo podemos fazer a soma das horas aprovadas pelo coordenador.

        //comando que busca pelo total de horas aprovadas que o aluno tem.
        $sql_total_horas = "SELECT total_horas FROM aluno WHERE id_aluno = $id_aluno";

        //executar o camando $sql_total_horas.
        $resultado = excutarSQL($mysql, $sql_total_horas);

        //transformar os dados do total de horas do aluno, em um array associativo.
        $horas = mysqli_fetch_assoc($resultado);

        //a variavel $total_horas recebe as horas que vem do banco de dados + a carga horária que foi aprovada pelo coordenador de curso
        $total_horas = $horas['total_horas'] + $cargaDefe;

        //com a soma das horas aprovadas, podemos fazer a atualização do total de horas do aluno.
        $sql_soma_total_horas = "UPDATE aluno SET total_horas = $total_horas WHERE id_aluno = $id_aluno";

        //executar o comando atualização das horas do aluno.
        excutarSQL($mysql, $sql_soma_total_horas);

    } else {
       
        //se a situação for diferente de Indeferido, quer dizer que o coordenador de curso realizou alguma correção sobre a entrega e por esse motivo não devemos somar as horas.
    }

    //declarar o comando de alterar no banco de dados.
    $sql = "UPDATE entrega_atividade SET carga_horaria_aprovada = $cargaDefe, status = '$situacao', observacoes = '$observacoes' WHERE id_entrega_atividade = $id";

    //executar o comando sql ($sql).
    excutarSQL($mysql, $sql);

    // Agora você pode chamar a função email
    email($nome, $situacao, $email, $cargaDefe, $descricao, $matricula, $certificado, $observacoes, 1);

    //chamar a função de notificação do sistema
    notificacoes(1,"Atividade deferida com sucesso!");

    //redirecionar o coordenador de curso para a tela validação
    header("location: validar.php?id=" . $id_aluno);
} else {

    //se escolheu o opção de deferir o arquivo que foi entregue no sistema, realizamos o processedimento necessários.
    if ($_POST['indeferir']) {

        //receber os dados vindos do formulário que está no arquivo validar.php.
        $id = $_POST['id_atividade'];
        $cargaDefe = 0;
        $situacao = "Indeferido";
        $id_aluno = $_POST['aluno'];
        $observacoes = $_POST['observacoes'];
        $nome = $_POST['nome'];
        $matricula = $_POST['matricula'];
        $email = $_POST['email'];
        $certificado = $_POST['certificado'];
        $descricao = $_POST['descricao'];


        //declarar o comando sql de alteração no banco de dados
        $sql = "UPDATE entrega_atividade SET carga_horaria_aprovada = $cargaDefe, status = '$situacao', observacoes = '$observacoes' WHERE id_entrega_atividade = $id";

        //executar o comando sql ($sql).
        excutarSQL($mysql, $sql);

        // Agora você pode chamar a função email
        email($nome, $situacao, $email, $cargaDefe, $descricao, $matricula, $certificado, $observacoes, 2);

        notificacoes(1,"Atividade indeferida com sucesso!");
        
        //redirecionar o coordenador de curso para a tela de validação.
        header("location: validar.php?id=" . $id_aluno);
    }
}
