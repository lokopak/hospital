<?php

require_once(__DIR__ . "/Dieta.php");

/**
 * La clase TablaDieta se encarga de gestionar todas
 * las dietas de la aplicación.
 * 
 * Aunque en un principio las dietas no es necesario
 * manejarlas dentro de la base de datos, puesto que
 * no se van a realizar cambios sobre ellas, por un
 * lado, en previsión de un posible cambio en ese 
 * aspecto y, por otro, necesitamos un elemento
 * que nos proporcione acceso y control sobre el grupo
 * de dietas.
 */
class TablaDieta
{
    /**
     * Dietas de la aplicación.
     * 
     * Para no tener que andar accediendo al archivo
     * en el que se encuentran las dietas cada
     * vez que haya que obtener las dietas a lo largo
     * de la ejecución de la aplicación, la guardamos
     * temporalmente en esta propiedad (atributo / variable)
     * y para ello la declaramos 'static' de forma que 
     * con una sola vez que se cargen es suficiente.
     * Aunque se creen varios objetos de esta clase.
     * 
     * La declaramos y na inicializamos a un array vacío
     * por si existe algún problema con el archivo en el que
     * se encuentran almacenadas y no se pueden cargar
     * correctamente, evitamos posibles fallos.
     * 
     * @var Dieta[]
     */
    protected $listaDietas = [];

    /**
     * Instancia del único objeto que se puede crear de esta clase.
     * 
     * @var TablaDieta
     */
    protected static $instancia;

    /**
     * Constructor
     */
    private function __construct()
    {
        // Si no hay ninguna dieta, provemos a cargarlas desde el archivo
        // Si todo ha ido bien solo será necesario hacerlo una vez por ejecución
        // de la aplicación.
        $this->cargarDietas();
    }

    /**
     * Carga todas las dietas que se encuentren en el archivo
     * 'dietas.config.php' en la carpeta config.
     * 
     * @return void
     */
    private function cargarDietas()
    {
        // Cargamos la lista de dietas de la aplicación desde el archivo.
        // usamos include en este caso para evitar que en caso de que el 
        // archivo no se encuentre por algún inprevisto, no obtengamos ningún
        // error.
        $dietas = include __DIR__ . "/../config/dietas.config.php";

        // Si el archivo no se encuentra, está vacío o en contenido del array
        // de dietas está vacío, no hay nada más que hacer...
        if (empty($dietas['datos_dietas'])) {
            return;
        }

        // Damos formato a las dietas y generamos los objetos.
        // Empleamos esta forma de foreach puesto que el nombre de la dieta
        // lo hemos usado en el array como índice, tenemos que recogerlo también
        // para generar correctamente el objeto Dieta.
        foreach ($dietas['datos_dietas'] as $indice => $valor) {
            // Al ser la primera llamada a esta función, no enviamos el parámetro $madre
            // De esta forma indicamos que es una clase madre y la recursividad hará el resto.
            $dieta = $this->generarDieta($indice, $valor);

            $this->listaDietas[$indice] = $dieta;
        }
    }

    /**
     * Genera una nueva dieta con el nombre y datos indicados.
     * 
     * @param string $nombre El nombre de la dieta
     * @param mixed $datos El array con los datos de la dieta.
     * 
     * @return Dieta
     */
    private function generarDieta($nombre, $datos, $madre = null)
    {
        // Eliminamos posibles espacioes del nombre de la dieta.
        $nombre = trim($nombre);

        // $descripción = isset($datos['descripcion']) ? $datos['descripcion'] : '';
        $descripción = isset($datos['descripcion']) ? $datos['descripcion'] : 'no-descripcion';

        // Si es una clase hija, el parámetro $nombre vendrá con el valor del nombre de la madre.
        // Para pasárselo a las posibles hijas de esta clase, le contatenamos con el nombre de 
        // esta dieta insertando entre el nombre de la madre y el de la dieta hija un carácter '@'.
        // Esto nos dará como nombre de madre algo así 'nombreAbuela@nombreMadre'
        if (null !== $madre) {
            $nombre = sprintf("%s@%s", $madre, $nombre);
        }

        $hijas = [];
        // Si encontramos hijas en los datos. Generamos las hijas y las almacenamos en el array de hijas.
        // Esto se hace de forma recursiva, por lo que no necesitamos preocuparnos de si las hijas tienen hijas
        // puesto que al volver a llamar a esta función de forma recursiva, se hace automáticamente.
        if (!empty($datos['hijas'])) {
            // Recorremos todas las hijas encontradas en el array de hijas
            foreach ($datos['hijas'] as $indice => $valores) {
                // Generamos una nueva Dieta y la guardamos en el array de hijas. En 
                $hija = $this->generarDieta($indice, $valores, $nombre);
                $hijas[$hija->getNombre()] = $hija;
            }
        }

        return new Dieta($nombre, $descripción, $hijas, $madre);
    }

    /**
     * Devuelve las dietas almacenadas en esta clase.
     * 
     * @return Dieta[]
     */
    public function getDietas()
    {
        return $this->listaDietas;
    }

    /**
     * Devuelve la instancia del único objeto
     * que se puede crear de esta clase.
     * 
     * @return TablaDieta
     */
    public static function getInstancia()
    {
        if (!static::$instancia) {
            static::$instancia = new TablaDieta();
        }

        return static::$instancia;
    }

    /**
     * Devuelve la dieta que corresponde al nombre indicado.
     * 
     * @param string $nombre Nombre de la dieta.
     * 
     * @return Dieta|null
     */
    public function getDietaPorNombre($nombre, $dietas = [])
    {
        print_r('<pre>');
        print_r([$nombre, $dietas]);
        print_r('</pre>');
        // Verificamos que el nombre no es un string vacío
        $nombre = trim($nombre);
        if (empty($nombre)) {
            return null;
        }

        // Dividimos el nombre de la dieta en sub-nombres
        $nombres = explode('@', $nombre);

        // Si no se proporciona un array de dietas (buscamos una dieta hija1 o hija2) buscamos en el array general.
        if (empty($dietas)) {
            $dietas = $this->listaDietas;
        }

        if (isset($dietas[$nombres[0]])) {
            $dieta = $dietas[$nombres[0]];
            if (count($nombres) > 1 && $dieta->tieneHijas()) {
                foreach ($dieta->getHijas() as $hija) {
                    // Si hemos encontrado la dieta que buscábamos, la devolvemos.
                    if (strcmp($hija->getNombre(), $nombre) === 0) {
                        return $hija;
                    }
                    if (count($nombres) > 1 && $hija->tieneHijas()) {
                        foreach ($hija->getHijas() as $nieta) {
                            // Si hemos encontrado la dieta que buscábamos, la devolvemos.
                            if (strcmp($nieta->getNombre(), $nombre) === 0) {
                                return $nieta;
                            }
                        }
                    }
                }
            }

            return $dieta;
        }

        return null;
    }
}