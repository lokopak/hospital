<?php

require_once(__DIR__ . "/ArraySerializable.php");

/**
 * Clase que sirve como base para cualquier otra 
 * clase que represente una entidad de una tabla
 * en la base de datos.
 * 
 * Se define como abstracta dado que no se espera que
 * exista ningún objeto de esta clase.
 */
abstract class Entidad implements ArraySerializable
{
    /**
     * Id de la entidad
     * 
     * @var int
     */
    protected $id;

    /**
     * Array que contiene los campos / atributos
     * que no se rellenaran mediante la función
     * "rellenar()" para evitar sobre escribirlos
     * de forma incontrolada.
     * 
     * En el caso de cualquier entidad de la una tabla
     * de la base de datos, no se quiere que bajo ningún
     * concepto se pueda alterar la PRIMARY KEY.
     */
    protected $noRellenar = [
        'id'
    ];

    /**
     * Array que contiene los campos / atributos
     * que no se rellenaran mediante la función
     * "to 
     */
    protected $noDevolver = [];

    /**
     * Devuelve la id del objeto.
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Cambia el valor de la id del objeto.
     * 
     * NOTA: Este método sólo debería llamarse
     * una vez al instanciar el objeto.
     * 
     * @param int $id La nueva id.
     * 
     * @return void
     */
    public function setId($id)
    {
        // Para proteger la integridad de la base de datos,
        // impedimos que si sa está asignada la id, no se pueda
        // volver a reasignar.
        if ($this->id) {
            return;
        }

        $this->id = $id;
    }

    /**
     * Rellena los campos de una variable Entidad
     * usando los valores porporcionados en el array.
     * 
     * NOTA: Antes de llamar a este método, todos los valores
     * proporcionados en el array deben ser filtrados y validados.
     * 
     * @param array $array Datos para rellenar la variable.
     */
    public function rellenarConArray($array)
    {
        // Si la variable $array no es un array o está vacío, no hay nada que hacer.
        if (!is_array($array) || empty($array)) {
            return;
        }

        // Recorremos el array proporcionado para obtener todos los valores que se le asignarán a los campos de este objeto.
        foreach ($array as $indice => $valor) {
            // Ignoramos los campos que están en "noRellenar"
            if (in_array($indice, $this->noRellenar)) {
                continue;
            }

            // Puesto que usamos camel case en todas los nombres de columnas, no hace falta de momento sustituir guiones.
            // Por lo que convertimos el nombre del índice en StudlyCase y le agregamos el prefijo "set" para convertirlo
            // en el nombre equivalente del método set.
            // ejem: "nombreUsuario" => "NombreUsuario" => "setNombreUsuario"
            $metodo = 'set' . ucfirst($indice);

            // La función "property_exists" comprueba si la clase indicada o a la que pertece un objeto tiene un propiedad/atributo en concreto.
            // En este caso comprobamos si este objeto en cuestión tiene un atributo que coincida con el nombre del ídice correspondiente del array.
            if (property_exists($this, $indice)) {
                // En caso de que así sea, mediante la forma $this->{$indice} hacemos que el string del índice funcione como nombre de atributo directamente.
                // y así asignar el valor a dicho atributo.
                $this->{$indice} = $valor;
                // En caso de que no tenga ese atributo (por error o intencionadamente) comprobamos en su lugar que tenga un metodo "set" correspondiente.
            } else if (method_exists($this, $metodo)) {
                // Si lo tiene, mediante $this->$metodo($valor) convertimos el string $metodo en una llamada al método directamente.
                $this->$metodo($valor);
            }
            // En caso contrario, simplemente continuamos.
        }
    }

    /**
     * Devuelve un array con los valores visibles de este
     * objeto.
     * 
     * @return array
     */
    public function toArray()
    {
        $array = [];
        // Mediante la función "get_object_vars" obtenemos el nombre
        // de todos los atributos de la clase a la que pertenece el objeto.
        // en forma de array. Recorremos este array para obtener un
        // array con los índices equivalentes a los nombres y con los
        // valores que dicho objeto tiene asignados.
        foreach (get_object_vars($this) as $propiedad => $valor) {
            // Si la propiedad está incluida en el array "noDevolver", simplemente continuamos.
            if (in_array($propiedad, $this->noDevolver)) {
                continue;
            }

            // Agregamos el valor usando como índice el nombre de la propiedad / atributo
            $array[$propiedad] = $valor;
        }

        // Devolvemos el array obtenido
        return $array;
    }
}