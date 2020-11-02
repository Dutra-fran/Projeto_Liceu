<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Filosofia</title>
        <meta charset="UTF-8" />
        <META HTTP-EQUIV="REFRESH" CONTENT="1800;URL=http://192.168.1.50:8080/painel/alunos/provas/provas.php">
    </head>
    <body>
        <h1>Filosofia</h1>
        <?php
            include_once('../../../../conexao.php');
            include_once('./verifica_login.php');
            $i = 1;
            
            $busca = "SELECT * FROM Cadastro WHERE ID = '".$_SESSION['id']."'";
            $resultado = mysqli_query($conn, $busca);
            $dados = mysqli_fetch_array($resultado);
            
            $busca1 = "SELECT * FROM Filosofia WHERE ID_Sala = '".$dados['ID_Sala']."'";
            $resultado1 = mysqli_query($conn, $busca1);
            $row1 = mysqli_num_rows($resultado1);
            
            if($row1 > 0){
              $_SESSION['disciplina'] = "Filosofia";
            
              $query = "SELECT * FROM Verifica_Prova WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = '".$_SESSION['disciplina']."'";
              $result = mysqli_query($conn, $query);
              $row = mysqli_num_rows($result);
            
              if($row == 0){

                $query1 = "SELECT ID_Sala FROM Cadastro WHERE ID = '".$_SESSION['id']."'";
                $result1 = mysqli_query($conn, $query1);
                $id_sala = mysqli_fetch_array($result1);

                $query2 = "INSERT INTO Verifica_Prova (ID_Cadastro, ID_Sala, Disciplina) VALUES ('".$_SESSION['id']."', '".$id_sala['ID_Sala']."', '".$_SESSION['disciplina']."')";
                $result2 = mysqli_query($conn, $query2);
              } else {
                unset($_SESSION['disciplina']);
                $_SESSION['mensagem_prova'] = "Você já entrou na prova de Filosofia, portanto, não tem mais acesso de entrada para a prova.";
                header('Location: ../provas.php');
                exit();
              }

              echo "<form name='prova' action='processa.php?Disciplina=".$_SESSION['disciplina']."' method='POST' accept-charset='UTF-8'>";
              while($dados1 = mysqli_fetch_array($resultado1)){
                echo "<br><br>$i) ". $dados1['Questao'];

                echo "<label>";
                echo "<br><input type='radio' name='Q".$i."' value='A'>A) ".$dados1['item1'];
                echo "</label>";

                echo "<label>";
                echo "<br><input type='radio' name='Q".$i."' value='B'>B) ".$dados1['item2'];
                echo "</label>";

                if(!empty($dados1['item3'])){
                  echo "<label>";
                  echo "<br><input type='radio' name='Q".$i."' value='C'>C) ".$dados1['item3'];
                  echo "</label>";
                }

                if(!empty($dados1['item4'])){
                  echo "<label>";
                  echo "<br><input type='radio' name='Q".$i."' value='D'>D) ".$dados1['item4'];
                  echo "</label>";
                }

                if(!empty($dados1['item5'])){
                  echo "<label>";
                  echo "<br><input type='radio' name='Q".$i."' value='E'>E) ".$dados1['item5'];
                  echo "</label>";
                }
                $i++;
              }
              echo "<br><br><input type='submit' value='enviar'>";
              echo "</form>";
              $_SESSION['count'] = $i;
            } else {
              echo "<br><br><h2>Prova de Filosofia não está disponível no momento!</h2>";
            }
            
            
        ?>
    </body>
</html>
