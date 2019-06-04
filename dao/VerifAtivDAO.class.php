<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
/**
 * Description of AtualEquipAtivDAO
 *
 * @author anderson
 */
class VerifAtivDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;
    
    public function dados() {

        $select = " SELECT "
                    . " VE.EQUIP_ID AS \"idEquip\" "
                    . " , AA.ATIVAGR_ID AS \"idAtiv\" "
                . " FROM "
                    . " V_SIMOVA_EQUIP VE "
                    . " , V_SIMOVA_MODELO_ATIVAGR VA "
                    . " , V_SIMOVA_ATIVAGR_NEW AA "
                . " WHERE "
                . " VE.MODELEQUIP_ID = VA.MODELEQUIP_ID "
                . " AND "
                . " VA.ATIVAGR_CD = AA.ATIVAGR_CD "
                . " AND "
                . " AA.DESAT = 0 " 
                . " ORDER BY ROWNUM ASC ";
                ;
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $r1 = $this->Read->fetchAll();
        
        $dados = array("dados"=>$r1);
        $res1 = json_encode($dados);

        $select = " SELECT "
                        . " A.ATIVAGR_ID AS \"idAtiv\" "
                        . " , A.ATIVAGR_CD AS \"codAtiv\" "
                        . " , CARACTER(A.ATIVAGR_DESCR) AS \"descrAtiv\" "
                . " FROM "
                    . " USINAS.VMB_ATIVAGR_MECAN A ";
        
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $r2 = $this->Read->fetchAll();
        
        $dados = array("dados"=>$r2);
        $res2 = json_encode($dados);

        return $res1 . "_" . $res2;
        
    }
    
    
}
