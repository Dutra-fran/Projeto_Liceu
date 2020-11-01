<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <title>Site de testes</title>
      <meta charset="UTF-8" />
   </head>
   <body>
      <h1>Testes</h1>
      <p>Olá! Para testar os demais recursos disponíveis no site para teste é necessário fazer um registro e logo após efetuar o login.</p>
		
      <ul>
         <li><a href="./login/login.php">Login</a></li>
         <li><a href="./registro/registrar.php">Registrar</a></li>
      </ul>
		
      <?php
         session_start();
				
         if(isset($_SESSION['mensagem_painel'])){
            echo "<h2>".$_SESSION['mensagem_painel']."</h2><br><br>";
            unset($_SESSION['mensagem_painel']);
         }
      ?>
   </body>
</html>
