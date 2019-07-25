<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/BoletimDAO.class.php');
require_once('./model/dao/ApontDAO.class.php');
require_once('./model/dao/LogDAO.class.php');
/**
 * Description of InserirApontCTR
 *
 * @author anderson
 */
class InserirDadosCTR {

    public function salvarDadosBolAberto($info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina);

        $pos1 = strpos($dados, "_") + 1;

        $bol = substr($dados, 0, ($pos1 - 1));
        $apont = substr($dados, $pos1);

        $jsonObjBoletim = json_decode($bol);
        $jsonObjApont = json_decode($apont);

        $dadosBoletim = $jsonObjBoletim->boletim;
        $dadosApont = $jsonObjApont->apont;

        $this->salvarBolAberto($dadosBoletim, $dadosApont);
            
        return 'GRAVOU-BOLABERTO';
    }
    
    public function salvarDadosBolFechado($info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina);

        $pos1 = strpos($dados, "_") + 1;

        $bol = substr($dados, 0, ($pos1 - 1));
        $apont = substr($dados, $pos1);

        $jsonObjBoletim = json_decode($bol);
        $jsonObjApont = json_decode($apont);

        $dadosBoletim = $jsonObjBoletim->boletim;
        $dadosApont = $jsonObjApont->apont;

        $this->salvarBolFechado($dadosBoletim, $dadosApont);

        return 'GRAVOU-BOLFECHADO';
    }

    private function salvarLog($dados, $pagina) {
        $logDAO = new LogDAO();
        $logDAO->salvarDados($dados, $pagina);
    }

    ///////////////////////////////////////////////////////////////////////////////////
    
    private function salvarBolAberto($dadosBoletim, $dadosAponta) {
        $boletimDAO = new BoletimDAO();
        foreach ($dadosBoletim as $bol) {
            $v = $boletimDAO->verifBoletim($bol);
            if ($v == 0) {
                $boletimDAO->insBoletimAberto($bol);
            }
            $idBol = $boletimDAO->idBoletim($bol);
            $this->salvarApontBol($idBol, $bol->idBoletim, $dadosAponta);
        }
        return $idBol;
    }

    private function salvarBolFechado($dadosBoletim, $dadosAponta) {
        $boletimDAO = new BoletimDAO();
        foreach ($dadosBoletim as $bol) {
            $v = $boletimDAO->verifBoletim($bol);
            if ($v == 0) {
                $boletimDAO->insBoletimFechado($bol);
                $idBol = $boletimDAO->idBoletim($bol);
            } else {
                $idBol = $boletimDAO->idBoletim($bol);
                $boletimDAO->altBoletimFechado($idBol, $bol);
            }
            $this->salvarApontBol($idBol, $bol->idBoletim, $dadosAponta);
        }
    }
    
    private function salvarApontBol($idBolBD, $idBolCel, $dadosAponta) {
        $apontDAO = new ApontDAO();
        foreach ($dadosAponta as $apont) {
            if ($idBolCel == $apont->idBolApont) {
                $v = $apontDAO->verifApont($idBolBD, $apont);
                if ($v == 0) {
                    $apontDAO->insApont($idBolBD, $apont);
                }
            }
        }
    }
    
}
