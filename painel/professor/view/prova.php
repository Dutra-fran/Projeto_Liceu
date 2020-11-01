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
            if(!isset($_SESSION['professor'])){
              $_SESSION['mensagem_admin'] = "Só professores têm acesso à esta página.";
              header('Location: ../../painel.php');
              exit();
            }

            $busca = "SELECT * FROM Exatas WHERE ID_Professor = '".$_SESSION['id']."'";
            $resultado = mysqli_query($conn, $busca);
            $row = mysqli_num_rows($resultado);
            $dados = mysqli_fetch_array($resultado);

            $busca1 = "SELECT * FROM Humanas WHERE ID_Professor = '".$_SESSION['id']."'";
            $resultado1 = mysqli_query($conn, $busca1);
            $row1 = mysqli_num_rows($resultado1);
            $dados1 = mysqli_fetch_array($resultado1);

            if($row == 1){

              $busca4 = "SELECT * FROM Salas_Prof WHERE ID_Professor = '".$_SESSION['id']."'";
              $resultado4 = mysqli_query($conn, $busca4);

              while($dadinhos = mysqli_fetch_array($resultado4)){

                $busca2 = "SELECT * FROM ".$dados['Disciplina']." WHERE ID_Sala = '".$dadinhos['ID_Sala']."'";
                $resultado2 = mysqli_query($conn, $busca2);
                $row2 = mysqli_num_rows($resultado2);

                if(!$resultado2){
                  $_SESSION['mensagem_professor'] = "Erro ao visualizar a prova no banco de dados. Por favor, tente novamente.";
                  header('Location: ../prova.php');
                  exit();
                }

                while($dado = mysqli_fetch_array($resultado2)){
                  $i++;

                  if($i == 1){
                    $busca3 = "SELECT * FROM Salas WHERE ID_Sala = '".$dado['ID_Sala']."'";
                    $resultado3 = mysqli_query($conn, $busca3);
                    $dadinho = mysqli_fetch_array($resultado3);

                    echo "<h2>Prova da sala ".$dadinho['Sala']."</h2>";
                  }

                  echo "<br><br>$i. ".$dado['Questao'];
                  if($dado['item1'] !== ""){
                    echo "<br>A) ". $dado['item1'];
                  }
                  if($dado['item2'] !== ""){
                    echo "<br>B) ". $dado['item2'];
                  }
                  if($dado['item3'] !== ""){
                    echo "<br>C) ". $dado['item3'];
                  }
                  if($dado['item4'] !== ""){
                    echo "<br>D) ". $dado['item4'];
                  }
                  if($dado['item5'] !== ""){
                    echo "<br>E) ". $dado['item5'];
                  }

                  if($i == $row2){
                    echo "<br><br><a href='processa.php?ID_Sala=".$dado['ID_Sala']."'>Apagar prova</a>";
                    $i = 0;
                  }
                }
              }
            }

            if($row1 == 1){

              $busca4 = "SELECT * FROM Salas_Prof WHERE ID_Professor = '".$_SESSION['id']."'";
              $resultado4 = mysqli_query($conn, $busca4);

              while($dadinhos = mysqli_fetch_array($resultado4)){

                $busca2 = "SELECT * FROM ".$dados['Disciplina']." WHERE ID_Sala = '".$dadinhos['ID_Sala']."'";
                $resultado2 = mysqli_query($conn, $busca2);
                $row2 = mysqli_num_rows($resultado2);

                if(!$resultado2){
                  $_SESSION['mensagem_professor'] = "Erro ao visualizar a prova no banco de dados. Por favor, tente novamente.";
                  header('Location: ../prova.php');
                  exit();
                }      

                while($dado = mysqli_fetch_array($resultado2)){
                  $i++;

                  if($i == 1){
                    $busca3 = "SELECT * FROM Salas WHERE ID_Sala = '".$dado['ID_Sala']."'";
                    $resultado3 = mysqli_query($conn, $busca3);
                    $dadinho = mysqli_fetch_array($resultado3);

                    echo "<h2>Prova da sala ".$dadinho['Sala']."</h2>";
                  }

                  echo "<br><br>$i. ".$dado['Questao'];
                  if($dado['item1'] !== ""){
                    echo "<br>A) ". $dado['item1'];
                  }
                  if($dado['item2'] !== ""){
                    echo "<br>B) ". $dado['item2'];
                  }
                  if($dado['item3'] !== ""){
                    echo "<br>C) ". $dado['item3'];
                  }
                  if($dado['item4'] !== ""){
                    echo "<br>D) ". $dado['item4'];
                  }
                  if($dado['item5'] !== ""){
                    echo "<br>E) ". $dado['item5'];
                  }
                  if($i == $row2){
                    echo "<br><br><a href='processa.php?ID_Sala=".$dado['ID_Sala']."'>Apagar prova</a>";
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