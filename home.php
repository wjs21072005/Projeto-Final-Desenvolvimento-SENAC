<?php

session_start();
$nomeusuario = $_SESSION['nomeusuario'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Metadados e links para estilos e scripts -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>to-do list</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div>
  <ul class="menu">
    <li class="menuloja"><a href="./logout.php">SOME</a></li>
    <?php
    #ABERTO O PHP PARA VALIDAR SE A SESSÃO DO USUARIO ESTÁ ABERTA
    #SE SESSÃO ABERTA, FECHA O PHP PARA USAR ELEMENTOS HTML
    if ($nomeusuario != null) {
    ?>
      <!-- USO DO ELEMNTO COM PHP INTERNO -->
      <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
    <?php
      #ABERTURA DOP ELEMENTO HTML PARA CASO FALSE
    } else {
      echo "<script>window.alert('USUARIO NÃO AUTENTICADO');
           window.location.href='login.php';</script>";
    }
    #FIM DO PHP PARA CONTINUAR MEU HTML
    ?>
    </div>



    <div class="container"> <!-- Contêiner principal -->
      <div class="new-task-container"><!-- Contêiner para adicionar novas tarefas -->
        <input type="text" class="new-task-input" placeholder="Adicione sua tarefa..."><!-- Campo de entrada para nova tarefa -->
        <button class="new-task-button"><i class="fas fa-plus"></i> Adicionar</button>
        <!-- Botão para adicionar nova tarefa -->
      </div>
      <div class="tasks-count">0 tarefas</div>
      <!-- Exibição da contagem de tarefas -->
      <div class="tasks-container"></div>
      <!-- Contêiner para exibir as tarefas -->
    </div>
    <!-- Links para fontes e scripts -->
    <script src="https://kit.fontawesome.com/b54c6d5ad9.js" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>

</html>