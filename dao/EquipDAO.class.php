<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
/**
 * Description of EquipSegDAO
 *
 * @author anderson
 */
class EquipDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                . " E.EQUIP_ID AS \"idEquip\" "
                . " , E.NRO_EQUIP AS \"codEquip\" "
                . " , E.CLASSOPER_CD AS \"codClasseEquip\" "
                . " , CARACTER(E.CLASSOPER_DESCR) AS \"descrClasseEquip\" "
                . " , E.TPTUREQUIP_CD AS \"codTurno\" "
                . " FROM "
                . " USINAS.V_SIMOVA_EQUIP E ";
        
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $r1 = $this->Read->fetchAll();

        $dados = array("dados"=>$r1);
        $res1 = json_encode($dados);

        return $res1;
    }
}
