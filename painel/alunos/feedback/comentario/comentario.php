<?php
    include_once('../../../../conexao.php');
    include_once('./verifica_login.php');
    
    date_default_timezone_set('America/Fortaleza');
    $date = date("d/m/Y H:i:s");

    $query = "SELECT * FROM Cadastro WHERE ID = '".$_SESSION['id']."'";
    $result_query = mysqli_query($conn, $query);
    $dados = mysqli_fetch_array($result_query);

    $comentario = mysqli_real_escape_string($conn, $_POST['comentario']);
    $comentario_seguro = htmlspecialchars($comentario, ENT_QUOTES);

    if($comentario != ""){
      $insert = "INSERT INTO FeedBack (ID_Cadastro, Comentario, Data, ID_Sala) VALUES ('".$_SESSION['id']."', '".$comentario_seguro."', '".$date."', '".$dados['ID_Sala']."')";
      $result = mysqli_query($conn, $insert);

      if(!$result){
        $_SESSION['comentario'] = "Erro ao inserir o comentário na base de dados!";
        header('Location: ../feedback.php');
        exit();
      } else {
        $_SESSION['comentario'] = "Comentário adicionado com sucesso!";
        header('Location: ../feedback.php');
        exit();
      }
    } else {
      $_SESSION['comentario'] = "Adicione um conteúdo ao seu comentário!";
      header('Location: ../feedback.php');
      exit();
    }