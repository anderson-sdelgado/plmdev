<?php

require('./dao/REquipAtivDAO.class.php');

$rEquipAtivDAO = new REquipAtivDAO();

//cria o array associativo
$dados = array("dados"=>$rEquipAtivDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;