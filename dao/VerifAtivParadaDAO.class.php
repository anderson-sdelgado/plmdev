<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
/**
 * Description of AtualClasseParadaDAO
 *
 * @author anderson
 */
class VerifAtivParadaDAO extends Conn {
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;
    
    public function dados() {

        $select = " SELECT " 
                    . " AA.ATIVAGR_ID AS \"idAtiv\" "
                    . " , MOT.MOTPARADA_ID AS \"idParada\" "
                    . " FROM " 
                    . " V_SIMOVA_ATIVAGR_NEW AA " 
                    . " , USINAS.R_ATIVAGR_MOTPARADA MOT " 
                    . " WHERE " 
                    . " MOT.ATIVAGR_ID = AA.ATIVAGR_ID " 
                    . " AND " 
                    . " AA.DESAT = 0 ";
        
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $r1 = $this->Read->fetchAll();
        
        $dados = array("dados"=>$r1);
        $res1 = json_encode($dados);

        $select = " SELECT "
                    . " MOTPARADA_ID AS \"idParada\" "
                    . " , CD AS \"codParada\" "
                    . " , CARACTER(DESCR) AS \"descrParada\" "
                . " FROM "
                    . " USINAS.MOTIVO_PARADA "
                . " ORDER BY "
                    . " MOTPARADA_ID "
                . " ASC ";
        
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $r2 = $this->Read->fetchAll();
        
        $dados = array("dados"=>$r2);
        $res2 = json_encode($dados);

        return $res1 . "_" . $res2;
        
    }
}
