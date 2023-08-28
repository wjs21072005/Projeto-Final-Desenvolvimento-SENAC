<?php
#ABRE UMA VARIAVEL SESSÃO
session_start();
$nomeusuario;

#SOLICITA O ARQUIVO
include("conectadb.php");

#EVENTO,APÓS CLICK NO BOTÃO LOGAR
if($_SERVER['REQUEST_METHOD'] == 'POST') {
     $nome = $_POST['nome'];
     $senha = $_POST['senha'];

     #QUERY DE BANCO DE DADOS
     $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_nome = '$nome' 
     AND usu_senha = '$senha' AND usu_ativo= 's'";
     $retorno = mysqli_query($link, $sql);

     #TODO RETORNO DO BANCO É RETORNADO EM ARRAY EM PHP
     while($tbl = mysqli_fetch_array($retorno)) {
          $cont = $tbl[0];
     }
     #VERIFICA SE USUARIO EXISTE
     #SE $CONT == 1 ELE EXISTE E FAZ LOGIN
     #SE $CONT == 0 ELE NAO EXISTE E USUARIO NAO ESTA CADASTRADO 
     if ($cont == 1){
          $sql = "SELECT * FROM usuarios WHERE usu_nome = '$nome' 
          AND usu_senha = '$senha' AND usu_ativo = 's'";
   
           $_SESSION['nomeusuario']= $nome;

          #DIRECIONA USUARIO PARA INDEX
          echo"<script>window.location.href='home.php';</script>";
      } 
     else {
          
          echo"<script>window.alert('USUARIO OU SENHA INCORRETO');</script>";
     }
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./css/style.css">
     <title>LOGIN USUARIO</title>
</head>
<body>
     <form action="login.php" method="post">
          <h1>LOGIN DE USUARIO</h1>
          <input type="text" name="nome" placeholder="NOME">
          <p></p>
          <input type="password" name="senha" placeholder="SENHA">
          <p></p>
          <input type="submit" name="login" placeholder="LOGIN">
     </form>


</body>
</html>