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
  
  $query = "SELECT * FROM Cadastro WHERE Email = '".$Email."' AND Senha = md5('".$Senha."')";
  $result = mysqli_query($conn, $query);
  $dados = mysqli_fetch_array($result);
  $id = $dados['ID'];
  
  $row = mysqli_num_rows($result);
  
  if($row == 1){
    $_SESSION['usuario'] = $dados['Nome'];
    $_SESSION['id'] = $id;
    $_SESSION['senha'] = $dados['Senha'];
    $_SESSION['aluno'] = "TRUE";
    header('Location: ../painel/painel.php');
    exit();
  } else {
    $_SESSION['mensagem_login'] = "Usuário ou senha incorretos!";
    header('Location: ./login.php');
    exit();
  }
