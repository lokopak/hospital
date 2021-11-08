<?php

/**
 * Esta clase representa a un grupo de empleados y
 * almacena y permite acceso a todos los permisos
 * a los que tiene acceso el grupo de empleados.
 */
class GrupoEmpleados
{
    /**
     * Identificador del grupo de empleados (usuarios).
     * 
     * @var string
     */
    protected $id;

    /**
     * Grupo de empleados (usuarios) del que herada este grupo de empleados (usuarios).
     * 
     * @var \GrupoEmpledos
     */
    protected $padre;

    /**
     * Permisos asignados a este grupo de empleados (usuarios)
     * 
     * @var array
     */
    protected $permisos;

    /**
     * Constructor
     * 
     * @param string $id Identificador del grupo de empleados (usuarios)
     * @param GrupoEmpleados|null $padre Grupo empleados (usuarios) del que hereda este grupo.
     * @param Permiso[] $permisos Permisos asociados a este grupo
     */
    public function __construct($id, $padre, $permisos)
    {
        $this->setId($id);
        $this->setPadre($padre);
        $this->setPermisos($permisos);
    }

    /**
     * Devuelve el identificador del grupo de empleados.
     * 
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Fija el valor del identificador del grupo de empleados.
     * 
     * @param string $id
     * 
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Devuelve el grupo padre de este grupo.
     * 
     * @return GrupoEmpleados
     */
    public function getPadre()
    {
        return $this->padre;
    }

    /**
     * Fija el padre de este grupo.
     * 
     * @param GrpoEmpleados
     * 
     * @return void
     */
    public function setPadre($padre)
    {
        $this->padre = $padre;
    }

    /**
     * Devuelve los permisos de este grupo.
     * 
     * @return Permiso[]
     */
    public function getPermisos()
    {
        return $this->permisos;
    }

    /**
     * Fija los permisos de este grupo.
     */
    public function setPermisos($permisos)
    {
        $this->permisos = $permisos;
    }

    public function tienePermiso($permiso)
    {

        if (in_array($permiso, $this->permisos)) {
            return true;
        }

        $padre = $this->getPadre();

        while ($padre !== null) {
            if (in_array($permiso, $padre->getPermisos())) {
                return true;
            }

            $padre = $padre->getPadre();
        }

        return false;
    }
}