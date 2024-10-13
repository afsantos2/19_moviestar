<?php 
session_start();

$BASE_URL = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'] . '?');

function pr($dados) {
  echo '<pre>';
  print_r($dados);
  echo '</pre>';
}

// Função para registrar uma mensagem no log
function _log($mensagem) {
  $arquivo_log = 'logs/meu_log.log';
  $data_atual = date('Y-m-d H:i:s');
  $mensagem_formatada = "[{$data_atual}] {$mensagem}\n\n";

  file_put_contents($arquivo_log, $mensagem_formatada, FILE_APPEND | LOCK_EX);
}
?>