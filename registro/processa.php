<?php
    include_once('../conexao.php');
    session_start();
    
    if((empty($_POST['nome']) || empty($_POST['senha'])) || empty($_POST['email'])){
      $_SESSION['mensagem_registro'] = "Por favor, insira todos os dados!";
      header('Location: ./registrar.php');
      exit();
    }

    $Nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $Email = mysqli_real_escape_string($conn, $_POST['email']);
    $Senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $Materia = mysqli_real_escape_string($conn, $_POST['materia']);
    $Sala = mysqli_real_escape_string($conn, $_POST['sala']);

    if($Materia == 1){
      $insercao = "INSERT INTO Cadastro (Nome, ID_Sala, ID_Exatas, Email, Senha) VALUES ('".$Nome."', '".$Sala."', '".$Materia."', '".$Email."', md5('".$Senha."'))";
      $insercao_dados = mysqli_query($conn, $insercao);
    }

    if($Materia == 2){
      $insercao = "INSERT INTO Cadastro (Nome, ID_Sala, ID_Humanas, Email, Senha) VALUES ('".$Nome."', '".$Sala."', '".$Materia."', '".$Email."', md5('".$Senha."'))";
      $insercao_dados = mysqli_query($conn, $insercao);
    }
    
    if(!$insercao_dados){
      $_SESSION['mensagem_registro'] = "Erro ao inserir os dados no banco de dados!";
      header('Location: ./registrar.php');
      exit();
    }

    $_SESSION['mensagem_registro'] = "Cadastro efetuado com sucesso!";
    header('Location: ./registrar.php');
    exit();
