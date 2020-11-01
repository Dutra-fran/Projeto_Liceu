<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Feedback</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Feedback</h1>
        <a href="../../painel.php">Voltar</a>
        
        <br><br>
        <form action="./comentario/comentario.php" method="POST" accept-charset="UTF-8">
            <label>
                <p>Comentário</p>
                <?php
                    if(isset($_SESSION['comentario'])){
                      echo $_SESSION['comentario']."<br>";
                      unset($_SESSION['comentario']);
                    } 
                ?>
                <input type="text" name="comentario" size="40" placeholder="Digite seu comentário">
            </label>
            <input type="submit" value="enviar">
        </form><br>
        <hr></hr>
        <?php
            include_once('./verifica_login.php');
            include_once('../../../conexao.php');
            $query = "SELECT Cadastro.Nome AS Nome, FeedBack.Comentario AS Comentario, FeedBack.Data AS Data, FeedBack.ID_Comentario AS ID FROM Cadastro INNER JOIN FeedBack ON Cadastro.ID = FeedBack.ID_Cadastro ORDER BY ID DESC"; 
            $result = mysqli_query($conn, $query);
            $row_result = mysqli_num_rows($result);
            if($row_result == 0){
              echo "Nenhum comentário!";
            } else { 
              while($comment = mysqli_fetch_array($result)){
                if($comment['Nome'] == $_SESSION['usuario']){
                  echo "<p>".$comment['Nome']." | ".$comment['Data']."<br>Comentário: ".$comment['Comentario']."<br>"
                  ."<a href='./comentario/deletar_comment.php?ID=".$comment['ID']."'>Apagar</a></p>";
                } else {
                  echo "<p>".$comment['Nome']." | ".$comment['Data']."<br>Comentário: ".$comment['Comentario']."</p><br>";
                }
                echo "<br><br><br>";
              }
            }  
        ?>
    </body>
</html>