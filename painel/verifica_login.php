<?php
   session_start();
   if(!$_SESSION['usuario']){
     $_SESSION['mensagem_painel'] = "Acesso negado! Efetue uma sessão para obter acesso.";
     header('Location: ../index.php');
     exit();
   }

 ?>