<?php
    include_once('../../../conexao.php');
    include_once('./verifica_login.php');
    $i = 1;
    
    while($i <= 10){
      if(isset($_POST['Q'.$i])){
        $query_Q = "INSERT INTO Gabarito (ID_Sala, Questao, Disciplina) VALUES ('".$_GET['ID_Sala']."', '".$_POST['Q'.$i]."', '".$_GET['Disciplina']."')";
        $Q_result = mysqli_query($conn, $query_Q);

        if(!$Q_result){
          $_SESSION['Mensagem_Gabarito'] = "Erro ao gravar os dados no banco de dados! Por favor, tente novamente.";
          header('Location: ./gabarito.php');
          exit();
        }
      }
      $i++;
    }
    $_SESSION['Mensagem_Gabarito'] = "Gabarito gravado com sucesso na base de dados!";
    header('Location: ./gabarito.php');
    exit();
?>