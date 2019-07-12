<?php

require_once('./control/ApontCTR.class.php');

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $apontCTR = new ApontCTR();
    echo $apontCTR->salvarApont($info, "inserirapont");
    
endif;


