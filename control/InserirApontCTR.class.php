<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/InserirApontDAO.class.php');
require_once('./model/dao/InserirLogDAO.class.php');

/**
 * Description of InserirApontCTR
 *
 * @author anderson
 */
class InserirApontCTR {

    //put your code here

    public function salvarApont($info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina);

        $jsonObjAponta = json_decode($dados);
        
        $dadosAponta = $jsonObjAponta->apont;
        $inserirApontDAO = new InserirApontDAO();

        foreach ($dadosAponta as $apont) {
            $v = $inserirApontDAO->verifApont($apont);
            if ($v == 0) {
                $inserirApontDAO->insApont($apont);
            }
        }
        echo 'GRAVOU-APONT';
    }

    private function salvarLog($dados, $pagina) {
        $inserirLogDAO = new InserirLogDAO();
        $inserirLogDAO->salvarDados($dados, $pagina);
    }

}
