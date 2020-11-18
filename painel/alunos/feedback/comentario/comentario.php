<?php
    include_once('../../../../conexao.php');
    include_once('./verifica_login.php');
    
    date_default_timezone_set('America/Fortaleza');
    $data = date("d/m/Y H:i:s");

    $Dados_Aluno_query = "SELECT * FROM Cadastro WHERE ID = '".$_SESSION['id']."'";
    $Dados_Aluno_result = mysqli_query($conn, $Dados_Aluno_query);
    $dados_Aluno = mysqli_fetch_array($Dados_Aluno_result);

    $comentario = mysqli_real_escape_string($conn, $_POST['comentario']);
    $comentario_seguro = htmlspecialchars($comentario, ENT_QUOTES);

    if($comentario != ""){
      $Comentario_insercao = "INSERT INTO FeedBack (ID_Cadastro, Comentario, Data, ID_Sala) VALUES ('".$_SESSION['id']."', '".$comentario_seguro."', '".$data."', '".$dados_Aluno['ID_Sala']."')";
      $Comentario_result = mysqli_query($conn, $Comentario_insercao);

      if(!$Comentario_result){
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
