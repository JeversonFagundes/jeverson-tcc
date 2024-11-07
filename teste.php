<?php

//FORCADALUNO.PHP

//inicluir o arquivo que exibe as notificações do sistema.
require_once "boasPraticas/notificacoes.php";

//conectar ao banco de dados jeverson-tcc.
require_once "conecta.php";

//declarar a veriavél de conexão com o banco de dados jeverson-tcc. Essa veriavél vem do arquivo conecta.php.
$mysql = conectar();

$senha = "123";

$senha1 = password_hash($senha,  PASSWORD_ARGON2ID);

echo "$senha1";

//buscar pelos curso de exibi-los em ordem alfabética.
$sql = "SELECT id_curso, nome_curso FROM curso ORDER BY nome_curso ASC";

//atribuir a veriavél resultado ($resultado) o valor da excução do comando sql ($sql).
$resultado = excutarSQL($mysql, $sql);
?>




//definir a estrutura de repetição que irá mostrar na tela do aluno, todas as atividades que ele entregou no sistema.
            while ($dados = mysqli_fetch_assoc($query)) {

                //dentro da repetição verificamos se o status e a observação são diferentes das configurações padrões do sistema. Se isso for verdadeiro, significa que o coordenador de curso adcionou uma correção a entrega do certificado, diante disso imprimimos as informações de status, observações que o coordenador de curso adicionou e a carga horária que foi aprovada.
                if ($dados['status'] != "Em análise" or $dados['observacoes'] != "Sem observações") {
        ?>

                    <div class="card">
                        <div class="card-body">

                            <h1 class="card-titla">Titulo do certificado: <?php echo $dados['titulo_certificado']; ?></h1>
                            <p class="card-text">Natureza do certificado: <?php echo $dados['natureza']; ?></p>
                            <p class="card-text">Descrição da natureza: <?php echo $dados['descricao']; ?></p>
                            <p class="card-text">O certificado: <a href="<?php echo $pasta . $dados['caminho']; ?>"><?php echo $dados['certificado']; ?></a></p>
                            <p class="card-text">Carga horária do certificado: <?php echo $dados['carga_horaria_certificado']; ?></p>
                            <p class="card-text">Carga horária deferida: <?php echo $dados['carga_horaria_aprovada']; ?></p>
                            <p class="card-text">Situação: <?php echo $dados['status']; ?></p>
                            <p class="card-text">Observações: <?php echo $dados['observacoes']; ?></p>
                            <button class="btnAlterar" value="<?php echo $dados['id_entrega_atividade']; ?>">Alterar</button>
                            <button class="btnExcluir" value="<?php echo $dados['id_entrega_atividade']; ?>">Excluir</button>
                        </div>
                    </div>

                <?php


                } else {

                ?>

                    <div class="card">
                        <div class="card-body">

                            <h1 class="card-titla">Titulo do certificado: <?php echo $dados['titulo_certificado']; ?></h1>
                            <p class="card-text">Natureza do certificado: <?php echo $dados['natureza']; ?></p>
                            <p class="card-text">Descrição da natureza: <?php echo $dados['descricao']; ?></p>
                            <p class="card-text">O certificado: <a href="<?php echo $pasta . $dados['caminho']; ?>"><?php echo $dados['certificado']; ?></a></p>
                            <p class="card-text">Carga horária do certificado: <?php echo $dados['carga_horaria_certificado']; ?></p>
                            <p class="card-text">Situação: <?php echo $dados['status']; ?></p>
                            <button class="btnAlterar" value="<?php echo $dados['id_entrega_atividade']; ?>">Alterar</button>
                            <button class="btnExcluir" value="<?php echo $dados['id_entrega_atividade']; ?>">Excluir</button>
                        </div>
                    </div>

        <?php


                }
            }