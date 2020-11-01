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

    $disciplina = mysqli_real_escape_string($conn, $_POST['disciplina']);
    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];
    $senha = $_SESSION['senha'];
    $materia = $_SESSION['materia'];
    $sala = $_SESSION['sala'];

    $query = "INSERT INTO Professores (Nome, Email, Senha) VALUES ('".$nome."', '".$email."', md5('".$senha."'))";
    $result = mysqli_query($conn, $query);
    $query2 = "SELECT ID_Professor FROM Professores WHERE Email = '".$email."' AND Senha = md5('".$senha."')";
    $result2 = mysqli_query($conn, $query2);
    $dado = mysqli_fetch_array($result2);
    $id = $dado['ID_Professor'];

    if($materia == 'exatas'){
       $query3 = "INSERT INTO Exatas (ID_Professor, Disciplina) VALUES ('".$id."', '".$disciplina."')";
       $result3 = mysqli_query($conn, $query3);
    }

    if($materia == 'humanas'){
       $query3 = "INSERT INTO Humanas (ID_Professor, Disciplina) VALUES ('".$id."', '".$disciplina."')";
       $result3 = mysqli_query($conn, $query3);
    }
    foreach($sala as $key => $salaa){
      $query4 = "SELECT * FROM Salas WHERE Sala = '".$salaa."'";
      $result4 = mysqli_query($conn, $query4);
      $dados = mysqli_fetch_array($result4);
      $query5 = "INSERT INTO Salas_Prof (ID_Sala, ID_Professor) VALUES ('".$dados['ID_Sala']."', '".$id."')";
      $result5 = mysqli_query($conn, $query5);
    }

    unset($_SESSION['nome']);
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['materia']);
    unset($_SESSION['sala']);

    if(($result === TRUE && $result3 === TRUE) && $result5 === TRUE){
      $_SESSION['mensagem_professor'] = "Cadastro concluído com sucesso!";
      header('Location: ./registro.php');
      exit();
    } else {
      $_SESSION['mensagem_professor'] = "Erro ao se cadastrar. Tente novamente mais tarde!";
      header('Location: ./registro.php');
      exit();
    }

?>