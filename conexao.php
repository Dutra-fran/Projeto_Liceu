<?php
    $servidor = "localhost";
    $user = "root";
    $password = "";
    $db_name = "Projeto_Escola";
    
    $conn = mysqli_connect($servidor, $user, $password, $db_name);
    
    if(!$conn){
      die("Erro ao se conectar na base de dados!");
    }