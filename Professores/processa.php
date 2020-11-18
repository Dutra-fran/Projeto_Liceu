<?php
    session_start();
    include_once('../conexao.php');
    
    if(empty($_POST['senha'])){
      $_SESSION['mensagem_professor'] = "Senha vazia! Por favor, insira a senha de acesso.";
      header('Location: ./index.php');
      exit();
    }
    
    $Senha = mysqli_real_escape_string($conn, $_POST['senha']);
    
    $Acesso_query = "SELECT * FROM Acesso WHERE Senha = md5('".$Senha."')";
    $Acesso_result = mysqli_query($conn, $Acesso_query);
    $Acesso_row = mysqli_num_rows($Acesso_result);

    if($Acesso_row == 1){
      $_SESSION['acesso'] = "Permitido";
      header('Location: ./login/login.php');
      exit();
    } else {
      $_SESSION['mensagem_professor'] = "Acesso negado!";
      header('Location: ./index.php');
      exit();
    }
    ?>
