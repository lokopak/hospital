<?php

class Paginador
{
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
     * Array que contiene los elementos del paginador.
     * 
     * @var array
     */
    protected $elementos;

    /**
     * El número total de elementons en el paginador
     * 
     * @var int
     */
    protected $total;

    /**
     * Número máximo de páginas que se mostrarán en
     * el paginador.
     * 
     * @var int
     */
    protected $maxPaginas = 10;

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
     * Devuelve en número de la página actual
     * del paginador.
     * 
     * @return int
     */
    public function getPaginaAcutal()
    {
        return $this->pagina;
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
     * Devuelve el primer elemento que se mostrará en la página
     * actual.
     * 
     * @return int
     */
    public function getPrimerElemento()
    {
        return $this->limite * ($this->pagina - 1);
    }

    /**
     * Devuelve el número total de elementos en el paginador.
     * 
     * @return int
     */
    public function getNumeroTotalElementos()
    {
        return count($this->elementos);
    }

    /**
     * Devuelve los elementos de la página actual
     * del paginador.
     * 
     * @return array
     */
    public function getElementosActuales()
    {
        return array_slice($this->elementos, $this->getPrimerElemento(), $this->limite);
    }

    /**
     * Devuelve todos los elementos del paginador.
     * 
     * @return array
     */
    public function getElementos()
    {
        return $this->elementos;
    }

    /**
     * Asigna los elementos a mostrar en el paginador.
     * 
     * @param array $elementos
     * 
     * @return void
     */
    public function setElementos($elementos)
    {
        $this->elementos = $elementos;
    }

    /**
     * Devuelve el número total de páginas dependiendo del
     * número total de elementos y del límite de elementos por
     * página indicado.
     * 
     * @return int
     */
    public function getNumeroTotalPaginas()
    {
        return (int) ceil($this->getNumeroTotalElementos() / $this->limite);
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
        // Creamos el link para el paginador, necesita agregarle la página, pero eso se hace en el propio archivo de html.
        // NOTA: se le agrega la '/' antes de la sección para que se genere un link relativo al host base.
        // Si no le agregamos ese '/', el link que generará será relativo a la ubicación en la que nos encontremos ahora (en el navegador web)
        $link = "/" . $seccion . "/index.php?limite=" . $this->limite;

        // Asignamos el número de página más pequeño a mostrar en el grupo actual.
        $minPagina = 1;
        if ($this->pagina > $this->maxPaginas) {
            $minPagina = $this->pagina - (int)($this->maxPaginas / 2);
        }

        // Asignamos el número de pagina más alto a mostrar en el grupo actual.
        $maxPagina = $minPagina + $this->maxPaginas;
        if ($maxPagina >= $this->getNumeroTotalPaginas()) {
            $maxPagina = $this->getNumeroTotalPaginas();
            // Para mantener la cantidad de páginas que se muestran en '$this->maxPaginas', una vez tengamos la última página en rango
            // debemos mantener la página mostrada al comienzo del grupo fija para que se muestren '$this->maxPaginas' siempre.
            $minPagina = $maxPagina - $this->maxPaginas;
        }

        // Si se han generado más de una página, mostramos el paginador.
        if ($this->getNumeroTotalPaginas() > 1) {
            // monstramos el html paginador.
            require(__DIR__ . "/view/paginacion.php");
        }
    }
}