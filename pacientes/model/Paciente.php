<?php

class Paciente extends Persona
{
    protected $habitacion;

    public function getHabiticion()
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
}