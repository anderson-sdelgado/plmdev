<?php

require('./dao/InserirApontDAO.class.php');
require('./dao/InserirDadosDAO.class.php');

$inserirApontDAO = new InserirApontDAO();
$inserirDadosDAO = new InserirDadosDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$retorno = '';

if (isset($info)):

    $dados = $info['dado'];
    $inserirDadosDAO->salvarDados($dados, "inserirapont");
    
    $jsonObjAponta = json_decode($dados);
    $dadosAponta = $jsonObjAponta->apont;

    $inserirApontDAO->salvarDados($dadosAponta);

    echo 'GRAVOU-APONT';
    
endif;


