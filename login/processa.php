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
    $query3 = "DELETE FROM Status WHERE ID_Cadastro = '".$_SESSION['id']."'";
    $result3 = mysqli_query($conn, $query3);
    $query2 = "INSERT INTO Status (Status, ID_Cadastro) VALUES ('Online', '".$dados['ID']."')";
    $result2 = mysqli_query($conn, $query2);

    if(isset($_SERVER['HTTP_USER_AGENT'])){

      $query6 = "SELECT * FROM Dados WHERE ID_Cadastro = '".$_SESSION['id']."'";
      $result6 = mysqli_query($conn, $query6);
      $row6 = mysqli_num_rows($result6);

      if($row6 == 1){
        $query7 = "DELETE FROM Dados WHERE ID_Cadastro = '".$_SESSION['id']."'";
        $result7 = mysqli_query($conn, $query7);
      }

      if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $query4 = "INSERT INTO Dados (Dados, IP, ID_Cadastro) VALUES ('".$_SERVER['HTTP_USER_AGENT']."', '".$_SERVER['HTTP_X_FORWARDED_FOR']."', '".$_SESSION['id']."')";
        $result4 = mysqli_query($conn, $query4);
      } elseif(isset($_SERVER['REMOTE_ADDR'])){
        $query5 = "INSERT INTO Dados (Dados, IP, ID_Cadastro) VALUES ('".$_SERVER['HTTP_USER_AGENT']."', '".$_SERVER['HTTP_X_FORWARDED_FOR']."', '".$_SESSION['id']."')";
        $result5 = mysqli_query($conn, $query5);
      }
    }
  } else {
    $_SESSION['mensagem_login'] = "Usuário ou senha incorretos!";
    header('Location: ./login.php');
    exit();
  }


  header('Location: ../painel/painel.php');
  exit();