<?php 
$db_name = 'moviestar1';
$db_host = 'mysql';
$db_user = 'root';
$db_pass = '';

$conn = new PDO('mysql:dbname='.$db_name.';host='.$db_host, $db_user, $db_pass);

// Habilitar erros do PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>