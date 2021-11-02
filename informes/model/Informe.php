<?php
require_once(__DIR__ . "/../../model/Persona.php");
class Informe extends Entidad
{

    /**
     * Paciente al que se refiere el informe
     * 
     * @var Paciente
     */
    protected $paciente;

    /**
     * Empleado que crea el informe
     * 
     * @var Empleado
     */
    protected $empleado;

    /**
     * Dieta del paciente al que se refiere el informe.
     * 
     * @var Dieta
     */
    protected $dieta;

    /**
     * Fecha de creación del informe
     * 
     * @param DateTime
     */
    protected $fecha;

    /**
     * Valor del desayuno en el informe.
     * 
     * @var int
     */
    protected $desayuno;

    /**
     * Valor del primer palto de la comida en el informe.
     * 
     * @var int
     */

    protected $comida1;

    /**
     * Valor del segundo palto de la comida en el informe.
     * 
     * @var int
     */
    protected $comida2;

    /**
     * Valor del postre de la comida en el informe.
     * 
     * @var int
     */
    protected $comida3;

    /**
     * Valor de la merienda en el informe.
     * 
     * @var int
     */
    protected $merienda;

    /**
     * Valor del primer palto de la cena en el informe.
     * 
     * @var int
     */
    protected $cena1;

    /**
     * Valor del segundo palto de la cena en el informe.
     * 
     * @var int
     */
    protected $cena2;

    /**
     * Valor del postre de la cena en el informe.
     * 
     * @var int
     */
    protected $cena3;

    /**
     * Empleado que realiza la última modificación del informe.
     * 
     * @var Empleado
     */
    protected $ultimoEditor;

    /**
     * Valor de la última modificación del informe.
     * 
     * @var DateTime
     */
    protected $fechaModificacion;

    /**
     * Devuelve el paciente al que se refiere el informe
     * 
     * @return Paciente
     */
    public function getPaciente()
    {
        return $this->paciente;
    }


    /**
     * Fija el paciente al que se refiere el informe
     * 
     * @param Paciente $paciente
     * 
     * @return void
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
    }


    /**
     * Devuelve el empleado que ha creado el informe.
     * 
     * @return Empleado
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }

    /**
     * Fija el empleado que ha creado el informe
     * 
     * @param Empleado $empleado
     */
    public function setEmpleado($empleado)
    {
        $this->empleado = $empleado;
    }

    /**
     * Devuelve la dieta asociada al informe.
     * 
     * @param Dieta
     */
    public function getDieta()
    {
        return $this->dieta;
    }

    /**
     * Fija el valor de la dieta asociada al informe.
     * 
     * @param Dieta $dieta
     */
    public function setDieta($dieta)
    {
        $this->dieta = $dieta;
    }

    /**
     * Devuelve el falor de la fecha del informe.
     * 
     * @return DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Fija el valor de la fecha del informe
     * 
     * @param DateTime $fecha
     * 
     * @return void
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Devuelve el valor del desayuno en el informe.
     * 
     * @return int
     */
    public function getDesayuno()
    {
        return $this->desayuno;
    }

    /**
     * Fija el valor del desayuno en el informe.
     * 
     * @param int $desayuno
     * 
     * @return void
     */
    public function setDesayuno($desayuno)
    {
        $this->desayuno = $desayuno;
    }

    /**
     * Devuelve el valor del primer plato de la comida en el informe.
     * 
     * @return int
     */
    public function getComida1()
    {
        return $this->comida1;
    }

    /**
     * Fija el valor del primer plato de la comida en el informe.
     * 
     * @param int $comida1
     * 
     * @return void
     */
    public function setComida1($comida1)
    {
        $this->comida1 = $comida1;
    }

    /**
     * Devuelve el valor del segundo plato de la comida en el informe.
     * 
     * @return int
     */
    public function getComida2()
    {
        return $this->comida2;
    }

    /**
     * Fija el valor del segundo plato de la comida en el informe.
     * 
     * @param int $comida2 El nuevo valor.
     * 
     * @return void
     */
    public function setComida2($comida2)
    {
        $this->comida2 = $comida2;
    }

    /**
     * Devuelve el valor del postre de la comida del informe.
     * 
     * @return int
     */
    public function getComida3()
    {
        return $this->comida3;
    }

    /**
     * Fija el valor del postre de la comida en el informe.
     * 
     * @param int $comida3 El nuevo valor.
     * 
     * @return void
     */
    public function setComida3($comida3)
    {
        $this->comida3 = $comida3;
    }

    /**
     * Devuelve el valor de la merienda en el informe.
     * 
     * @return int
     */
    public function getMerienda()
    {
        return $this->merienda;
    }

    /**
     * Fija el valor de la merienda en el informe.
     * 
     * @param int $merienda El nuevo valor.
     * 
     * @return void
     */
    public function setMerienda($merienda)
    {
        $this->merienda = $merienda;
    }

    /**
     * Devuelve el valor del primer plato de la cena en el informe.
     * 
     * @return int
     */
    public function getCena1()
    {
        return $this->cena1;
    }

    /**
     * Fija el valor del primer plato de la cena en el informe.
     * 
     * @param int $cena1 El nuevo valor.
     * 
     * @return void
     */
    public function setCena1($cena1)
    {
        $this->cena1 = $cena1;
    }

    /**
     * Devuelve el valor del segundo plato de la cena en el informe.
     * 
     * @return int
     */
    public function getCena2()
    {
        return $this->cena2;
    }

    /**
     * Fija el valor del segundo plato de la cena en el informe.
     * 
     * @param int $cena2 El nuevo valor.
     * 
     * @return void
     */
    public function setCena2($cena2)
    {
        $this->cena2 = $cena2;
    }

    /**
     * Devuelve el valor del postre de la cena en el informe.
     * 
     * @return int
     */
    public function getCena3()
    {
        return $this->cena3;
    }

    /**
     * Fija el valor del postre de la cena en el informe.
     * 
     * @param int $cena3
     * 
     * @return void
     */
    public function setCena3($cena3)
    {
        $this->cena3 = $cena3;
    }

    /**
     * Devuelve la fecha de última modificación del informe.
     * 
     * @return DateTime
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Fija la fecha de modificación del informe.
     * 
     * @param DateTime $fechaModificacion La nueva fecha de modificación.
     * 
     * @return void
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }

    /**
     * Devuelve el último editor
     * 
     * @return \Elmpleado
     */
    public function getUltimoEditor()
    {
        return $this->ultimoEditor;
    }

    /**
     * Fija el último editor.
     * 
     * @param $ultimoEditor Empleado El último editor del informe.
     * 
     * @return void
     */
    public function setUltimoEditor($ultimoEditor)
    {
        $this->ultimoEditor = $ultimoEditor;
    }

    /**
     * Devuelve un array con los valores visibles de este
     * objeto.
     * 
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        // Devolvemos el array obtenido
        return $array;
    }

    /**
     * {@inheritdoc}
     */
    public function rellenarConArray($array)
    {
        if (isset($array['id'])) {
            $this->setId((int) $array['id']);
        }
        if (isset($array['paciente'])) {
            $this->setPaciente($array['paciente']);
        }
        if (isset($array['empleado'])) {
            $this->setEmpleado($array['empleado']);
        }
        if (isset($array['dieta'])) {
            $this->setDieta($array['dieta']);
        }
        if (isset($array['fecha'])) {
            $this->setFecha($array['fecha']);
        }
        if (isset($array['desayuno'])) {
            $this->setDesayuno((int) $array['desayuno']);
        }
        if (isset($array['comida1'])) {
            $this->setComida1((int) $array['comida1']);
        }
        if (isset($array['comida2'])) {
            $this->setComida2((int) $array['comida2']);
        }
        if (isset($array['comida3'])) {
            $this->setComida3((int) $array['comida3']);
        }
        if (isset($array['merienda'])) {
            $this->setMerienda((int) $array['merienda']);
        }
        if (isset($array['cena1'])) {
            $this->setCena1((int) $array['cena1']);
        }
        if (isset($array['cena2'])) {
            $this->setCena2((int) $array['cena2']);
        }
        if (isset($array['cena3'])) {
            $this->setCena3((int) $array['cena3']);
        }
        if (isset($array['ultimoEditor'])) {
            $this->setUltimoEditor($array['ultimoEditor']);
        }
        if (isset($array['fechaModificacion'])) {
            $this->setFechaModificacion($array['fechaModificacion']);
        }
    }
}