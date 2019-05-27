<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
/**
 * Description of rEquipParadaDAO
 *
 * @author anderson
 */
class REquipParadaDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT " 
                    . " ROWNUM AS \"idRAtivParada\" "
                    . " , VE.EQUIP_ID AS \"idEquip\" "
                    . " , AA.ATIVAGR_ID AS \"idAtiv\" "
                    . " , MOT.MOTPARADA_ID AS \"idParada\" "
                    . " FROM " 
                    . " V_SIMOVA_EQUIP VE " 
                    . " , V_SIMOVA_MODELO_ATIVAGR VA " 
                    . " , V_SIMOVA_ATIVAGR_NEW AA " 
                    . " , USINAS.R_ATIVAGR_MOTPARADA MOT " 
                    . " WHERE " 
                    . " VE.MODELEQUIP_ID = VA.MODELEQUIP_ID " 
                    . " AND " 
                    . " VA.ATIVAGR_CD = AA.ATIVAGR_CD " 
                    . " AND " 
                    . " MOT.ATIVAGR_ID = AA.ATIVAGR_ID " 
                    . " AND " 
                    . " AA.DESAT = 0 ";
        
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $r3 = $this->Read->fetchAll();
        
        $dados = array("dados"=>$r3);
        $res3 = json_encode($dados);

        return $res3;
    }
    
}
