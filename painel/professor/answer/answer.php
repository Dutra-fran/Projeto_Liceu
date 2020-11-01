<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Alunos que Responderam</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Alunos que responderam a prova</h1>
        <?php
            include_once('../../../conexao.php');
            include_once('./verifica_login.php');
            
            $query = "SELECT * FROM Salas_Prof WHERE ID_Professor = '".$_SESSION['id']."'";
            $result = mysqli_query($conn, $query);
            
            $query_humanas = "SELECT * FROM Humanas WHERE ID_Professor = '".$_SESSION['id']."'";
            $humanas_result = mysqli_query($conn, $query_humanas);
            $row_humanas = mysqli_num_rows($humanas_result);
            
            $query_exatas = "SELECT * FROM Exatas WHERE ID_Professor = '".$_SESSION['id']."'";
            $exatas_result = mysqli_query($conn, $query_exatas);
            $row_exatas = mysqli_num_rows($exatas_result);
            
            if($row_exatas == 1){
              $query1 = "SELECT * FROM Exatas WHERE ID_Professor = '".$_SESSION['id']."'";
              $result1 = mysqli_query($conn, $query1);
              $disciplina = mysqli_fetch_array($result1);
            }

            if($row_humanas == 1){
              $query1 = "SELECT * FROM Humanas WHERE ID_Professor = '".$_SESSION['id']."'";
              $result1 = mysqli_query($conn, $query1);
              $disciplina = mysqli_fetch_array($result1);
            }
            
            while($dados = mysqli_fetch_array($result)){
              $query2 = "SELECT Cadastro.Nome AS Nome, Salas.Sala AS Sala, Notas.Notas AS Notas FROM Verifica_Prova INNER JOIN Cadastro ON Cadastro.ID = Verifica_Prova.ID_Cadastro INNER JOIN Notas ON Notas.ID_Cadastro = Cadastro.ID INNER JOIN Salas ON Salas.ID_Sala = Cadastro.ID_Sala WHERE Verifica_Prova.ID_Sala = '".$dados['ID_Sala']."' AND Verifica_Prova.Disciplina = '".$disciplina['Disciplina']."'";
              $result2 = mysqli_query($conn, $query2);
              echo "<table border='1'>";
              echo "<caption>Alunos que responderam a sua prova</caption>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>Aluno</th>";
              echo "<th>Sala</th>";
              echo "<th>Nota</th>";
              echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
              while($dados2 = mysqli_fetch_array($result2)){
                echo "<tr>";
                echo "<td>".$dados2['Nome']."</td>";
                echo "<td>".$dados2['Sala']."</td>";
                echo "<td>".$dados2['Notas']."</td>";
                echo "</tr>";
              }
              echo "</tbody>";
              echo "</table>";
            }
        ?>
        <a href="../../painel.php">Voltar</a>
    </body>
</html>