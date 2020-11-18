<?php
    include_once('./verifica_login.php');
    include_once('../../../conexao.php');
    
    if(!isset($_SESSION['acesso'])){
      $_SESSION['mensagem'] = "Só professores têm acesso à esta página.";
      header('Location: ../../painel.php');
      exit();
    }

    $Exatas_query = "SELECT * FROM Exatas WHERE ID_Professor = '".$_SESSION['id']."'";
    $Exatas_result = mysqli_query($conn, $Exatas_query);
    $Exatas_row = mysqli_num_rows($Exatas_result);
    $dados_Exatas = mysqli_fetch_array($Exatas_result);

    $Humanas_query = "SELECT * FROM Humanas WHERE ID_Professor = '".$_SESSION['id']."'";
    $Humanas_result = mysqli_query($conn, $Humanas_query);
    $Humanas_row = mysqli_num_rows($Humanas_result);
    $dados_Humanas = mysqli_fetch_array($Humanas_result);

    if($Exatas_row == 1){
      $Apagar_query = "DELETE FROM ".$dados_Exatas['Disciplina']." WHERE ID_Sala = '".$_GET['ID_Sala']."'";
      $Apagar_result = mysqli_query($conn, $Apagar_query);
    }

    if($Humanas_row == 1){
      $Apagar_query = "DELETE FROM ".$dados_Humanas['Disciplina']." WHERE ID_Sala = '".$_GET['ID_Sala']."'";
      $Apagar_result = mysqli_query($conn, $Apagar_query);
    }

    if(!$Apagar_result){
      $_SESSION['mensagem_professor'] = "Erro ao apagar a prova no banco de dados. Por favor, tente novamente.";
      header('Location: ./prova.php');
      exit();
    } else {
      $_SESSION['mensagem_professor'] = "Prova apagada com sucesso!";
      header('Location: ./prova.php');
      exit();
    }

?>
