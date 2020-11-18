<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Professores - restrito</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Acesso restrito aos professores!</h1><br><br><br>
        <form name="acesso" action="processa.php" method="POST" accept-charset="UTF-8">
            <label>
                <p>Senha</p>
                <input type="password" name="senha" size="30" maxlength="32" placeholder="Digite a senha de acesso" required>
            </label>
            <input type="submit" value="enviar">
        </form><br><br><br><br>
        
        <?php
            session_start();
            
            if(isset($_SESSION['mensagem_professor'])){
              echo "<h2>".$_SESSION['mensagem_professor']."</h2>";
              unset($_SESSION['mensagem_professor']);
            }
        ?>
    </body>
</html>
