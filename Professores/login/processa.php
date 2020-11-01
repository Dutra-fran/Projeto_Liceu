<?php
    session_start();
    include_once('../../conexao.php');
    
    if(!isset($_SESSION['acesso'])){
      $_SESSION['mensagem_professor'] = "Você não tem autorização para acessar a página solicitada.";
      header('Location: ../index.php');
      exit();
    }
    
    if(empty($_POST['email']) || empty($_POST['senha'])){
      $_SESSION['mensagem_professor']= "Email ou seja estão em branco. Por favor, inserir os dados correspondentes nos campos em branco";
      header('Location: ./login.php');
      exit();
    }

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $query = "SELECT * FROM Professores WHERE Email = '".$email."' AND Senha = md5('".$senha."')";
    $result = mysqli_query($conn, $query);
    $row = mysqli_num_rows($result);
    $dados = mysqli_fetch_array($result);
    $id = $dados['ID_Professor'];

    if($row == 1){
      $_SESSION['usuario'] = $dados['Nome'];
      $_SESSION['id'] = $id;
      $_SESSION['senha'] = $senha;
      header('Location: ../../painel/painel.php');
      exit();
    } else {
      $_SESSION['mensagem_professor'] = "Email ou senha incorretos!";
      header('Location: ./login.php');
      exit();
    }
?>