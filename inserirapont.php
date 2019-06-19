<?php

require_once('./control/InserirApontCTR.class.php');

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $inserirApontCTR = new InserirApontCTR();
    echo $inserirApontCTR->salvarApont($info, "inserirapont");
    
endif;


