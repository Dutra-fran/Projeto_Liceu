<?php
    session_start();
    include_once('../../conexao.php');
    
    if(!isset($_SESSION['acesso'])){
      $_SESSION['mensagem_professor'] = "Você não tem autorização para acessar a página solicitada.";
      header('Location: ../index.php');
      exit();
    }
      
    if(empty($_POST['nome'])){
      $_SESSION['mensagem_professor'] = "Por favor, coloque o seu nome no campo de nome.";
      header('Location: ./registro.php');
      exit();
    }
    
    if(empty($_POST['email'])){
      $_SESSION['mensagem_professor'] = "Por favor, coloque o seu email no campo de email.";
      header('Location: ./registro.php');
      exit();
    }
    
    if(empty($_POST['senha'])){
      $_SESSION['mensagem_professor'] = "Por favor, coloque a senha que você deseja ter no campo de senha.";
      header('Location: ./registro.php');
      exit();
    }
    
    if(empty($_POST['sala'])){
      $_SESSION['mensagem_professor'] = "Por favor, selecione as salas que você leciona.";
      header('Location: ./registro.php');
    }

    $Nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $Email = mysqli_real_escape_string($conn, $_POST['email']);
    $Senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $Materia = mysqli_real_escape_string($conn, $_POST['materia']);
    $Salas = $_POST['sala'];

    if($Materia == 'exatas'){
      echo "<h1>Olá, ".$Nome.". Você é professor de exatas!</h1>";
      echo "<p>Selecione abaixo a matéria que você ensina.</p>";
      echo "<form name='disciplina' action='processa2.php' method='POST' accept-charset='UTF-8'>";
      echo "<label><input type='radio' name='disciplina' value='Matematica' checked>Matemática</label><br>";
      echo "<label><input type='radio' name='disciplina' value='Fisica'>Física</label><br>";
      echo "<label><input type='radio' name='disciplina' value='Quimica'>Química</label><br>";
      echo "<label><input type='radio' name='disciplina' value='Biologia'>Biologia</label><br>";
      echo "<label><input type='radio' name='disciplina' value='EdFisica'>Educação física</label><br><br>";
      echo "<input type='submit' value='enviar'>";
      echo "</form>";
    }

    if($Materia == 'humanas'){
      echo "<h1>Olá, ".$Nome.". Você é professor de Humanas!</h1>";
      echo "<p>Selecione abaixo a matéria que você ensina.</p>";
      echo "<form name='disciplina' action='processa2.php' method='POST' accept-charset='UTF-8'>";
      echo "<label><input type='radio' name='disciplina' value='Portugues' checked>Português</label><br>";
      echo "<label><input type='radio' name='disciplina' value='Historia'>História</label><br>";
      echo "<label><input type='radio' name='disciplina' value='Geografia'>Geografia</label><br>";
      echo "<label><input type='radio' name='disciplina' value='Sociologia'>Sociologia</label><br>";
      echo "<label><input type='radio' name='disciplina' value='Filosofia'>Filosofia</label><br>";
      echo "<label><input type='radio' name='disciplina' value='Ingles'>Ingles</label><br><br>";
      echo "<input type='submit' value='enviar'>";
      echo "</form>";
    }

    $_SESSION['nome'] = $Nome;
    $_SESSION['email'] = $Email;
    $_SESSION['senha'] = $Senha;
    $_SESSION['materia'] = $Materia;
    $_SESSION['sala'] = $Salas;

?>
