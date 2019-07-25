<?php

require_once('./control/InserirDadosCTR.class.php');

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $inserirDadosCTR = new InserirDadosCTR();
    echo $inserirDadosCTR->salvarDadosBolFechado($info, "inserirbolfechado");
    
endif;
