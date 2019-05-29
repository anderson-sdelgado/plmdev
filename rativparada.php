<?php

require('./dao/RAtivParadaDAO.class.php');

$rAtivParadaDAO = new RAtivParadaDAO();

//cria o array associativo
$dados = array("dados"=>$rAtivParadaDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;