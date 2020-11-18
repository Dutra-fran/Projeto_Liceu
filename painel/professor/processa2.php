<?php
    include_once('./verifica_login.php');
    include_once('../../conexao.php');
    $i = 0;
    if(!isset($_SESSION['acesso'])){
      $_SESSION['mensagem'] = "Só professores têm acesso à esta página.";
      header('Location: ../painel.php');
      exit();
    }

    if(isset($_SESSION['questoes'])){
      if($_SESSION['questoes'] > 1){
        $Exatas_query = "SELECT * FROM Exatas WHERE ID_Professor = '".$_SESSION['id']."'";
        $Exatas_result = mysqli_query($conn, $Exatas_query);
        $Exatas_row = mysqli_num_rows($Exatas_result);
        $dados_Exatas = mysqli_fetch_array($Exatas_result);

        $Humanas_query = "SELECT * FROM Humanas WHERE ID_Professor = '".$_SESSION['id']."'";
        $Humanas_result = mysqli_query($conn, $Humanas_query);
        $Humanas_row = mysqli_num_rows($Humanas_result);
        $dados_Humanas = mysqli_fetch_array($Humanas_result);

        while($_SESSION['questoes'] >= 1){
          $i++;
          $Questao = $_POST['enunciado'.$i];
          $itemA = $_POST['itemA'.$i];
          $itemB = $_POST['itemB'.$i];
          $itemC = $_POST['itemC'.$i];
          $itemD = $_POST['itemD'.$i];
          $itemE = $_POST['itemE'.$i];
          $Salas = $_POST['sala'];
          
          if(isset($_POST['enunciado'.$i]) && isset($_POST['sala'])){
            if($Exatas_row == 1){
              foreach($Salas as $key => $Sala){
                $insercao_Questao_query = "INSERT INTO ".$dados_Exatas['Disciplina']." (Questao, item1, item2, item3, item4, item5, ID_Sala) VALUES ('".$Questao."', '".$itemA."', '".$itemB."', '".$itemC."', '".$itemD."', '".$itemE."', '".$Sala."')";
                $insercao_Questao_result = mysqli_query($conn, $insercao_Questao_query);
                if(!$insercao_Questao_result){
                  $_SESSION['mensagem_professor'] = "Erro ao adicionar a questão no banco de dados. Por favor, tente novamente.";
                  header('Location: ./prova.php');
                  exit();
                }
              }
            }
            if($Humanas_row == 1){
              foreach($Salas as $key => $Sala){
                $insercao_Questao_query = "INSERT INTO ".$dados_Humanas['Disciplina']." (Questao, item1, item2, item3, item4, item5, ID_Sala) VALUES ('".$Questao."', '".$itemA."', '".$itemB."', '".$itemC."', '".$itemD."', '".$itemE."', '".$Sala."')";
                $insercao_Questao_result = mysqli_query($conn, $insercao_Questao_query);
                if(!$insercao_Questao_result){
                  $_SESSION['mensagem_professor'] = "Erro ao adicionar a questão no banco de dados. Por favor, tente novamente.";
                  header('Location: ./prova.php');
                  exit();
                }
              }
            }
          }
          $_SESSION['questoes']--;
        }
      }
      header('Location: ./prova.php');
      exit();
    } else {

    }
    
?>
