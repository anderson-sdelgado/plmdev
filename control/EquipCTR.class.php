<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/EquipDAO.class.php');
/**
 * Description of EquipCTR
 *
 * @author anderson
 */
class EquipCTR {
    //put your code here
    
    public function dados() {
        
        $equipDAO = new EquipDAO();
       
        $dados = array("dados"=>$equipDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
}
