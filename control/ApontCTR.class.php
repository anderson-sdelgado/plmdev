<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/ApontDAO.class.php');
require_once('./model/dao/LogDAO.class.php');
/**
 * Description of InserirApontCTR
 *
 * @author anderson
 */
class ApontCTR {

    //put your code here

    public function salvarApont($info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina);

        $jsonObjAponta = json_decode($dados);
        
        $dadosAponta = $jsonObjAponta->apont;
        $apontDAO = new ApontDAO();

        foreach ($dadosAponta as $apont) {
            $v = $apontDAO->verifApont($apont);
            if ($v == 0) {
                $apontDAO->insApont($apont);
            }
        }
        echo 'GRAVOU-APONT';
    }

    private function salvarLog($dados, $pagina) {
        $logDAO = new LogDAO();
        $logDAO->salvarDados($dados, $pagina);
    }

}
