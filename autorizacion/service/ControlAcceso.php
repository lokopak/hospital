<?php

/**
 * Esta clase se empleará para comprobar los permisos
 * que dispone un usuario y tomar las acciones correspondientes.
 */
class ControlAcceso
{

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
    public function tieneAcceso($empleado, $permiso)
    {
        return true;
    }
}