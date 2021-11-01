<?php

class AppError
{
    const ERROR_GENERAL = 0;
    const ERROR_NO_ENCONTRADO = 1;

    /**
     * Tipo de error producido.
     * 
     * @var int
     */
    protected $tipo;

    /**
     * Título de la página del error.
     * 
     * @var string
     */
    protected $titulo;

    /**
     * Mensaje del error.
     * 
     * @var string
     */
    protected $mensaje;

    /**
     * Excepcion del mensaje
     * 
     * @var \Excepcion|null
     */
    protected $excepcion;

    /**
     * Archivo que contiene la plantilla del la página
     * de error.
     * 
     * @var string
     */
    protected $plantillas = [
        self::ERROR_GENERAL => __DIR__ . "/../view/error/error.phtml",
        self::ERROR_NO_ENCONTRADO => __DIR__ . "/../view/error/error404.phtml",
    ];

    /**
     * Constructor
     * 
     * @param string $titulo Título que se mostrará en el error.
     * @param string $mensaje Mensaje que se mostrará en el error.
     */
    public function __construct($titulo, $mensaje, $excepcion = null, $tipo = self::ERROR_GENERAL)
    {
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
        $this->excepcion = $excepcion;
        $this->tipo = $tipo;
    }

    /**
     * Devuelve el tipo de error producido
     * 
     * @return int
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Fija el tipo de error producido.
     * 
     * @param int $tipo
     * 
     * @return void
     */
    public function setTipo($tipo)
    {
        $this->tipo = (int) $tipo;
    }

    /**
     * Devuelve el mensaje de error.
     * 
     * @return string.
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Fija el valor del mensaje de este error.
     * 
     * @param string $mensaje
     * 
     * @return void
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * Devuelve el título del error.
     * 
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Fija el valor del título de este error.
     * 
     * @param string $titulo
     * 
     * @return void
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Devuelve la excepción del error
     * 
     * @return \Exception|null
     */
    public function getExcepcion()
    {
        return $this->excepcion;
    }

    /**
     * Fija el valor de la excepción de este error.
     * 
     * @param \Exception|null
     * 
     * @return void
     */
    public function setExcepcion($excepcion)
    {
        $this->excepcion = $excepcion;
    }

    /**
     * Muestra la página con el error.
     * 
     * @return mixed
     */
    public function mostrarError()
    {
        // Con esto nos aseguramos que la plantilla recoge el error para mostrarlo.
        $error = $this;

        // Cargamos la plantilla como contenido de la página.
        $contenido = $this->plantillas[$this->tipo];

        // Mostramos la página.
        return require __DIR__ . '/../view/pagina.phtml';
    }

    /**
     * 
     */
    public static function error($titulo, $mensaje, $excepcion = null)
    {
        $error = new static($titulo, $mensaje, $excepcion);

        return $error;
    }
}