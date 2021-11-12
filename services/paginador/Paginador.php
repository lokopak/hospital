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

    protected $maxPaginas = 10;

    /**
     * Constructor
     * 
     * @param int $pagina Página actual
     * @param int $limite Límite de elementos por página
     * @param array $elementos Array que contiene los elementos a mostrar.
     * @param int $total El número total de elementons encontrados
     */
    public function __construct($pagina, $limite, $elementos, $total)
    {
        $this->pagina = (int) $pagina;
        $this->limite = (int) $limite;
        $this->elementos = $elementos;
        $this->total = (int) $total;
    }

    public function getElementos()
    {
        return $this->elementos;
    }

    public function setElementos($elementos)
    {
        $this->elementos = $elementos;
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
        $limite = $this->limite;
        $total = $this->total;
        // Creamos el link para el paginador, necesita agregarle la página, pero eso se hace en el propio archivo de html.
        // NOTA: se le agrega la '/' antes de 'biblioteca' para que se genere un link relativo al host base. 'localhost'
        // Si no le agregamos ese '/', el link que generará será relativo a la ubicación en la que nos encontremos ahora (en el navegador web)
        $link = "/" . $seccion . "/index.php?limite=" . $limite;

        // Calculamos el número de páginas que hay en total.
        // La función 'ceil' redondea un número de forma que si es .5 o mayor redondea al más alto.
        // Como 'ceil' siempre devuelve un float (decimal), nos aseguramos de que el valor se convierte en un entero mediante (int)
        $numeroPaginas = (int) ceil($total / $limite);

        $maxPaginas = $this->maxPaginas;
        if ($numeroPaginas > $this->maxPaginas) {
            $maxPaginas = $this->maxPaginas;
        }

        $minPagina = $this->pagina - ($maxPaginas / 2);
        if ($minPagina < 1) {
            $minPagina = 1;
        }
        $maxPagina = $this->pagina + ($maxPaginas / 2);

        // Si se han generado más de una página, mostramos el paginador.
        if ($numeroPaginas > 1) {
            // monstramos el html paginador.
            require(__DIR__ . "/view/paginacion.php");
        }
    }
}