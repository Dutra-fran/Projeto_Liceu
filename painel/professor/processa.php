<?php
    include_once('./verifica_login.php');
    include_once('../../conexao.php');
    
    if(!isset($_SESSION['professor'])){
      $_SESSION['mensagem_professor'] = "Só professores têm acesso à esta página.";
      header('Location: ../painel.php');
      exit();
    }
    
    if(!isset($_POST['contagem'])){
       $_SESSION['mensagem_professor'] = "Por favor, adicione um número de questões que deseja ter na prova!";
       header('Location: ./prova.php');
       exit();
    }

    $_SESSION['cont'] = 1;
    
    $_SESSION['cont'] += $_POST['contagem'];

    $_SESSION['conta'] = $_SESSION['cont'];
    header('Location: ./prova.php');
    exit();
?>