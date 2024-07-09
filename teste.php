<?php 

$conn = new PDO("mysql:host=mysql;dbname=moviestar1","root", '');

$stmt = $conn->prepare("SELECT * FROM movies;");

$stmt->execute();

$dados = $stmt->fetch(PDO::FETCH_ASSOC);

print_r($dados);