<?php

namespace Dotpak\Hospital\Paciente\Model;

use Dotpak\Hospital\Mvc\Model\Persona;

class Paciente extends Persona
{
    const PACIENTE_ESTADO_ALTA = 0;
    const PACIENTE_ESTADO_FALLECIDO = 1;
    const PACIENTE_ESTADO_PREOPERATORIO = 2;
    const PACIENTE_ESTADO_POSTOPERATORIO = 3;
    const PACIENTE_ESTADO_UCI = 4;

    protected static $estados = [
        self::PACIENTE_ESTADO_ALTA => "alta",
        self::PACIENTE_ESTADO_FALLECIDO => "fallecido",
        self::PACIENTE_ESTADO_PREOPERATORIO => "pre-operatorio",
        self::PACIENTE_ESTADO_POSTOPERATORIO => "post-operatorio",
        self::PACIENTE_ESTADO_UCI => "uci",
    ];

    protected $habitacion;

    public function getHabitacion()
    {
        return $this->habitacion;
    }

    public function setHabitacion($habitacion)
    {
        $this->habitacion = $habitacion;
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

    protected $estado;

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    protected $fechaRegistro;

    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    protected $fechaSalida;

    public function getfechaSalida()
    {
        return $this->fechaSalida;
    }

    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;
    }

    public static function getEstados()
    {
        return self::$estados;
    }
}