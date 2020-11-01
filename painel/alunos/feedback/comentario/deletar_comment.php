<?php
    include_once('../../../../conexao.php');
    include_once('./verifica_login.php');
    
    $query = "DELETE FROM FeedBack WHERE ID_Comentario = ".$_GET['ID'];
    $result = mysqli_query($conn, $query);
    
    if(!$result){
      $_SESSION['comentario'] = "Exclusão do comentário mal sucedida!";
      header('Location: ../feedback.php');
      exit();
    } else {
      $_SESSION['comentario'] = "Comentário excluído com sucesso!";
      header('Location: ../feedback.php');
      exit();
    }