<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Painel - teste</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <?php
            
            include_once('./verifica_login.php'); // Incluimos nosso arquivo que verifica se uma sessão de login existe
            include_once('../conexao.php'); // Inclui o nosso arquivo que faz a conexão com a nossa base de dados
            echo "<h1>Olá, ". $_SESSION['usuario'] ."</h1><br><br>";
            
            if(isset($_SESSION['acesso'])){
              echo "<ul>";
              echo "<li><a href='./professor/prova.php'>Criar prova</a></li>";
              echo "<li><a href='./professor/answer/answer.php'>Alunos que responderam a prova</a></li>";
              echo "<li><a href='./professor/alunos/alunos.php'>Alunos</a></li>";
              echo "</ul>";
            }

            if(isset($_SESSION['aluno'])){
              $Aluno_query = "SELECT * FROM Cadastro WHERE Nome = '".$_SESSION['usuario']."' AND Senha = '".$_SESSION['senha']."'";
              $Aluno_result = mysqli_query($conn, $Aluno_query);
              $Aluno_dados = mysqli_fetch_array($Aluno_result);

              if($Aluno_dados['ID_Exatas'] == 1){
                $_SESSION['exatas'] = $Aluno_dados['ID_Exatas'];
              }

              if($Aluno_dados['ID_Humanas'] == 2){
                $_SESSION['humanas'] = $Aluno_dados['ID_Humanas'];
              }

              echo "<ul>";
              echo "<li><a href='./alunos/provas/provas.php'>Provas</a></li>";
              echo "<li><a href='./alunos/notas/notas.php'>Notas</a></li>";
              echo "<li><a href='./alunos/feedback/feedback.php'>Deixe seu feedback</a></li>";
              echo "</ul>";
            }

            if(isset($_SESSION['mensagem'])){
              echo "<h2>".$_SESSION['mensagem']."</h2><br><br>";
              unset($_SESSION['mensagem']);
            }

            echo "<a href='./logout.php'>Sair</a><br><br>";
        ?>
    </body>
</html>
