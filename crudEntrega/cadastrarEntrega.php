<?php
//conectar com o banco de dados.
include("../conecta.php");

include("../protecao.php");

$id = $_SESSION['aluno'][1];

//receber os dados.
$natureza = $_POST['natureza'];
$titulo = $_POST['titulo'];
$carga = $_POST['carga'];
$carga_deferida = $_POST['cargaDefe'];
$status = $_POST['status'];
$certificado = $_FILES['certificado'];

//verificar se deu erro no recebimento do arquivo.
if ($certificado['error'] != 0) {

    die("Falha ao receber o certificado enviado! <p><a href = \"formcadEntrega.php\">Tentar de novo?</a></p>");
} else {

    //pasta de destino.
    $pastaDestino = "../certificados/";

    //nome do arquivo.
    $nome_certificado = $certificado['name'];

    //novo nome do arquivo.
    $novo_nome_certificado = uniqid();

    //estenção do certificado.
    $extencao = strtolower(pathinfo($nome_certificado, PATHINFO_EXTENSION));

    //verificar as extenções que são permitidas.
    if (
        $extencao != "png" and $extencao != "jpeg" and

        $extencao != "gif" and $extencao != "jfif" and

        $extencao != "svg" and $extencao != "pdf" and $extencao != "jpg"

    ) {

        echo "Este tipo de arquivos" . " " . "|" . "." . $extencao . "|" . " " . "não é aceito <p><a href = \"formcadEntrega.php\">Voltar</a></p>";
    } else {

        //mover o arquivo.
        $mover_certificado = move_uploaded_file($certificado['tmp_name'], $pastaDestino. $novo_nome_certificado . "." . $extencao);

        //verificar se deu certo mover certificado.
        if ($mover_certificado) {

            //criar o caminho.
            $caminho = $novo_nome_certificado . "." . $extencao;

            //inserir no banco de dados.
            $sql = "INSERT INTO entrega_atividade (natureza, titulo_certificado, carga_horaria_certificado, certificado, caminho, carga_horaria_aprovada, status, id_aluno)
           
           VALUES ('$natureza', '$titulo', $carga, '$nome_certificado','$caminho', $carga_deferida, '$status',$id)";

            $query = mysqli_query($mysql, $sql);

            echo "O arquivo " . "|" . $nome_certificado . "|" . " " . "foi cadastrado com sucesso!";
        }
    }
}
