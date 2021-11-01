<?php

class InyectorScript
{

    /**
     * Atributo de clase donde guardaremos el único objeto
     * que puede crearse de la clase InyectorScript.
     * Lo declaramos static para que pertenezca a la clase
     * en sí y poder acceder a él sin necesidad de instanciar
     * un objeto.
     * 
     * @var \InyectorScript
     */
    protected static $instancia;

    /**
     * Array que contiene todos los scripts que se inyectarán 
     * al final de la plantilla de la página.
     */
    protected $scripts = [];

    /**
     * Constructor
     * Lo declaramos privado para que sólo puedan crearse
     * objetos de la clase InyectorScript desde dentro de la
     * propia clase.
     */
    private function __construct()
    {
    }

    /**
     * Agrega un nuevo script js a la lista de scripts
     * que se inyectarán en la página.
     * 
     * @param string $script
     * 
     * @return void
     */
    public function agregarScript($script)
    {
        $this->scripts[] = $script;
    }

    /**
     * Inyecta todos los scripts que se hayan agregado.
     * 
     * @return void
     */
    public function inyectarScripts()
    {
        foreach ($this->scripts as $script) {
            echo $script;
        }
    }

    /**
     * Devuelve el único objeto de la clase InyectorScript
     * que puede existir.
     * 
     * @return \InyectorScript
     */
    public static function getInstancia()
    {
        // Si no se ha instanciado ya...
        if (!static::$instancia) {
            // Instanciamos el objeto y lo guardamos en el atributo correspondiente.
            static::$instancia = new static();
        }

        return static::$instancia;
    }
}