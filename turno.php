<?php

require('./dao/TurnoDAO.class.php');

$turnoDAO = new TurnoDAO();

//cria o array associativo
$dados = array("dados"=>$turnoDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
