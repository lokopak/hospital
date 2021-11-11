<?php

class Messenger
{

    /**
     * Variable global donde se guardarán los mensajes que surjan durante la ejecución de
     * la aplicación y que serán mostrados una vez termine.
     */
    protected $mensajes = [];

    /**
     * The uniq instance of this class
     */
    protected static $instance = null;

    /**
     * Constructor
     */
    private function __construct()
    {
    }

    /**
     * Returns the instance
     * 
     * @return \Library\Core\Error\ErrorReporter
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Messenger();
        }

        return self::$instance;
    }

    /**
     * Agrega un nuevo mensaje a la lista de mensajes a mostrar.
     * 
     * @param $texto String con el texto del error.
     * @param $tipo String indicando el tipo de error:
     *  - 'success' : Cuando el mensaje indica que algo ha pasado correctamente.
     *  - 'danger' : Cuando el mensaje indica que ha habido un error grave.
     *  - 'info' : Cuando el mensaje simplemente muestra información sobre algo.
     *  - 'warning' : Cuando el mensaje indica que ha sucedido algo que no es grave pero a lo que hay que prestarle atención.
     * 
     * @return void - No devuelve ningún valor
     */
    public function agregarMensaje($texto, $tipo)
    {
        $mensaje["mensaje"] = $texto;
        $mensaje["tipo"] = $tipo;

        // Insertamos el mensaje al final del array de mensajes.
        // Si no se le indica un índice cuando se asignan valores a un array, se genera un nuevo índice al final del array.
        $this->mensajes[] = $mensaje;
    }

    /**
     * Devuelve true si hay mensajes para mostrar
     * o false si no hay ningún mensaje para mostrar.
     * 
     * @return boolean Indica si el array de errores contiene algún elemento.
     */
    public function hayMensajes()
    {

        // Devuelve el resultado de la comparación '>' (mayor que)
        return count($this->mensajes) > 0;
    }

    /**
     * Muestra los mensajes encontrados. Una vez
     * se han mostrado. Los borra para la siguiente,
     * ejecución de la aplicacion.
     * 
     * @return void - No devuelve ningún valor.
     */
    public function mostrarMensajes()
    {
        // Si hay errores para mostrar los agrega al html.
        if ($this->hayMensajes()) {

            // Mostramos el html del error.
            // __DIR__ es una consante que indica el direcctorio donde está este archivo, para poder encontrar correctamente el archivo
            // desde cualquier parte de la apliación.
            require(__DIR__ . "/view/mensaje.php");

            // Eliminamos todos los mensajes
            $this->mensajes = [];
        }
    }
}