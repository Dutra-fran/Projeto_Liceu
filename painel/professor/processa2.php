<?php
    include_once('./verifica_login.php');
    include_once('../../conexao.php');
    $i = 0;
    if(!isset($_SESSION['professor'])){
      $_SESSION['mensagem_admin'] = "Só professores têm acesso à esta página.";
      header('Location: ../painel.php');
      exit();
    }

    $x = 0;
    $y = 0;

    if(isset($_SESSION['conta'])){
      if($_SESSION['conta'] > 1){
        $busca = "SELECT * FROM Exatas WHERE ID_Professor = '".$_SESSION['id']."'";
        $resultado = mysqli_query($conn, $busca);
        $row = mysqli_num_rows($resultado);
        $dados = mysqli_fetch_array($resultado);

        $busca1 = "SELECT * FROM Humanas WHERE ID_Professor = '".$_SESSION['id']."'";
        $resultado1 = mysqli_query($conn, $busca1);
        $row1 = mysqli_num_rows($resultado1);
        $dados1 = mysqli_fetch_array($resultado1);
        //echo "$row e $row1";
        while($_SESSION['conta'] > 1){
          $i++;
          $x = $_POST['enunciado'.$i];
          $a = $_POST['itemA'.$i];
          $b = $_POST['itemB'.$i];
          $c = $_POST['itemC'.$i];
          $d = $_POST['itemD'.$i];
          $e = $_POST['itemE'.$i];
          $sala = $_POST['sala'];
          
          if(isset($_POST['enunciado'.$i]) && isset($_POST['sala'])){
            if($row == 1){
              foreach($sala as $key => $salaa){
      
                $busca2 = "INSERT INTO ".$dados['Disciplina']." (Questao, item1, item2, item3, item4, item5, ID_Sala) VALUES ('".$x."', '".$a."', '".$b."', '".$c."', '".$d."', '".$e."', '".$salaa."')";
                $resultado2 = mysqli_query($conn, $busca2);
                if(!$resultado2){
                  $_SESSION['mensagem_professor'] = "Erro ao adicionar a questão no banco de dados. Por favor, tente novamente.";
                  header('Location: ./prova.php');
                  exit();
                }
              }
            }
            if($row1 == 1){
              foreach($sala as $key => $salaa){
                $busca2 = "INSERT INTO ".$dados1['Disciplina']." (Questao, item1, item2, item3, item4, item5, ID_Sala) VALUES ('".$x."', '".$a."', '".$b."', '".$c."', '".$d."', '".$e."', '".$salaa."')";
                $resultado2 = mysqli_query($conn, $busca2);
                if(!$resultado2){
                  $_SESSION['mensagem_professor'] = "Erro ao adicionar a questão no banco de dados. Por favor, tente novamente.";
                  header('Location: ./prova.php');
                  exit();
                }
              }
            }
          }
          $_SESSION['conta']--;
        }
        header('Location: ./prova.php');
        exit();
      }
    }
    
?>