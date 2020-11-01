<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Professores - Registro</title>
        <meta charset="UTF-8" />
    </head>
    <body>
        <h1>Registro - Professores</h1>
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
            <p>Professor de exatas ou humanas?</p>
            <label><input type="radio" name="materia" value="exatas" checked>exatas</label><br>
            <label><input type="radio" name="materia" value="humanas">Humanas</label><br>
            <br><br>
            <p>Ensina quais salas? (marque somente as salas que você leciona.)</p>
            <label><input type="checkbox" name="sala[]" value="1A">1°A</label><br>
            <label><input type="checkbox" name="sala[]" value="1B">1°B</label><br>
            <label><input type="checkbox" name="sala[]" value="1C">1°C</label><br>
            <label><input type="checkbox" name="sala[]" value="1D">1°D</label><br>
            <label><input type="checkbox" name="sala[]" value="1E">1°E</label><br>
            <label><input type="checkbox" name="sala[]" value="1F">1°F</label><br>
            <label><input type="checkbox" name="sala[]" value="1G">1°G</label><br>
            <label><input type="checkbox" name="sala[]" value="1H">1°H</label><br>
            <label><input type="checkbox" name="sala[]" value="1I">1°I</label><br>
            <label><input type="checkbox" name="sala[]" value="1J">1°J</label><br>
            <label><input type="checkbox" name="sala[]" value="2A">2°A</label><br>
            <label><input type="checkbox" name="sala[]" value="2B">2°B</label><br>
            <label><input type="checkbox" name="sala[]" value="2C">2°C</label><br>
            <label><input type="checkbox" name="sala[]" value="2D">2°D</label><br>
            <label><input type="checkbox" name="sala[]" value="2E">2°E</label><br>
            <label><input type="checkbox" name="sala[]" value="2F">2°F</label><br>
            <label><input type="checkbox" name="sala[]" value="2G">2°G</label><br>
            <label><input type="checkbox" name="sala[]" value="2H">2°H</label><br>
            <label><input type="checkbox" name="sala[]" value="2I">2°I</label><br>
            <label><input type="checkbox" name="sala[]" value="2J">2°J</label><br>
            <label><input type="checkbox" name="sala[]" value="3A">3°A</label><br>
            <label><input type="checkbox" name="sala[]" value="3B">3°B</label><br>
            <label><input type="checkbox" name="sala[]" value="3C">3°C</label><br>
            <label><input type="checkbox" name="sala[]" value="3D">3°D</label><br>
            <label><input type="checkbox" name="sala[]" value="3E">3°E</label><br>
            <label><input type="checkbox" name="sala[]" value="3F">3°F</label><br>
            <label><input type="checkbox" name="sala[]" value="3G">3°G</label><br>
            <label><input type="checkbox" name="sala[]" value="3H">3°H</label><br>
            <label><input type="checkbox" name="sala[]" value="3I">3°I</label><br>
            <label><input type="checkbox" name="sala[]" value="3J">3°J</label><br><br>
            <input type="submit" value="enviar">
        </form><br><br>
        <p>Já tem uma conta? <a href="../login/login.php">Clique aqui</a> para efetuar um login válido!</p>
        
        <br><br><br><br>
        <?php
            session_start();
            include_once('../../conexao.php');
            
            if(!isset($_SESSION['acesso'])){
              $_SESSION['mensagem_professor'] = "Você não tem autorização para acessar a página solicitada.";
              header('Location: ../index.php');
              exit();
            }
            
            if(isset($_SESSION['mensagem_professor'])){
              echo "<h3>".$_SESSION['mensagem_professor']."</h3>";
              unset($_SESSION['mensagem_professor']);
            }
        ?>
    </body>
</html>