<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/AtividadeDAO.class.php');
require_once('./model/dao/REquipAtivDAO.class.php');
/**
 * Description of AtividadeCTR
 *
 * @author anderson
 */
class AtividadeCTR {
    //put your code here
    
    public function dados() {
        
        $atividadeDAO = new AtividadeDAO();
       
        $dados = array("dados"=>$atividadeDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
    public function atual() {

        $rEquipAtivDAO = new REquipAtivDAO();
        $atividadeDAO = new AtividadeDAO();

        $dadosREquipAtiv = array("dados" => $rEquipAtivDAO->dados());
        $resREquipAtiv = json_encode($dadosREquipAtiv);

        $dadosAtividade = array("dados" => $atividadeDAO->dados());
        $resAtividade = json_encode($dadosAtividade);
        
        return $resREquipAtiv . "_" . $resAtividade;
                
    }
    
}
