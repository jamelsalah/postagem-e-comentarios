<?php
session_start();

$nome=$_POST['nome'];
$post=$_POST['post'];

//conexão com o banco de dados//=======================================
$conexao=mysqli_connect("localhost","root","","postagem");
//conexão com o banco de dados//=======================================


$inserir="INSERT into posts (nome,post) VALUES ('$nome','$post')";

$query=mysqli_query($conexao,$inserir);

header("Location:index.php");




















?>