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
            
            $query = "SELECT * FROM Cadastro GROUP BY ID_Sala";
            $result = mysqli_query($conn, $query);
            echo "<table border='1'>";
            
            echo "<caption>Alunos</caption>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Aluno</th>";
            echo "<th>Sala</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            while($dados = mysqli_fetch_array($result)){
              $query2 = "SELECT * FROM Salas WHERE ID_Sala = '".$dados['ID_Sala']."'";
              $result2 = mysqli_query($conn, $query2);
              $dados2 = mysqli_fetch_array($result2);
              echo "<tr>";
              echo "<td>".$dados['Nome']."</td>";
              echo "<td>".$dados2['Sala']."</td>";
              echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        ?><br><br>
        <a href="../../painel.php">Voltar</a>
    </body>
</html>
