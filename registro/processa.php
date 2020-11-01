<?php
    include_once('../conexao.php');
    session_start();
    
    if((empty($_POST['nome']) || empty($_POST['senha'])) || empty($_POST['email'])){
      $_SESSION['mensagem_registro'] = "Por favor, insira todos os dados!";
      header('Location: ./registrar.php');
      exit();
    }

    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $materia = mysqli_real_escape_string($conn, $_POST['materia']);
    $sala = mysqli_real_escape_string($conn, $_POST['sala']);

    if($materia == 1){
      $insercao = "INSERT INTO Cadastro (Nome, ID_Sala, ID_Exatas, Email, Senha) VALUES ('".$nome."', '".$sala."', '".$materia."', '".$email."', md5('".$senha."'))";
      $insercao_dados = mysqli_query($conn, $insercao);
    }

    if($materia == 2){
      $insercao = "INSERT INTO Cadastro (Nome, ID_Sala, ID_Humanas, Email, Senha) VALUES ('".$nome."', '".$sala."', '".$materia."', '".$email."', md5('".$senha."'))";
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