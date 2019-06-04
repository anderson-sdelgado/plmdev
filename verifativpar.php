<?php

require('./dao/VerifAtivParadaDAO.class.php');

$atualAtivParadaDAO = new VerifAtivParadaDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $retorno = $atualAtivParadaDAO->dados($info['dado']);

endif;

echo $retorno;