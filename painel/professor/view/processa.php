<?php
    include_once('./verifica_login.php');
    include_once('../../../conexao.php');
    
    if(!isset($_SESSION['professor'])){
      $_SESSION['mensagem_admin'] = "Só professores têm acesso à esta página.";
      header('Location: ../../painel.php');
      exit();
    }
    $busca = "SELECT * FROM Exatas WHERE ID_Professor = '".$_SESSION['id']."'";
    $resultado = mysqli_query($conn, $busca);
    $row = mysqli_num_rows($resultado);
    $dados = mysqli_fetch_array($resultado);

    $busca1 = "SELECT * FROM Humanas WHERE ID_Professor = '".$_SESSION['id']."'";
    $resultado1 = mysqli_query($conn, $busca1);
    $row1 = mysqli_num_rows($resultado1);
    $dados1 = mysqli_fetch_array($resultado1);

    if($row == 1){
      $busca3 = "DELETE FROM ".$dados['Disciplina']." WHERE ID_Sala = '".$_GET['ID_Sala']."'";
      $resultado3 = mysqli_query($conn, $busca3);
    }

    if($row1 == 1){
      $busca3 = "DELETE FROM ".$dados1['Disciplina']." WHERE ID_Sala = '".$_GET['ID_Sala']."'";
      $resultado3 = mysqli_query($conn, $busca3);
    }

    if(!$resultado3){
      $_SESSION['mensagem_professor'] = "Erro ao apagar a prova no banco de dados. Por favor, tente novamente.";
      header('Location: ./prova.php');
      exit();
    } else {
      $_SESSION['mensagem_professor'] = "Prova apagada com sucesso!";
      header('Location: ./prova.php');
      exit();
    }

?>