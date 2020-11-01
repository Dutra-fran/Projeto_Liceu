<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Provas</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Provas</h1>
        <?php
            include_once('./verifica_login.php');
            include_once('../../../conexao.php');
            
            $busca = "SELECT ID_Sala FROM Cadastro WHERE Nome = '".$_SESSION['usuario']."' AND Senha = '".$_SESSION['senha']."'";
            $resultado = mysqli_query($conn, $busca);
            $dado = mysqli_fetch_array($resultado);
            
            if(isset($_SESSION['exatas'])){
              $busca1 = "SELECT Exatas.Disciplina AS Disciplina FROM Exatas INNER JOIN Professores ON Exatas.ID_Professor = Professores.ID_Professor INNER JOIN Salas_Prof ON Salas_Prof.ID_Professor = Professores.ID_Professor WHERE Salas_Prof.ID_Sala = '".$dado['ID_Sala']."'";
              $resultado1 = mysqli_query($conn, $busca1);

              $dados = 0;
              while($dados = mysqli_fetch_array($resultado1)){
                echo "<ul>";
                echo "<li><a href='./disciplinas/".$dados['Disciplina'].".php'>".$dados['Disciplina']."</a></li>";
                echo "</ul>";
                
              }
            }

            if(isset($_SESSION['humanas'])){
              $busca1 = "SELECT Exatas.Disciplina AS Disciplina FROM Exatas INNER JOIN Professores ON Exatas.ID_Professor = Professores.ID_Professor INNER JOIN Salas_Prof ON Professores.ID_Professor = Salas_Prof.ID_Professor WHERE Salas_Prof.ID_Sala = '".$dado['ID_Sala']."'";
              $resultado1 = mysqli_query($conn, $busca1);

              $dados = 0;
              while($dados = mysqli_fetch_array($resultado1)){
                echo "<ul>";
                echo "<li><a href='./disciplinas/".$dados['Disciplina'].".php'>".$dados['Disciplina']."</a></li>";
                echo "</ul>";
                
              }
            }
        ?>
        <br><br><br><a href="../../painel.php">Voltar</a>
    </body>
</html>