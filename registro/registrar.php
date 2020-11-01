<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Alunos - Registro</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Registro - Alunos</h1>
        <form name="registro" action="processa.php" method="POST" accept-charset="UTF-8">
            <label>
                <p>Nome:</p>
                <input type="text" name="nome" maxlength="300" size="30" placeholder="Digite seu nome" required>
            </label>
            <label>
                <p>Email:</p>
                <input type="text" name="email" maxlength="300" size="30" placeholder="Digite seu email" required>
            </label>
            <label>
                <p>Senha:</p>
                <input type="password" name="senha" maxlength="32" size="30" placeholder="Digite sua senha" required>
            </label><br><br>
            <p>Você está em exatas ou humanas?</p>
            <label><input type="radio" name="materia" value="1" checked>exatas</label><br>
            <label><input type="radio" name="materia" value="2">Humanas</label><br>
            <br><br>
            <p>Você é de qual sala?</p>
            <label><input type="radio" name="sala" value="1" checked>1°A</label><br>
            <label><input type="radio" name="sala" value="2">1°B</label><br>
            <label><input type="radio" name="sala" value="3">1°C</label><br>
            <label><input type="radio" name="sala" value="4">1°D</label><br>
            <label><input type="radio" name="sala" value="5">1°E</label><br>
            <label><input type="radio" name="sala" value="6">1°F</label><br>
            <label><input type="radio" name="sala" value="7">1°G</label><br>
            <label><input type="radio" name="sala" value="8">1°H</label><br>
            <label><input type="radio" name="sala" value="9">1°I</label><br>
            <label><input type="radio" name="sala" value="10">1°J</label><br>
            <label><input type="radio" name="sala" value="11">2°A</label><br>
            <label><input type="radio" name="sala" value="12">2°B</label><br>
            <label><input type="radio" name="sala" value="13">2°C</label><br>
            <label><input type="radio" name="sala" value="14">2°D</label><br>
            <label><input type="radio" name="sala" value="15">2°E</label><br>
            <label><input type="radio" name="sala" value="16">2°F</label><br>
            <label><input type="radio" name="sala" value="17">2°G</label><br>
            <label><input type="radio" name="sala" value="18">2°H</label><br>
            <label><input type="radio" name="sala" value="19">2°I</label><br>
            <label><input type="radio" name="sala" value="20">2°J</label><br>
            <label><input type="radio" name="sala" value="21">3°A</label><br>
            <label><input type="radio" name="sala" value="22">3°B</label><br>
            <label><input type="radio" name="sala" value="23">3°C</label><br>
            <label><input type="radio" name="sala" value="24">3°D</label><br>
            <label><input type="radio" name="sala" value="25">3°E</label><br>
            <label><input type="radio" name="sala" value="26">3°F</label><br>
            <label><input type="radio" name="sala" value="27">3°G</label><br>
            <label><input type="radio" name="sala" value="28">3°H</label><br>
            <label><input type="radio" name="sala" value="29">3°I</label><br>
            <label><input type="radio" name="sala" value="30">3°J</label><br><br>
            <input type="submit" value="enviar">
        </form><br><br>
        <p>Já tem uma conta? <a href="../login/login.php">Clique aqui</a> para efetuar um login válido!</p>
        
        <br><br><br><br>
        <?php
            session_start();
            include_once('../../conexao.php');
            
            if(isset($_SESSION['mensagem_registro'])){
              echo "<h3>".$_SESSION['mensagem_registro']."</h3>";
              unset($_SESSION['mensagem_registro']);
            }
        ?>
    </body>
</html>