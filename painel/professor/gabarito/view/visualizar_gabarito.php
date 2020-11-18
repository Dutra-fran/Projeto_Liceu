<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Visualizar gabarito</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Visualização do gabarito</h1>
        <?php
            include_once('../../../../conexao.php');
            include_once('./verifica_login.php');
            
            $Salas_Prof_query = "SELECT * FROM Salas_Prof WHERE ID_Professor = '".$_SESSION['id']."'";
            $Salas_Prof_result = mysqli_query($conn, $Salas_Prof_query);
            
            while($dados_Salas_Prof = mysqli_fetch_array($Salas_Prof_result)){
              $Nome_Sala_query = "SELECT * FROM Salas WHERE ID_Sala = '".$dados_Salas_Prof['ID_Sala']."'";
              $Nome_Sala_result = mysqli_query($conn, $Nome_Sala_query);
              $Nome_Sala = mysqli_fetch_array($Nome_Sala_result);

              $Gabarito_query = "SELECT * FROM Gabarito WHERE ID_Sala = '".$dados_Salas_Prof['ID_Sala']."' AND Disciplina = '".$_GET['Disciplina']."' ORDER BY ID ASC";
              $Gabarito_result = mysqli_query($conn, $Gabarito_query);
              $Gabarito_row = mysqli_num_rows($Gabarito_result);

              if($Gabarito_row !== 0){
                echo "<h2>Sala: ".$Nome_Sala['Sala']."</h2>";
                $i = 1;
                while($dados_Gabarito = mysqli_fetch_array($Gabarito_result)){
                  echo $i.") ". $dados_Gabarito['Questao'] ."<br>";
                  $i++;
                }
                echo "<a href='./processa.php?ID_Sala=".$dados_Salas_Prof['ID_Sala']."&Disciplina=".$_GET['Disciplina']."'>Apagar</a>";
                echo "<br><br>";
              } else {
                echo "<h2>A prova de ".$_GET['Disciplina']." da sala ".$Nome_Sala['Sala']." ainda está sem gabarito!</h2>";
              }
            }

            if(isset($_SESSION['mensagem'])){
              echo "<h3>".$_SESSION['mensagem']."</h3><br>";
              unset($_SESSION['mensagem']);
            }
        ?>
        <a href="../gabarito.php">Voltar</a>
    </body>
</html>
