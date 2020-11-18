<?php
    session_start();
    include_once('../../conexao.php');
    
    if(!isset($_SESSION['acesso'])){
      $_SESSION['mensagem_professor'] = "Você não tem autorização para acessar a página solicitada.";
      header('Location: ../index.php');
      exit();
    }
    
    if(empty($_SESSION['nome'])){
      $_SESSION['mensagem_professor'] = "Por favor, coloque o seu nome no campo de nome.";
      header('Location: ./registro.php');
      exit();
    }
    
    if(empty($_SESSION['email'])){
      $_SESSION['mensagem_professor'] = "Por favor, coloque o seu email no campo de email.";
      header('Location: ./registro.php');
      exit();
    }
    
    if(empty($_SESSION['senha'])){
      $_SESSION['mensagem_professor'] = "Por favor, coloque a senha que você deseja ter no campo de senha.";
      header('Location: ./registro.php');
      exit();
    }
    
    if(empty($_SESSION['sala'])){
      $_SESSION['mensagem_professor'] = "Por favor, selecione as salas que você leciona.";
      header('Location: ./registro.php');
    }

    $Disciplina = mysqli_real_escape_string($conn, $_POST['disciplina']);
    $Nome = $_SESSION['nome'];
    $Email = $_SESSION['email'];
    $Senha = $_SESSION['senha'];
    $Materia = $_SESSION['materia'];
    $Salas = $_SESSION['sala'];

    $insercao = "INSERT INTO Professores (Nome, Email, Senha) VALUES ('".$Nome."', '".$Email."', md5('".$Senha."'))";
    $insercao_dados = mysqli_query($conn, $insercao);
    $Query_prof = "SELECT ID_Professor FROM Professores WHERE Email = '".$Email."' AND Senha = md5('".$Senha."')";
    $Prof_result = mysqli_query($conn, $Query_prof);
    $Dados_prof = mysqli_fetch_array($Prof_result);
    $id = $Dados_prof['ID_Professor'];

    if($Materia == 'exatas'){
       $insercao_Materia = "INSERT INTO Exatas (ID_Professor, Disciplina) VALUES ('".$id."', '".$Disciplina."')";
       $Materia_result = mysqli_query($conn, $insercao_Materia);
    }

    if($Materia == 'humanas'){
       $insercao_Materia = "INSERT INTO Humanas (ID_Professor, Disciplina) VALUES ('".$id."', '".$Disciplina."')";
       $Materia_result = mysqli_query($conn, $insercao_Materia);
    }

    foreach($Salas as $key => $Sala){
      $Sala_query = "SELECT * FROM Salas WHERE Sala = '".$Sala."'";
      $Sala_result = mysqli_query($conn, $Sala_query);
      $dados_Sala = mysqli_fetch_array($Sala_result);
      $Prof_Sala_insercao = "INSERT INTO Salas_Prof (ID_Sala, ID_Professor) VALUES ('".$dados_Sala['ID_Sala']."', '".$id."')";
      $Prof_Sala_result = mysqli_query($conn, $Prof_Sala_insercao);
    }

    unset($_SESSION['nome']);
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['materia']);
    unset($_SESSION['sala']);

    if(($insercao_dados === TRUE && $Materia_result === TRUE) && $Prof_Sala_result === TRUE){
      $_SESSION['mensagem_professor'] = "Cadastro concluído com sucesso!";
      header('Location: ./registro.php');
      exit();
    } else {
      $_SESSION['mensagem_professor'] = "Erro ao se cadastrar. Tente novamente mais tarde!";
      header('Location: ./registro.php');
      exit();
    }

?>
