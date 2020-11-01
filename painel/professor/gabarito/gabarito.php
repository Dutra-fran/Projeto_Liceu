<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Gabarito</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Gabarito das provas</h1>
        <?php
            include_once('../../../conexao.php');
            include_once('./verifica_login.php');
            $i = 1;
            
            $query_Salas = "SELECT * FROM Salas_Prof WHERE ID_Professor = '".$_SESSION['id']."'";
            $Salas_result = mysqli_query($conn, $query_Salas);
            $row_Salas = mysqli_num_rows($Salas_result);
            
            $query_exatas = "SELECT * FROM Exatas WHERE ID_Professor = '".$_SESSION['id']."'";
            $exatas_result = mysqli_query($conn, $query_exatas);
            $row_exatas = mysqli_num_rows($exatas_result);
            
            $query_humanas = "SELECT * FROM Humanas WHERE ID_Professor = '".$_SESSION['id']."'";
            $humanas_result = mysqli_query($conn, $query_humanas);
            $row_humanas = mysqli_num_rows($humanas_result);
            
            if($row_exatas == 1){
              $dados_exatas = mysqli_fetch_array($exatas_result);

              while($dados_Salas = mysqli_fetch_array($Salas_result)){
                $query_prova = "SELECT * FROM ".$dados_exatas['Disciplina']." WHERE ID_Sala = '".$dados_Salas['ID_Sala']."'";
                $prova_result = mysqli_query($conn, $query_prova);
                $row_prova = mysqli_num_rows($prova_result);
                if($row_prova > 0){
                  $query_Sala_Nome = "SELECT * FROM Salas WHERE ID_Sala = '".$dados_Salas['ID_Sala']."'";
                  $Sala_Nome_result = mysqli_query($conn, $query_Sala_Nome);
                  $Nome_Sala = mysqli_fetch_array($Sala_Nome_result);

                  echo "<h1>".$Nome_Sala['Sala']."</h1>";
                  echo "<form name='gabarito".$dados_Salas['ID_Sala']."' action='processa.php?ID_Sala=".$dados_Salas['ID_Sala']."&Disciplina=".$dados_exatas['Disciplina']."' method='POST' accept-charset='UTF-8'>";
                  while($row_prova > 0){

                    echo "<br>".$i.") Escolha o item certo para o gabarito dessa questão de número ".$i.":";

                    echo "<label>";
                    echo "<br><input type='radio' name='Q".$i."' value='A' checked>A)";
                    echo "</label>";

                    echo "<label>";
                    echo "<br><input type='radio' name='Q".$i."' value='B'>B)";
                    echo "</label>";

                    echo "<label>";
                    echo "<br><input type='radio' name='Q".$i."' value='C'>C)";
                    echo "</label>";

                    echo "<label>";
                    echo "<br><input type='radio' name='Q".$i."' value='D'>D)";
                    echo "</label>";

                    echo "<label>";
                    echo "<br><input type='radio' name='Q".$i."' value='E'>E)";
                    echo "</label>";

                    $row_prova--;
                    $i++;

                    if($row_prova == 0){
                      $i = 1;

                      echo "<br><br><input type='submit' value='enviar'>";
                    }
                  }
                  echo "</form>";
                }
              }
              echo "<br><br>";
              echo "<a href='./view/visualizar_gabarito.php?Disciplina=".$dados_exatas['Disciplina']."'>Visualizar Gabaritos</a><br>";
            }

            if($row_humanas == 1){
              $dados_humanas = mysqli_fetch_array($humanas_result);

              while($dados_Salas = mysqli_fetch_array($Salas_result)){
                $query_prova = "SELECT * FROM ".$dados_humanas['Disciplina']." WHERE ID_Sala = '".$dados_Salas['ID_Sala']."'";
                $prova_result = mysqli_query($conn, $query_prova);
                $row_prova = mysqli_num_rows($prova_result);
                if($row_prova > 0){
                  $query_Sala_Nome = "SELECT * FROM Salas WHERE ID_Sala = '".$dados_Salas['ID_Sala']."'";
                  $Sala_Nome_result = mysqli_query($conn, $query_Sala_Nome);
                  $Nome_Sala = mysqli_fetch_array($Sala_Nome_result);

                  echo "<h1>".$Nome_Sala['Sala']."</h1>";
                  echo "<form name='gabarito".$dados_Salas['ID_Sala']."' action='processa.php?ID_Sala=".$dados_Salas['ID_Sala']."&Disciplina=".$dados_humanas['Disciplina']."' method='POST' accept-charset='UTF-8'>";
                  while($row_prova > 0){

                    echo "<br>".$i.") Escolha o item certo para o gabarito dessa questão de número ".$i.":";

                    echo "<label>";
                    echo "<br><input type='radio' name='Q".$i."' value='A' checked>A)";
                    echo "</label>";

                    echo "<label>";
                    echo "<br><input type='radio' name='Q".$i."' value='B'>B)";
                    echo "</label>";

                    echo "<label>";
                    echo "<br><input type='radio' name='Q".$i."' value='C'>C)";
                    echo "</label>";

                    echo "<label>";
                    echo "<br><input type='radio' name='Q".$i."' value='D'>D)";
                    echo "</label>";

                    echo "<label>";
                    echo "<br><input type='radio' name='Q".$i."' value='E'>E)";
                    echo "</label>";

                    $row_prova--;
                    $i++;

                    if($row_prova == 0){
                      $i = 1;

                      echo "<br><br><input type='submit' value='enviar'>";
                    }
                  }
                  echo "</form>";
                }
              }
              echo "<br><br>";
              echo "<a href='./view/visualizar_gabarito.php?Disciplina=".$dados_humanas['Disciplina']."'>Visualizar Gabaritos</a><br>";
            }

            if(isset($_SESSION['Mensagem_Gabarito'])){
              echo "<br><h2>".$_SESSION['Mensagem_Gabarito']."</h2>";
              unset($_SESSION['Mensagem_Gabarito']);
            }
        ?>
        <a href="../prova.php">Voltar</a>
    </body>
</html>