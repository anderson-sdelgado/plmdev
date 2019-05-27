<?php

require('./dao/ColaboradorDAO.class.php');

$colaboradorDAO = new ColaboradorDAO();

//cria o array associativo
$dados = array("dados"=>$colaboradorDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
