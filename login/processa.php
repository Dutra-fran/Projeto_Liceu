<?php
    include_once('../conexao.php');
    session_start();
    
    if(empty($_POST['email']) || empty($_POST['senha'])){
      $_SESSION['mensagem_login'] = "Dados em branco! Por favor, preencher os campos em brancos com seus dados para efetuar login.";
      header('Location: ./login.php');
      exit();
    }

    $Email = mysqli_real_escape_string($conn, $_POST['email']);
    $Senha = mysqli_real_escape_string($conn, $_POST['senha']);
  
    $query_Login = "SELECT * FROM Cadastro WHERE Email = '".$Email."' AND Senha = md5('".$Senha."')";
    $Login_result = mysqli_query($conn, $query_Login);
    $dados_Login = mysqli_fetch_array($Login_result);
  
    $row_Login = mysqli_num_rows($Login_result);
  
    if($row_Login == 1){
      $_SESSION['usuario'] = $dados_Login['Nome'];
      $_SESSION['id'] = $dados_Login['ID'];
      $_SESSION['senha'] = $dados_Login['Senha'];
      $_SESSION['aluno'] = "TRUE";
      header('Location: ../painel/painel.php');
      exit();
    } else {
      $_SESSION['mensagem_login'] = "Usuário ou senha incorretos!";
      header('Location: ./login.php');
      exit();
    }
