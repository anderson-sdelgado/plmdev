<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
require_once './model/dao/AjusteDataHoraDAO.class.php';

/**
 * Description of InsApontamentoMMDAO
 *
 * @author anderson
 */
class InserirApontDAO extends Conn {
    //put your code here

    /** @var PDO */
    private $Conn;

    public function verifApont($apont) {

        $select = " SELECT "
                . " COUNT(ID) AS QTDE "
                . " FROM "
                . " PLM_APONTAMENTO "
                . " WHERE "
                . " DTHR_CEL = TO_DATE('" . $apont->dthrApont . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " LIDER_MATRIC = " . $apont->matricLiderApont
                . " AND "
                . " EQUIP_ID = " . $apont->idEquipApont;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function insApont($apont) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $sql = "INSERT INTO PLM_APONTAMENTO ("
                . " OPER_MATRIC "
                . " , LIDER_MATRIC "
                . " , EQUIP_ID "
                . " , TURNO_ID "
                . " , OS_NRO "
                . " , ATIVAGR_ID "
                . " , MOTPARADA_ID "
                . " , DTHR "
                . " , DTHR_CEL "
                . " , DTHR_TRANS "
                . " , STATUS_CONEXAO "
                . " ) "
                . " VALUES ("
                . " 11 "
                . " , " . $apont->matricLiderApont
                . " , " . $apont->idEquipApont
                . " , " . $apont->idTurnoApont
                . " , " . $apont->osApont
                . " , " . $apont->ativApont
                . " , " . $apont->paradaApont
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($apont->dthrApont)
                . " , TO_DATE('" . $apont->dthrApont . "','DD/MM/YYYY HH24:MI')"
                . " , SYSDATE "
                . " , " . $apont->statusConApont
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

}
