<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Painel - teste</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <?php
            
            include_once('verifica_login.php'); // Incluimos nosso arquivo que verifica se uma sessão de login existe
            include_once('../conexao.php'); // Inclui o nosso arquivo que faz a conexão com a nossa base de dados
            echo "<h1>Olá, ". $_SESSION['usuario'] ."</h1><br><br>";
            
            if(isset($_SESSION['acesso'])){
              $busca = "SELECT * FROM Professores WHERE Nome = '".$_SESSION['usuario']."' AND Senha = md5('".$_SESSION['senha']."')";
              $resultado = mysqli_query($conn, $busca);
              $roww = mysqli_num_rows($resultado);
              if($roww == 1){
                $_SESSION['professor'] = "TRUE";
                echo "<ul>";
                echo "<li><a href='./professor/prova.php'>Criar prova</a></li>";
                echo "<li><a href='./professor/answer/answer.php'>Alunos que responderam a prova</a></li>";
                echo "<li><a href='./professor/alunos/alunos.php'>Alunos</a></li>";
                echo "</ul>";
              }
            }

            if(isset($_SESSION['aluno'])){
              $busca = "SELECT * FROM Cadastro WHERE Nome = '".$_SESSION['usuario']."' AND Senha = '".$_SESSION['senha']."'";
              $resultado = mysqli_query($conn, $busca);
              $roww = mysqli_num_rows($resultado);
              $dadoss = mysqli_fetch_array($resultado);

              if($dadoss['ID_Exatas'] == 1){
                $_SESSION['exatas'] = $dadoss['ID_Exatas'];
              }

              if($dadoss['ID_Humanas'] == 2){
                $_SESSION['humanas'] = $dadoss['ID_Humanas'];
              }
              if($roww == 1){
                echo "<ul>";
                echo "<li><a href='./alunos/provas/provas.php'>Provas</a></li>";
                echo "<li><a href='./alunos/notas/notas.php'>Notas</a></li>";
                echo "<li><a href='./alunos/feedback/feedback.php'>Deixe seu feedback</a></li>";
                echo "</ul>";
              }
            }

            if(isset($_SESSION['mensagem'])){
              echo "<h2>".$_SESSION['mensagem']."</h2><br><br>";
              unset($_SESSION['mensagem']);
            }

            echo "<a href='./logout.php'>Sair</a><br><br>";
        ?>
    </body>
</html>