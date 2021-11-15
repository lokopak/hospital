<?php

abstract class Controlador
{
    /**
     * Ruta de acceso absoluta a los archivos de la vista para
     * este controlador.
     * 
     * @var string
     */
    protected $viewPath = __DIR__ . "/../view/pagina.phtml";

    /**
     * Plantilla que con el contenido a mostrar en la página
     * 
     * @var string
     */
    protected $plantilla = null;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Devuelve la ruta de acceso a los archivos de la vista
     * para este controlador.
     * 
     * @return string
     */
    public function getViewPath()
    {
        return $this->viewPath;
    }

    /**
     * Fija la ruta de acceso a los archivos de la vista
     * para este controlador.
     * 
     * @param string $viewPath La ruta de los archivos.
     */
    public function setViewPath($viewPath)
    {
        $this->viewPath = $viewPath;
    }

    /**
     * Devuelve la plantilla correspondiente
     * 
     * @return string
     */
    public function getPlantilla()
    {
        return $this->plantilla;
    }

    /**
     * Fija la plantilla a mostrar con el contenido 
     * de la página.
     * 
     * @param string $plantilla La plantilla a mostrar.
     */
    public function setPlantilla($plantilla)
    {
        $this->plantilla = dirname((new ReflectionClass(get_class($this)))->getFileName()) . "/../view/" . $plantilla . '.phtml';
    }

    /**
     * Devuelve la vista correspondiente
     * 
     * @return \View
     */
    protected function mostrarHtml($__variables = [])
    {
        // Crea las variables necesarias de forma local.
        extract($__variables);
        // Remueve la variable $__variables para liberar memoria
        unset($__variables);

        try {
            // Iniciamos el buffer de salida para capturar el contenido del archivo.
            ob_start();
            // Cargamos el contenido del archivo que se mostrará dentro de la página para capturar el resultado.
            require $this->getPlantilla();
            // Recogemos el contenido desde el buffer de salida y cerramos el buffer.
            $contenido = ob_get_clean();
            // Ahora que ya tenemos el contenido en un string, lo devolvemos.
            return require $this->getViewPath();
        } catch (Throwable $e) {
            return (new AppError("Archivo no encontrado", "No se ha enocontrado el archivo $nombreArchivo"))->mostrarError();
        } catch (Exception $e) {
            return (new AppError("Archivo no encontrado", "No se ha enocontrado el archivo $nombreArchivo"))->mostrarError();
        }
    }
}