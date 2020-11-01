<?php
   session_start();
   include_once('../conexao.php');
   $sql_code1 = "SELECT * FROM Cadastro WHERE Usuario = '".$_SESSION['usuario']."' AND ID = '".$_SESSION['id']."'";
   $result_code1 = mysqli_query($conn, $sql_code1);
   $verifica1 = mysqli_num_rows($result_code1);
   if($verifica1 == 1){
     $sql_code = "DELETE FROM Status WHERE ID_Cadastro = '".$_SESSION['id']."'";
     $result_code = mysqli_query($conn, $sql_code);
     $sql_code2 = "INSERT INTO Status (Status, ID_Cadastro) VALUES ('Offline', '".$_SESSION['id']."')";
     $result_code2 = mysqli_query($conn, $sql_code2);
   }
   session_destroy();
   header('Location: ../index.php');
   exit();
 ?>