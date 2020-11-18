<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Alunos</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Alunos</h1>
        <?php
            include_once('./verifica_login.php');
            include_once('../../../conexao.php');
            
            $Alunos_query = "SELECT * FROM Cadastro ORDER BY ID_Sala";
            $Alunos_result = mysqli_query($conn, $Alunos_query);
            echo "<table border='1'>";
            
            echo "<caption>Alunos</caption>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Aluno</th>";
            echo "<th>Sala</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            while($dados_Alunos = mysqli_fetch_array($Alunos_result)){
              $Nome_Sala_query = "SELECT * FROM Salas WHERE ID_Sala = '".$dados_Alunos['ID_Sala']."'";
              $Nome_Sala_result = mysqli_query($conn, $Nome_Sala_query);
              $Nome_Sala = mysqli_fetch_array($Nome_Sala_result);
              echo "<tr>";
              echo "<td>".$dados_Alunos['Nome']."</td>";
              echo "<td>".$Nome_Sala['Sala']."</td>";
              echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        ?><br><br>
        <a href="../../painel.php">Voltar</a>
    </body>
</html>
