<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './dbutil/Conn.class.php';
require_once './model/dao/AjusteDataHoraDAO.class.php';

/**
 * Description of BoletimMM
 *
 * @author anderson
 */
class BoletimDAO extends Conn {

    public function verifBoletim($bol) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PMM_BOLETIM "
                . " WHERE "
                . " DTHR_INICIAL_CEL = TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI')"
                . " AND "
                . " EQUIP_ID = " . $bol->idEquipBoletim . " ";

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

    public function idBoletim($bol) {

        $select = " SELECT "
                . " ID AS ID "
                . " FROM "
                . " PMM_BOLETIM "
                . " WHERE "
                . " DTHR_INICIAL_CEL = TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI')"
                . " AND "
                . " EQUIP_ID = " . $bol->idEquipBoletim . " ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
    }

    public function insBoletimAberto($bol) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        if ($bol->hodometroInicialBoletim > 9999999) {
            $bol->hodometroInicialBoletim = 0;
        }

        $sql = "INSERT INTO PMM_BOLETIM ("
                . " FUNC_MATRIC "
                . " , LIDER_MATRIC "
                . " , EQUIP_ID "
                . " , TURNO_ID "
                . " , HOD_HOR_INICIAL "
                . " , OS_NRO "
                . " , ATIVAGR_PRINC_ID "
                . " , DTHR_INICIAL "
                . " , DTHR_INICIAL_CEL "
                . " , DTHR_TRANS_INICIAL "
                . " , STATUS "
                . " , STATUS_CONEXAO "
                . " ) "
                . " VALUES ("
                . " 11 "
                . " , " . $bol->matricLiderBoletim
                . " , " . $bol->idEquipBoletim
                . " , " . $bol->idTurnoBoletim
                . " , " . $bol->hodometroInicialBoletim
                . " , " . $bol->osBoletim
                . " , " . $bol->ativPrincBoletim
                . " , TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI') "
                . " , TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , 1 "
                . " , " . $bol->statusConBoletim
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function insBoletimFechado($bol) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        if ($bol->hodometroInicialBoletim > 9999999) {
            $bol->hodometroInicialBoletim = 0;
        }

        if ($bol->hodometroFinalBoletim > 9999999) {
            $bol->hodometroFinalBoletim = 0;
        }

        $sql = "INSERT INTO PMM_BOLETIM ("
                . " FUNC_MATRIC "
                . " , LIDER_MATRIC "
                . " , EQUIP_ID "
                . " , TURNO_ID "
                . " , HOD_HOR_INICIAL "
                . " , HOD_HOR_FINAL "
                . " , OS_NRO "
                . " , ATIVAGR_PRINC_ID "
                . " , DTHR_INICIAL "
                . " , DTHR_INICIAL_CEL "
                . " , DTHR_TRANS_INICIAL "
                . " , DTHR_FINAL "
                . " , DTHR_FINAL_CEL "
                . " , DTHR_TRANS_FINAL "
                . " , STATUS "
                . " , STATUS_CONEXAO "
                . " ) "
                . " VALUES ("
                . " 11 "
                . " , " . $bol->matricLiderBoletim
                . " , " . $bol->idEquipBoletim
                . " , " . $bol->idTurnoBoletim
                . " , " . $bol->hodometroInicialBoletim
                . " , " . $bol->hodometroFinalBoletim
                . " , " . $bol->osBoletim
                . " , " . $bol->ativPrincBoletim
                . " , TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI')"
                . " , TO_DATE('" . $bol->dthrInicioBoletim . "','DD/MM/YYYY HH24:MI')"
                . " , SYSDATE "
                . " , TO_DATE('" . $bol->dthrFimBoletim . "','DD/MM/YYYY HH24:MI')"
                . " , TO_DATE('" . $bol->dthrFimBoletim . "','DD/MM/YYYY HH24:MI')"
                . " , SYSDATE "
                . " , 2 "
                . " , " . $bol->statusConBoletim
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    public function altBoletimFechado($idBol, $bol) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        if ($bol->hodometroFinalBoletim > 9999999) {
            $bol->hodometroFinalBoletim = 0;
        }

        $sql = "UPDATE PMM_BOLETIM "
                . " SET "
                . " HOD_HOR_FINAL = " . $bol->hodometroFinalBoletim
                . " , STATUS = " . $bol->statusBoletim
                . " , DTHR_FINAL = TO_DATE('" . $bol->dthrFimBoletim . "','DD/MM/YYYY HH24:MI')"
                . " , DTHR_FINAL_CEL = TO_DATE('" . $bol->dthrFimBoletim . "','DD/MM/YYYY HH24:MI')"
                . " , DTHR_TRANS_FINAL = SYSDATE "
                . " WHERE "
                . " ID = " . $idBol;

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

}
