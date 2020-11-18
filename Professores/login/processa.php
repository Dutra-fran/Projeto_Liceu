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

    $Email = mysqli_real_escape_string($conn, $_POST['email']);
    $Senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $Login_query = "SELECT * FROM Professores WHERE Email = '".$Email."' AND Senha = md5('".$Senha."')";
    $Login_result = mysqli_query($conn, $Login_query);
    $Login_row = mysqli_num_rows($Login_result);
    $Login_dados = mysqli_fetch_array($Login_result);

    if($Login_row == 1){
      $_SESSION['usuario'] = $Login_dados['Nome'];
      $_SESSION['id'] = $Login_dados['ID_Professor'];
      $_SESSION['senha'] = $Senha;
      header('Location: ../../painel/painel.php');
      exit();
    } else {
      $_SESSION['mensagem_professor'] = "Email ou senha incorretos!";
      header('Location: ./login.php');
      exit();
    }
?>
