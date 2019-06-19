<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/ParadaDAO.class.php');
require_once('./model/dao/RAtivParadaDAO.class.php');
/**
 * Description of ParadaCTR
 *
 * @author anderson
 */
class ParadaCTR {
    //put your code here
    
    public function dados() {
        
        $paradaDAO = new ParadaDAO();
       
        $dados = array("dados"=>$paradaDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
    public function atual() {

        $rAtivParadaDAO = new RAtivParadaDAO();
        $paradaDAO = new ParadaDAO();

        $dadosRAtivParada = array("dados" => $rAtivParadaDAO->dados());
        $resRAtivParada = json_encode($dadosRAtivParada);

        $dadosParada = array("dados"=>$paradaDAO->dados());
        $resParada = json_encode($dadosParada);
        
        return $resRAtivParada . "_" . $resParada;
                
    }
    
}
