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
            
            $query = "SELECT * FROM Salas_Prof WHERE ID_Professor = '".$_SESSION['id']."'";
            $result = mysqli_query($conn, $query);
            
            while($dados = mysqli_fetch_array($result)){
              $query1 = "SELECT * FROM Salas WHERE ID_Sala = '".$dados['ID_Sala']."'";
              $result1 = mysqli_query($conn, $query1);
              $nome_sala = mysqli_fetch_array($result1);

              $query2 = "SELECT * FROM Gabarito WHERE ID_Sala = '".$dados['ID_Sala']."' AND Disciplina = '".$_GET['Disciplina']."' ORDER BY ID ASC";
              $result2 = mysqli_query($conn, $query2);
              $row2 = mysqli_num_rows($result2);

              if($row2 !== 0){
                echo "<h2>Sala: ".$nome_sala['Sala']."</h2>";
                $i = 1;
                while($dados2 = mysqli_fetch_array($result2)){
                  echo $i.") ". $dados2['Questao'] ."<br>";
                  $i++;
                }
                echo "<a href='./processa.php?ID_Sala=".$dados['ID_Sala']."&Disciplina=".$_GET['Disciplina']."'>Apagar</a>";
                echo "<br><br>";
              } else {
                echo "<h2>A prova de ".$_GET['Disciplina']." da sala ".$nome_sala['Sala']." ainda está sem gabarito!</h2>";
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