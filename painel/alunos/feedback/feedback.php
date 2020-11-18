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
            $Comentario_query = "SELECT Cadastro.Nome AS Nome, FeedBack.Comentario AS Comentario, FeedBack.Data AS Data, FeedBack.ID_Comentario AS ID FROM Cadastro INNER JOIN FeedBack ON Cadastro.ID = FeedBack.ID_Cadastro ORDER BY ID DESC"; 
            $Comentario_result = mysqli_query($conn, $Comentario_query);
            $Comentario_row = mysqli_num_rows($Comentario_result);
            if($Comentario_row == 0){
              echo "Nenhum comentário!";
            } else { 
              while($dados_Comentarios = mysqli_fetch_array($Comentario_result)){
                if($dados_Comentarios['Nome'] == $_SESSION['usuario']){
                  echo "<p>".$dados_Comentarios['Nome']." | ".$dados_Comentarios['Data']."<br>Comentário: ".$dados_Comentarios['Comentario']."<br>"
                  ."<a href='./comentario/deletar_comment.php?ID=".$dados_Comentarios['ID']."'>Apagar</a></p>";
                } else {
                  echo "<p>".$dados_Comentarios['Nome']." | ".$dados_Comentarios['Data']."<br>Comentário: ".$dados_Comentarios['Comentario']."</p><br>";
                }
                echo "<br><br><br>";
              }
            }  
        ?>
    </body>
</html>
