<?php

require_once __DIR__ . "/../model/TablaGrupoEmpleados.php";
/**
 * Esta clase se empleará para comprobar los permisos
 * que dispone un usuario y tomar las acciones correspondientes.
 */
class ControlAcceso
{

    /**
     * Tabla de grupo de empleados con acceso a los distintos grupos de empleados.
     * 
     * @var \TablaGrupoEmpleados
     */
    protected $tablaGrupoEmpleados;

    /**
     * Instancia única de esta clase.
     * 
     * @var \ControlAcceso
     */
    protected static $instancia;

    /**
     * Constructor
     * 
     * Declarado privado para impedir que se puedan crear
     * más de un objeto de esta clase.
     */
    private function __construct()
    {
        $this->tablaGrupoEmpleados = TablaGrupoEmpleados::getInstancia();
    }

    /**
     * Devuelve el único objeto que se puede crear de esta clase.
     * 
     * @return \ControlAcceso
     */
    public static function getInstancia()
    {
        if (!static::$instancia) {
            static::$instancia = new ControlAcceso();
        }

        return static::$instancia;
    }

    /**
     * Esta función comprobará si un empleado tiene acceso a realizar
     * una acción dentro de una determinada sección.
     * 
     * @param Empleado $empleado El empleado a comprobar
     * @param string $permiso El permiso que se desea comprobar
     * 
     * @return boolean Devuelve true si el empleado tiene acceso
     *              al recurso indicado.
     *                  false en caso de no tenerlo.
     */
    public static function tieneAcceso($permiso)
    {
        static::getInstancia();
        $empleado = Autentificacion::getInstancia()->usuarioActual();

        $nombreGrupo = $empleado->getNombreCargo();

        $grupo = TablaGrupoEmpleados::getInstancia()->getGrupo($nombreGrupo);

        if (null === $grupo) {
            return false;
        }

        /**
         * Con esto evitamos redundancia de código y damos acceso total a la aplicación.
         */
        if ($grupo->tienePermiso('APP@TOTAL')) {
            return true;
        }

        return $grupo->tienePermiso($permiso);
    }
}