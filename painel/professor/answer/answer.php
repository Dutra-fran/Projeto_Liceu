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
            
            $Salas_Prof_query = "SELECT * FROM Salas_Prof WHERE ID_Professor = '".$_SESSION['id']."'";
            $Salas_Prof_result = mysqli_query($conn, $Salas_Prof_query);
            
            $query_humanas = "SELECT * FROM Humanas WHERE ID_Professor = '".$_SESSION['id']."'";
            $humanas_result = mysqli_query($conn, $query_humanas);
            $row_humanas = mysqli_num_rows($humanas_result);
            
            $query_exatas = "SELECT * FROM Exatas WHERE ID_Professor = '".$_SESSION['id']."'";
            $exatas_result = mysqli_query($conn, $query_exatas);
            $row_exatas = mysqli_num_rows($exatas_result);
            
            if($row_exatas == 1){
              $Disciplina_query = "SELECT * FROM Exatas WHERE ID_Professor = '".$_SESSION['id']."'";
              $Disciplina_result = mysqli_query($conn, $Disciplina_query);
              $Disciplina = mysqli_fetch_array($Disciplina_result);
            }

            if($row_humanas == 1){
              $Disciplina_query = "SELECT * FROM Humanas WHERE ID_Professor = '".$_SESSION['id']."'";
              $Disciplina_result = mysqli_query($conn, $Disciplina_query);
              $Disciplina = mysqli_fetch_array($Disciplina_result);
            }

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

            while($dados_Salas_Prof = mysqli_fetch_array($Salas_Prof_result)){
              $Alunos_info_query = "SELECT Cadastro.Nome AS Nome, Salas.Sala AS Sala, Notas.Notas AS Notas FROM Verifica_Prova INNER JOIN Cadastro ON Cadastro.ID = Verifica_Prova.ID_Cadastro INNER JOIN Notas ON Notas.ID_Cadastro = Cadastro.ID INNER JOIN Salas ON Salas.ID_Sala = Cadastro.ID_Sala WHERE Verifica_Prova.ID_Sala = '".$dados_Salas_Prof['ID_Sala']."' AND Verifica_Prova.Disciplina = '".$Disciplina['Disciplina']."'";
              $Alunos_info_result = mysqli_query($conn, $Alunos_info_query);
              while($Alunos_info = mysqli_fetch_array($Alunos_info_result)){
                echo "<tr>";
                echo "<td>".$Alunos_info['Nome']."</td>";
                echo "<td>".$Alunos_info['Sala']."</td>";
                echo "<td>".$Alunos_info['Notas']."</td>";
                echo "</tr>";
              }
            }

            echo "</tbody>";
            echo "</table>";
        ?>
        <a href="../../painel.php">Voltar</a>
    </body>
</html>
