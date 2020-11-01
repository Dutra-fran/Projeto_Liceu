<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Alunos - Login</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Login - Alunos</h1>
        <form name="login" action="processa.php" method="POST" accept-charset="UTF-8">
            <label>
                <p>Email:</p>
                <input type="text" name="email" maxlength="300" size="30" placeholder="Digite seu email" required>
            </label>
            <label>
                <p>Senha:</p>
                <input type="password" name="senha" maxlength="32" size="30" placeholder="Digite sua senha" required>
            </label><br><br>
            <input type="submit" value="enviar">
        </form><br><br>
        <p>Ainda não está cadastrado? <a href="../registro/registrar.php">Clique aqui</a> para efetuar um registro válido!</p>
        <br><button><a href="../index.php">Voltar</a></button>

        <br><br><br><br>
        <?php
            session_start();
            include_once('../../conexao.php');
            
            if(isset($_SESSION['mensagem_login'])){
              echo "<h2>".$_SESSION['mensagem_login']."</h2>";
              unset($_SESSION['mensagem_login']);
            }
        ?>
    </body>
</html>