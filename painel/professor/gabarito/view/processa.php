<?php
    include_once('../../../../conexao.php');
    include_once('./verifica_login.php');
    
    if(isset($_GET['Disciplina']) && isset($_GET['ID_Sala'])){
      $query = "DELETE FROM Gabarito WHERE ID_Sala = '".$_GET['ID_Sala']."' AND Disciplina = '".$_GET['Disciplina']."'";
      $result = mysqli_query($conn, $query);
      if(!$result){
        $_SESSION['mensagem'] = "Erro ao apagar o gabarito! Por favor, tente novamente.";
        header("Location: ./visualizar_gabarito.php?Disciplina=".$_GET['Disciplina']);
        exit();
      } else {
        $_SESSION['mensagem'] = "Gabarito apagado com sucesso!";
        header("Location: ./visualizar_gabarito.php?Disciplina=".$_GET['Disciplina']);
        exit();
      }
    } else {
      header('Location: ../gabarito.php');
      exit();
    }
?>