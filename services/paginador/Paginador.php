<?php

class Paginador
{
    protected $tabla;

    /**
     * Página actual
     * 
     * @var int
     */
    protected $pagina;

    /**
     * Límite de elementos por página
     * 
     * @var int
     */
    protected $limite;

    /**
     * Array que contiene los elementos a mostrar.
     * 
     * @var array
     */
    protected $elementos;

    /**
     * El número total de elementons encontrados
     * 
     * @var int
     */
    protected $total;

    protected $maxPaginas = 9;

    /**
     * Constructor
     * 
     * @param array $elementos Array que contiene los elementos a mostrar.
     * @param int $pagina Página actual
     * @param int $limite Límite de elementos por página
     */
    public function __construct($elementos, $pagina, $limite)
    {
        $this->elementos = $elementos;
        $this->pagina = (int) $pagina;
        $this->limite = (int) $limite;
        $this->total = count($elementos);
    }

    /**
     * Fija la página actual.
     * 
     * @param int $pagina
     */
    public function setPaginaActual($pagina)
    {
        $this->pagina = $pagina;
    }

    /**
     * 
     */
    public function getInicio()
    {
        return $this->limite * ($this->pagina - 1);
    }

    /**
     * 
     */
    public function getNumeroElementos()
    {
        return count($this->elementos);
    }

    /**
     * 
     */
    public function getElementos()
    {
        return array_slice($this->elementos, $this->getInicio(), $this->limite);
    }

    public function setElementos($elementos)
    {
        $this->elementos = $elementos;
    }

    /**
     * 
     */
    public function getNumeroTotalPaginas()
    {
        return (int) ceil($this->getNumeroElementos() / $this->limite);
    }

    /**
     * Inserta un paginador en el html
     * 
     * @param string $seccion String con el nombre de la sección en la que estamos (dentro de la web)
     * @param array $datos Array con los datos necesarios para que el paginador funciones y pueda calcular el número de páginas a mostrar.
     *  - 'limite': numero de elementos que se van a mostrar por cada página.
     *  - 'total': número total de elementos que hay.
     * 
     * @return void No devuelve ningún valor.
     */
    public function mostrarPaginador($seccion)
    {
        $total = $this->total;
        // Creamos el link para el paginador, necesita agregarle la página, pero eso se hace en el propio archivo de html.
        // NOTA: se le agrega la '/' antes de 'biblioteca' para que se genere un link relativo al host base. 'localhost'
        // Si no le agregamos ese '/', el link que generará será relativo a la ubicación en la que nos encontremos ahora (en el navegador web)
        $link = "/" . $seccion . "/index.php?limite=" . $this->limite;

        $minPagina = 1;
        if ($this->pagina > $this->maxPaginas) {
            $minPagina = $this->pagina - (int)($this->maxPaginas / 2);
        }

        $maxPagina = $minPagina + $this->maxPaginas;
        if ($maxPagina >= $this->getNumeroTotalPaginas()) {
            $maxPagina = $this->getNumeroTotalPaginas();
        }

        // Si se han generado más de una página, mostramos el paginador.
        if ($this->getNumeroTotalPaginas() > 1) {
            // monstramos el html paginador.
            require(__DIR__ . "/view/paginacion.php");
        }
    }
}