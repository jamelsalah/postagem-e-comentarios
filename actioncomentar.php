<?php
session_start();

$nome=$_POST['nome'];
$comentario=$_POST['comentario'];
$postid=$_POST['post_id'];

//conexão com o banco de dados//=======================================
$conexao=mysqli_connect("localhost","root","","postagem");
//conexão com o banco de dados//=======================================

$insert="INSERT into comentarios (`nome`, `comentario`, `post_id`) VALUES ('$nome', '$comentario', '$postid')";

$query=mysqli_query($conexao,$insert);







header("Location:index.php");
?>