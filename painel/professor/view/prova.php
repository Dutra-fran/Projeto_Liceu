<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>View prova</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Visualizar prova</h1>
        <?php
            include_once('./verifica_login.php');
            include_once('../../../conexao.php');
            $i = 0;
            if(!isset($_SESSION['acesso'])){
              $_SESSION['mensagem'] = "Só professores têm acesso à esta página.";
              header('Location: ../../painel.php');
              exit();
            }

            $Exatas_query = "SELECT * FROM Exatas WHERE ID_Professor = '".$_SESSION['id']."'";
            $Exatas_result = mysqli_query($conn, $Exatas_query);
            $Exatas_row = mysqli_num_rows($Exatas_result);
            $dados_Exatas = mysqli_fetch_array($Exatas_result);

            $Humanas_query = "SELECT * FROM Humanas WHERE ID_Professor = '".$_SESSION['id']."'";
            $Humanas_result = mysqli_query($conn, $Humanas_query);
            $Humanas_row = mysqli_num_rows($Humanas_result);
            $dados_Humanas = mysqli_fetch_array($Humanas_result);

            if($Exatas_row == 1){

              $Salas_Prof_query = "SELECT * FROM Salas_Prof WHERE ID_Professor = '".$_SESSION['id']."'";
              $Salas_Prof_result = mysqli_query($conn, $Salas_Prof_query);

              while($dados_Salas_Prof = mysqli_fetch_array($Salas_Prof_result)){

                $Prova_query = "SELECT * FROM ".$dados_Exatas['Disciplina']." WHERE ID_Sala = '".$dados_Sala_Prof['ID_Sala']."'";
                $Prova_result = mysqli_query($conn, $Prova_query);
                $Prova_row = mysqli_num_rows($Prova_result);

                if(!$Prova_result){
                  $_SESSION['mensagem_professor'] = "Erro ao visualizar a prova no banco de dados. Por favor, tente novamente.";
                  header('Location: ../prova.php');
                  exit();
                }

                while($dados_Prova = mysqli_fetch_array($Prova_result)){
                  $i++;

                  if($i == 1){
                    $Nome_Sala_query = "SELECT * FROM Salas WHERE ID_Sala = '".$dados_Prova['ID_Sala']."'";
                    $Nome_Sala_result = mysqli_query($conn, $Nome_Sala_query);
                    $Nome_Sala = mysqli_fetch_array($Nome_Sala_result);

                    echo "<h2>Prova da sala ".$Nome_Sala['Sala']."</h2>";
                  }

                  echo "<br><br>$i. ".$dados_Prova['Questao'];
                  if($dados_Prova['item1'] !== ""){
                    echo "<br>A) ". $dados_Prova['item1'];
                  }
                  if($dados_Prova['item2'] !== ""){
                    echo "<br>B) ". $dados_Prova['item2'];
                  }
                  if($dados_Prova['item3'] !== ""){
                    echo "<br>C) ". $dados_Prova['item3'];
                  }
                  if($dados_Prova['item4'] !== ""){
                    echo "<br>D) ". $dados_Prova['item4'];
                  }
                  if($dados_Prova['item5'] !== ""){
                    echo "<br>E) ". $dados_Prova['item5'];
                  }

                  if($i == $Prova_row){
                    echo "<br><br><a href='processa.php?ID_Sala=".$dados_Prova['ID_Sala']."'>Apagar prova</a>";
                    $i = 0;
                  }
                }
              }
            }

            if($Humanas_row == 1){

              $Salas_Prof_query = "SELECT * FROM Salas_Prof WHERE ID_Professor = '".$_SESSION['id']."'";
              $Salas_Prof_result = mysqli_query($conn, $Salas_Prof_query);

              while($dados_Salas_Prof = mysqli_fetch_array($Salas_Prof_result)){

                $Prova_query = "SELECT * FROM ".$dados_Humanas['Disciplina']." WHERE ID_Sala = '".$dados_Salas_Prof['ID_Sala']."'";
                $Prova_result = mysqli_query($conn, $Prova_query);
                $Prova_row = mysqli_num_rows($Prova_result);

                if(!$Prova_result){
                  $_SESSION['mensagem_professor'] = "Erro ao visualizar a prova no banco de dados. Por favor, tente novamente.";
                  header('Location: ../prova.php');
                  exit();
                }      

                while($dados_Prova = mysqli_fetch_array($Prova_result)){
                  $i++;

                  if($i == 1){
                    $Nome_Sala_query = "SELECT * FROM Salas WHERE ID_Sala = '".$dados_Prova['ID_Sala']."'";
                    $Nome_Sala_result = mysqli_query($conn, $Nome_Sala_query);
                    $Nome_Sala = mysqli_fetch_array($Nome_Sala_result);

                    echo "<h2>Prova da sala ".$Nome_Sala['Sala']."</h2>";
                  }

                  echo "<br><br>$i. ".$dados_Prova['Questao'];
                  if($dados_Prova['item1'] !== ""){
                    echo "<br>A) ". $dados_Prova['item1'];
                  }
                  if($dados_Prova['item2'] !== ""){
                    echo "<br>B) ". $dados_Prova['item2'];
                  }
                  if($dados_Prova['item3'] !== ""){
                    echo "<br>C) ". $dados_Prova['item3'];
                  }
                  if($dados_Prova['item4'] !== ""){
                    echo "<br>D) ". $dados_Prova['item4'];
                  }
                  if($dados_Prova['item5'] !== ""){
                    echo "<br>E) ". $dados_Prova['item5'];
                  }
                  if($i == $Prova_row){
                    echo "<br><br><a href='processa.php?ID_Sala=".$dados_Prova['ID_Sala']."'>Apagar prova</a>";
                    $i = 0;
                  }
                }
              }
            }
            if(isset($_SESSION['mensagem_professor'])){
              echo "<h2>".$_SESSION['mensagem_professor']."</h2>";
              unset($_SESSION['mensagem_professor']);
            }
        ?>
        <br><a href="../prova.php">Voltar</a>
    </body>
</html>
