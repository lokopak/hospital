<?php

require_once(__DIR__ . "/../../model/Persona.php");

/**
 * La clase Empleado representa a las entidades de los
 * empleados de la tabla empleados de la base de datos
 * y engloba a todos los posibles empleados del hospital.
 * 
 * La diferencia entre los distintos empleados se maneja
 * mediante el atributo / propiedad "cargo"
 */
class Empleado extends Persona
{

    // Con esta constante nos aseguramos de que todos los empleados que no tengan cargo
    // usen el mismo número. Ademas de permitirnos cambiar dicho valor en cualquier momento
    // en toda la aplicación sin necesidad de buscar cada uso de este por todo el código.

    // Este empleado ya no está dado de alta en el hospital, pero no lo borramos para facilitar/asegurar la permanencia de datos
    // como los posibles 'celadores' creadores de los informes.
    // NOTA: Los empleados con el cargo 0, no tendrán acceso a la aplicación.
    // NOTA: Esto podría estar en un archivo externo o una tabla en la base de datos para hacerlo más dinámico y poder modificarlos
    // desde la propia aplicación, pero de momento lo dejamos como algo fijo.
    const CARGO_EMPLEADO_INACTIVO = 0;
    const CARGO_EMPLEADO_BASE = 1;
    const CARGO_EMPLEADO_CELADOR = 2;
    const CARGO_EMPLEADO_NUTRICIONISTA = 3;
    const CARGO_EMPLEADO_ADMINISTRADOR = 4;

    // Alguien tiene que hacer la función de "TODOPODEROSO" en todo esto, no? buahhahahahaha!!!
    const CARGO_EMPLEADO_MASTER = -1;

    /**
     * Este array nos va a permitir trasladar un valor numérico de un cargo (generalmente obtenido desde la base de datos)
     * a uno nombre de cargo equivalente que podamos manejar y mostrar más fácilmente.
     */
    protected static $cargos = [
        self::CARGO_EMPLEADO_INACTIVO => "no empleado",
        self::CARGO_EMPLEADO_BASE => "empleado",
        self::CARGO_EMPLEADO_CELADOR => "celador",
        self::CARGO_EMPLEADO_NUTRICIONISTA => "nutricionista",
        self::CARGO_EMPLEADO_ADMINISTRADOR => "administrador",
    ];

    /**
     * DNI del empleado
     * (en este caso sirve además como identificación para acceder a la aplicación)
     * 
     * @var string
     */
    protected $DNI;

    /**
     * Cargo asignado a este empleado.
     * 
     * @var int
     */
    protected $cargo;

    /**
     * Contraseña de acceso del empleado en la aplicación.
     * 
     * NOTA: Dicha contraseña se guarda encriptada en la base de datos
     *       para evitar que en caso de filtración pueda ser empleada
     *       por personas ajenas a la aplicación.
     * 
     * @var string
     */
    protected $userPassword;

    /**
     * Constructor
     */
    public function __construct()
    {
        // Agregamos la columna userPassword al array de $noDevolver
        // para evitar que se pueda filtrar de por error.
        // Esto hace que sólo se pueda acceder al userPassword mediante
        // el método "getUserPassword()"
        $this->noDevolver[] = "userPassword";
    }

    /**
     * Devuelve el DNI del empleado
     * 
     * @return string
     */
    public function getDNI()
    {
        return $this->DNI;
    }

    /**
     * Cambia el DNI del empleado
     * 
     * @param string $DNI El nuevo DNI del empleado.
     * 
     * @return void
     */
    public function setDNI($DNI)
    {
        $this->DNI = $DNI;
    }

    /**
     * Devuelve el cargo del empleado
     * 
     * @return int
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Devuelve el nombre del cargo asignado al objeto.
     * 
     * @return string
     */
    public function getNombreCargo($cargo = null)
    {
        // Si no se ha proporcionado cargo, se devuelve el cargo del objeto por defecto.
        if (empty($cargo)) {
            $cargo = $this->cargo;
        }

        // Si el cargo está entre los especificados en esta clase, devolvemos el nombre correspondiente.
        if (isset(static::$cargos[$cargo])) {
            return static::$cargos[$cargo];
        }

        // En caso de no estarlo...
        return "desconocido";
    }

    /**
     * Cambia el cargo del empleado
     * 
     * @param int $cargo El nuevo cargo del empleado.
     * 
     * @return void
     */
    public function setCargo($cargo)
    {
        // Protegemos la integridad de los datos en la base de datos impidiendo que un empleado tome un valor no permitido.
        if (!isset($this->cargos[$cargo])) {
            throw new InvalidArgumentException("El cargo proporcionado no es correcto.");
        }

        // Si todo está bien, procedemos =)
        $this->cargo = $cargo;
    }

    /**
     * Devuelve la contraseña del empleado
     * 
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Cambia la contraseña del empleado
     * 
     * @param string $userPassword La nueva contraseña del empleado.
     * 
     * @return void
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;
    }

    /**
     * Devuelve un array todos los cargos disponibles para asignar
     * Esto nos facilita obtener y comprobar que cargos están disponibles o no.
     * 
     * @return array
     */
    public static function getCargosDisponibles()
    {
        return self::$cargos;
    }
}