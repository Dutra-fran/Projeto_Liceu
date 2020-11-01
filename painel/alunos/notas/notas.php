<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Notas</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Notas</h1>
        <?php
            include_once('./verifica_login.php');
            include('../../../conexao.php');
            
            $query_matematica = "SELECT * FROM Notas WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = 'Matematica'";
            $matematica_result = mysqli_query($conn, $query_matematica);
            $matematica = mysqli_fetch_array($matematica_result);
            
            $query_portugues = "SELECT * FROM Notas WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = 'Portugues'";
            $portugues_result = mysqli_query($conn, $query_portugues);
            $portugues = mysqli_fetch_array($portugues_result);
            
            if(isset($_SESSION['exatas'])){
              echo "<table border='1'>";
              echo "<caption>Nota das matérias</caption>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>Português</th>";
              echo "<th>Matemática</th>";
              echo "<th>Física</th>";
              echo "<th>Química</th>";
              echo "<th>Biologia</th>";
              echo "<th>Ed. Física</th>";
              echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
              echo "<tr>";

              $query_fisica = "SELECT * FROM Notas WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = 'Fisica'";
              $fisica_result = mysqli_query($conn, $query_fisica);
              $fisica = mysqli_fetch_array($fisica_result);

              $query_quimica = "SELECT * FROM Notas WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = 'Quimica'";
              $quimica_result = mysqli_query($conn, $query_quimica);
              $quimica = mysqli_fetch_array($quimica_result);

              $query_biologia = "SELECT * FROM Notas WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = 'Biologia'";
              $biologia_result = mysqli_query($conn, $query_biologia);
              $biologia = mysqli_fetch_array($biologia_result);

              $query_EdFisica = "SELECT * FROM Notas WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = 'EdFisica'";
              $EdFisica_result = mysqli_query($conn, $query_EdFisica);
              $EdFisica = mysqli_fetch_array($EdFisica_result);

              echo "<td>".$portugues['Notas']."</td>";
              echo "<td>".$matematica['Notas']."</td>";
              echo "<td>".$fisica['Notas']."</td>";
              echo "<td>".$quimica['Notas']."</td>";
              echo "<td>".$biologia['Notas']."</td>";
              echo "<td>".$EdFisica['Notas']."</td>";
              echo "</tr>";
              echo "</tbody>";
              
              echo "</table>";
            }

            if(isset($_SESSION['humanas'])){
              echo "<table border='1'>";
              echo "<caption>Nota das matérias</caption>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>Português</th>";
              echo "<th>Matemática</th>";
              echo "<th>História</th>";
              echo "<th>Geografia</th>";
              echo "<th>Filosofia</th>";
              echo "<th>Sociologia</th>";
              echo "<th>Inglês</th>";
              echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
              echo "<tr>";

              $query_historia = "SELECT * FROM Notas WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = 'Historia'";
              $historia_result = mysqli_query($conn, $query_historia);
              $historia = mysqli_fetch_array($historia_result);

              $query_geografia = "SELECT * FROM Notas WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = 'Geografia'";
              $geografia_result = mysqli_query($conn, $query_geografia);
              $geografia = mysqli_fetch_array($geografia_result);

              $query_filosofia = "SELECT * FROM Notas WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = 'Filosofia'";
              $filosofia_result = mysqli_query($conn, $query_filosofia);
              $filosofia = mysqli_fetch_array($filosofia_result);

              $query_sociologia = "SELECT * FROM Notas WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = 'Sociologia'";
              $sociologia_result = mysqli_query($conn, $query_sociologia);
              $sociologia = mysqli_fetch_array($sociologia_result);

              $query_ingles = "SELECT * FROM Notas WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = 'Ingles'";
              $ingles_result = mysqli_query($conn, $query_ingles);
              $ingles = mysqli_fetch_array($ingles_result);

              echo "<td>".$portugues['Notas']."</td>";
              echo "<td>".$matematica['Notas']."</td>";
              echo "<td>".$historia['Notas']."</td>";
              echo "<td>".$geografia['Notas']."</td>";
              echo "<td>".$filosofia['Notas']."</td>";
              echo "<td>".$sociologia['Notas']."</td>";
              echo "<td>".$ingles['Notas']."</td>";
              echo "</tr>";
              echo "</tbody>";
              
              echo "</table>";
            }
        ?><br><br>
        <a href="../../painel.php">Voltar</a>
    </body>
</html>