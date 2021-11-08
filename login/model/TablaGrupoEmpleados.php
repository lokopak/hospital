<?php

require_once __DIR__ . "/GrupoEmpleados.php";

class TablaGrupoEmpleados
{
    /**
     * Grupo de empleados cargados en la aplicación.
     * 
     * @var \GrupoEmpleados[]
     */
    protected $grupos = [];

    /**
     * Instancia única de esta clase.
     * 
     * @var TablaGrupoEmpleados
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
        $this->cargarGrupos();
    }

    /**
     * Devuelve el único objeto que se puede crear de esta clase.
     * 
     * @return \TablaGrupoEmpleados
     */
    public static function getInstancia()
    {
        if (!self::$instancia) {
            self::$instancia = new TablaGrupoEmpleados();
        }

        return self::$instancia;
    }

    /**
     * Devuelve los grupos cargados en la aplicación.
     * 
     * @return GrupoEmpleados[]
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    /**
     * 
     */
    private function cargarGrupos()
    {
        $datos = require __DIR__ . "/../config/permisos.config.php";

        // No hay datos de grupos.... no continuamos..
        if (!isset($datos['datos_permisos']) || !isset($datos['datos_permisos']['grupo_empleados'])) {
            return;
        }
        $datosGrupos = $datos['datos_permisos']['grupo_empleados'];

        foreach ($datosGrupos as $nombre => $info) {
            $padre = null;
            if (!empty($info['padre'])) {
                if (isset($this->grupos[$info['padre']])) {
                    $padre = $this->grupos[$info['padre']];
                }
            }
            if (!isset($info['permitido'])) {
                $info['permitido'] = [];
            }

            $this->grupos[$nombre] = new GrupoEmpleados($nombre, $padre, $info['permitido']);
        }
    }

    /**
     * Devuelve un grupo con el nombre indicado
     * 
     * @return \GrupoEmpleados|null
     */
    public function getGrupo($nombre)
    {
        if (isset($this->grupos[$nombre])) {
            return $this->grupos[$nombre];
        }

        return null;
    }
}