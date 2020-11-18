<?php
    include_once('../../../../conexao.php');
    include_once('./verifica_login.php');
    
    $Apagar_Comentario_query = "DELETE FROM FeedBack WHERE ID_Comentario = ".$_GET['ID'];
    $Apagar_Comentario_result = mysqli_query($conn, $Apagar_Comentario_query);
    
    if(!$Apagar_Comentario_result){
      $_SESSION['comentario'] = "Exclusão do comentário mal sucedida!";
      header('Location: ../feedback.php');
      exit();
    } else {
      $_SESSION['comentario'] = "Comentário excluído com sucesso!";
      header('Location: ../feedback.php');
      exit();
    }
