<?php
require_once(__DIR__ . "/../../model/Persona.php");

/**
 * Clase Paciente.
 */
class Paciente extends Persona
{
    /**
     * Algunos de los posibles estados de un paciente.
     * Sólo por dejar algunos rellenos
     */
    const PACIENTE_ESTADO_ALTA = 0;
    const PACIENTE_ESTADO_FALLECIDO = 1;
    const PACIENTE_ESTADO_PREOPERATORIO = 2;
    const PACIENTE_ESTADO_POSTOPERATORIO = 3;
    const PACIENTE_ESTADO_UCI = 4;

    /**
     * Este array nos permite trasladar el estado de un paciente
     * de un número a un string, más entendible para el usuario.
     */
    protected static $estados = [
        self::PACIENTE_ESTADO_ALTA => "alta",
        self::PACIENTE_ESTADO_FALLECIDO => "fallecido",
        self::PACIENTE_ESTADO_PREOPERATORIO => "pre-operatorio",
        self::PACIENTE_ESTADO_POSTOPERATORIO => "post-operatorio",
        self::PACIENTE_ESTADO_UCI => "uci",
    ];

    /**
     * Habitación en la que se encuentra alojado el paciente.
     * Inicialmente no tiene funcionalidad pero nos ayuda a
     * darle un poco de sentido a algunas características del celador.
     * 
     * @var int
     */
    protected $habitacion;

    /**
     * Dieta que le se le ha asignado al paciente.
     * 
     * @var int
     */
    protected $dieta;

    /**
     * Estado en el que se encuentra el paciente.
     * Actualmente no tiene ningún valor ni peso
     * específico en la aplicación, pero nos ayuda
     * a darle cierta funcionalidad a las características
     * de un nutricionista.
     */
    protected $estado;

    /**
     * Fecha en la que se registra a un paciente
     * en el hospital. (fecha de ingreso)
     * 
     * @var date
     */
    protected $fechaRegistro;

    /**
     * Fecha de alta médica o salida del paciente del hospital
     * 
     * @var date
     */
    protected $fechaSalida;

    /**
     * Devuelve la habitación donde se encuentra el paciente.
     * 
     * @return int
     */
    public function getHabitacion()
    {
        return $this->habitacion;
    }

    /**
     * Ajusta el valor de la habitación en la que se encuentra el paciente.
     * 
     * @param int $habitación El número de la habitación.
     * 
     * @return void
     */
    public function setHabitacion($habitacion)
    {
        $this->habitacion = $habitacion;
    }

    /**
     * Devuelve la dieta asignada al paciente.
     * 
     * @return int
     */
    public function getDieta()
    {
        return $this->dieta;
    }

    /**
     * Ajusta la dieta que se le ha asigando al paciente.
     * 
     * @param int $dieta Número de la dieta
     * 
     * @return void
     */
    public function setDieta($dieta)
    {
        $this->dieta = $dieta;
    }

    /**
     * Devuele el estado del paciente.
     * 
     * @return int
     */
    public function getEstado()
    {
        return (int) $this->estado;
    }

    /**
     * Ajusta el estado del paciente.
     * 
     * @param int $estado
     * 
     * @return void
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Devuelve la fecha de registro o ingreso
     * del paciente.
     * 
     * @return date
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Ajusta la fecha de registro o ingreso de paciente.
     * 
     * @param date $fechaRegistro
     * 
     * @return void
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    /**
     * Devuelve la fecha de salida o alta médica del paciente
     * 
     * @return date
     */
    public function getfechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * Ajusta la fecha de salida o alta médica del paciente
     * 
     * @param date $fechaSalida
     * 
     * @return void
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;
    }

    /**
     * Devuelve todos los estdos posibles de los pacientes
     * del hospital
     * Facilita acceso a todos ellos y así rellenar selects
     * o intercambiar entre el nombre y el valor de cada uno
     * de ellos.
     * 
     * @return array
     */
    public static function getEstados()
    {
        return self::$estados;
    }
}