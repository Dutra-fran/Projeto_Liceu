<?php
    include_once('./verifica_login.php');
    include_once('../../../../conexao.php');
    
    $i = 1;
    $nota = 0;
    
    if(isset($_SESSION['count'])){
      $query = "SELECT ID_Sala FROM Cadastro WHERE ID = '".$_SESSION['id']."'";
      $result = mysqli_query($conn, $query);
      $dados = mysqli_fetch_array($result);
      while($i != $_SESSION['count']){
        if(isset($_POST['Q'.$i])){
          $questao = $_POST['Q'.$i];

          $query1 = "INSERT INTO Resposta_Aluno (ID_Cadastro, ID_Sala, Questao, Disciplina) VALUES ('".$_SESSION['id']."', '".$dados['ID_Sala']."', '".$questao."', '".$_SESSION['disciplina']."')";
          $result1 = mysqli_query($conn, $query1);
        }

        $i++;
      }
      if(isset($_GET['Disciplina'])){
        $query2 = "SELECT * FROM Resposta_Aluno WHERE ID_Cadastro = '".$_SESSION['id']."' AND Disciplina = '".$_GET['Disciplina']."'";
        $result2 = mysqli_query($conn, $query2);

        $query3 = "SELECT * FROM Gabarito WHERE ID_Sala = '".$dados['ID_Sala']."' AND Disciplina = '".$_GET['Disciplina']."' ORDER BY ID ASC";
        $result3 = mysqli_query($conn, $query3);

        while(($dados2 = mysqli_fetch_array($result2)) && ($dados3 = mysqli_fetch_array($result3))){
          if($dados2['Questao'] == $dados3['Questao']){
            $nota++;
          }
        }

        $query4 = "INSERT INTO Notas (ID_Cadastro, ID_Sala, Notas, Disciplina) VALUES ('".$_SESSION['id']."', '".$dados['ID_Sala']."', '".$nota."', '".$_GET['Disciplina']."')";
        $result4 = mysqli_query($conn, $query4);
      }
    }

    unset($_SESSION['disciplina']);
    header('Location: ../provas.php');
    exit();
?>