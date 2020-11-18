<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Prova</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Criar prova</h1>
        <?php
            
            include_once('../../conexao.php');
            include_once('./verifica_login.php');
            
            if(!isset($_SESSION['acesso'])){
              $_SESSION['mensagem'] = "Só professores têm acesso à esta página.";
              header('Location: ../painel.php');
              exit();
            }

            $_SESSION['zero'] = 0;

            if($_SESSION['zero'] == 0 && !isset($_SESSION['contagem'])){
              echo "<h2>Quantas questões deseja colocar na prova?</h2>";
              echo "<form name='contagem' action='processa.php' method='POST' accept-charset='UTF-8'>";
              echo "<input type='text' name='contagem' maxlength='2' placeholder='Digite um número' required>";
              echo "<input type='submit' value='enviar'>";
              echo "</form>";
            }

            $i = 0;
            if(isset($_SESSION['contagem'])){
              echo "<form name='prova' action='processa2.php' method='POST' accept-charset='UTF-8'>";
              while($_SESSION['contagem'] > 1){
                $i++;
                echo "$i. <input type='text' name='enunciado".$i."' size='40' placeholder='Digite o enunciado da questão' required><br>";
                echo "  <input type='text' name='itemA".$i."' size='40' placeholder='Digita o conteúdo que deseja ter neste item.' required><br>";
                echo "  <input type='text' name='itemB".$i."' size='40' placeholder='Digita o conteúdo que deseja ter neste item.' required><br>";
                echo "  <input type='text' name='itemC".$i."' size='40' placeholder='Digita o conteúdo que deseja ter neste item. (opcional)'><br>";
                echo "  <input type='text' name='itemD".$i."' size='40' placeholder='Digita o conteúdo que deseja ter neste item. (opcional)'><br>";
                echo "  <input type='text' name='itemE".$i."' size='40' placeholder='Digita o conteúdo que deseja ter neste item. (opcional)'><br><br>";
                if($_SESSION['contagem'] == 2){
                  $Salas_query = "SELECT Salas_Prof.ID_Sala AS ID_Sala, Salas.Sala AS Sala FROM Salas_Prof INNER JOIN Salas ON Salas_Prof.ID_Sala = Salas.ID_Sala WHERE ID_Professor = '".$_SESSION['id']."'";
                  $Salas_result = mysqli_query($conn, $Salas_query);
                  $Salas_row = mysqli_num_rows($Salas_result);
                  if($Salas_row > 0){
                    echo "<p>Escolha as sala que você deseja deixar disponível a prova.</p>";
                    while($dados_Sala = mysqli_fetch_array($Salas_result)){
                      echo "<br><input type='checkbox' name='sala[]' value='".$dados_Sala['ID_Sala']."'>".$dados_Sala['Sala'];
                    }
                  }
                  echo "<br><input type='submit' value='enviar'>";
                }
                $_SESSION['contagem']--;
              }
              
              echo "</form>";
            }

            if(isset($_SESSION['contagem'])){
              unset($_SESSION['contagem']);
            }
            if(isset($_SESSION['mensagem_professor'])){
              echo "<h2>".$_SESSION['mensagem_professor']."</h2>";
              unset($_SESSION['mensagem_professor']);
            }
        ?>
        
        <br><br>
        <a href="./gabarito/gabarito.php">Gabarito</a><br>
        <a href="./view/prova.php">Visualizar prova</a><br>
        <a href="../painel.php">Voltar</a>
    </body>
</html>
