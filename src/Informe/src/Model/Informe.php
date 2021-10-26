<?php

namespace Dotpak\Hospital\Informe\Model;

use Dotpak\Hospital\Mvc\Model\Entidad;

class Informe extends Entidad
{
    protected $idInforme;

    public function getIdInforme()
    {
        return $this->idInforme;
    }

    public function setIdInforme($idInforme)
    {
        $this->idInforme = $idInforme;
    }

    protected $idNutricionista;

    public function getIdNutricionista()
    {
        return $this->idNutricionista;
    }

    public function setIdNutricionista($idNutricionista)
    {
        $this->idNutricionista = $idNutricionista;
    }

    protected $idPaciente;

    public function getIdPaciente()
    {
        return $this->idPaciente;
    }

    public function setIdPaciente($idPaciente)
    {
        $this->idPaciente = $idPaciente;
    }

    protected $idCelador;

    public function getIdCelador()
    {
        return $this->idCelador;
    }

    public function setIdCelador($idCelador)
    {
        $this->idCelador = $idCelador;
    }

    protected $dieta;

    public function getDieta()
    {
        return $this->dieta;
    }

    public function setDieta($dieta)
    {
        $this->dieta = $dieta;
    }

    protected $fecha;

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    protected $desayuno;

    public function getDesayuno()
    {
        return $this->desayuno;
    }

    public function setDesayuno($desayuno)
    {
        $this->desayuno = $desayuno;
    }

    protected $comida1;

    public function getComida1()
    {
        return $this->comida1;
    }

    public function setComida1($comida1)
    {
        $this->comida1 = $comida1;
    }

    protected $comida2;

    public function getComida2()
    {
        return $this->comida2;
    }

    public function setComida2($comida2)
    {
        $this->comida2 = $comida2;
    }
    protected $comida3;

    public function getComida3()
    {
        return $this->comida3;
    }

    public function setComida3($comida3)
    {
        $this->comida3 = $comida3;
    }

    protected $merienda;

    public function getMerienda()
    {
        return $this->merienda;
    }

    public function setMerienda($merienda)
    {
        $this->merienda = $merienda;
    }

    protected $cena1;

    public function getCena1()
    {
        return $this->cena1;
    }

    public function setCena1($cena1)
    {
        $this->cena1 = $cena1;
    }

    protected $cena2;

    public function getCena2()
    {
        return $this->cena2;
    }

    public function setCena2($cena2)
    {
        $this->cena2 = $cena2;
    }

    protected $cena3;

    public function getCena3()
    {
        return $this->cena3;
    }

    public function setCena3($cena3)
    {
        $this->cena3 = $cena3;
    }

    protected $fechaModificacion;

    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }

    protected $ultimoEditor3;

    public function getUltimoEditor()
    {
        return $this->ultimoEditor;
    }

    public function setUltimoEditor($ultimoEditor)
    {
        $this->ultimoEditor = $ultimoEditor;
    }
}