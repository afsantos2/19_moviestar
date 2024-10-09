<?php 
session_start();

$BASE_URL = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI'] . '?');

function pr($dados) {
  echo '<pre>';
  print_r($dados);
  echo '</pre>';
}