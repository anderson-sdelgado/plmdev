<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/REquipAtivDAO.class.php');
/**
 * Description of REquipAtiv
 *
 * @author anderson
 */
class REquipAtivCTR {
    //put your code here
    
    public function dados() {
        
        $rEquipAtivDAO = new REquipAtivDAO();
       
        $dados = array("dados"=>$rEquipAtivDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
}
