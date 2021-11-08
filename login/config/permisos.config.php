<?php

/**
 * Array con todos los permisos. Puesto que no se incluye en la
 * práctica el cambiar los permisos, vamos a mantener estos en este
 * array y acceder a ellos desde el gestor de permisos.
 */
return [
    // Array con todos los datos relativos a los permisos de la aplicación.
    'datos_permisos' => [
        // Lista de permisos de la aplicación. Se emplean para dar acceso o restringirlo a determinadas características de la aplicación.
        /** Los permisos los vamos a almacenar aquí en el formato:
         *      'SECCION' => [ACCIONES...]
         */
        'permisos' => [
            'APP' => [ // Control de permisos globales de la applicación.
                'VER', // Permite ver la página de inicio de la aplicación.
                'TOTAL', // Permite acceso total a la aplicación.
            ],
            'EMPLEADOS' => [ // Control de permisos para la seccion de 'Empleados'
                'VER', // Permite ver el listado de empleados.
                'CREAR', // Permite crear (dar de alta) nuevos empleados en la aplicación.
                'EDITAR', // Permite editar los datos de los empleados.
                'BORRAR', // Permite borrar empleados de la aplicación.
                'VER_PROPIO', // Permite ver los datos propios.
                'EDITAR_PROPIO', // Permite editar los datos propios.
            ],
            'PACIENTES' => [ // Control de permisos para la seccion de 'Pacientes'
                'VER', // Permite ver el listado de pacientes.
                'CREAR', // Permite crear (dar de alta) nuevos pacientes en la aplicación.
                'EDITAR', // Permite editar los datos de los pacientes.
                'BORRAR', // Permite borrar pacientes de la aplicación.
                'ASIGNAR_DIETA', // Permite asignar/cambiar la dieta de los pacientes.
                'ASIGNAR_HABITACION', // Permite asignar/reasignar la habitación de los pacientes.
                'DAR_ALTA', // Permite dar de alta un paciente.
            ],
            'INFORMES' => [ // Control de permisos para la seccion de 'Informes'
                'VER', // Permite ver el listado de informes.
                'CREAR', // Permite agregar nuevas informes a de dietas.
                'EDITAR', // Permiete editar los informes de dietas.
                'BORRAR', // Permite borrar informes de dietas.
                'VER_PROPIOS', // Permite ver los datos propios.
            ],
        ],
        // Lista de permisos concedidos a cada grupo de empleados.
        'grupo_empleados' => [
            // De momento a las personas que acceden a la aplicación y no están logeadas, no se les otorga ningún permiso.
            'invitado' => [
                'padre' => null,
                'permitido' => [],
            ],
            // Permisos para todos los empleados en general. Cualquier persona con acceso a la aplicación. Heredan los permisos de los invitados.
            'empleado' => [
                'padre' => 'invitado',
                'permisos' => [
                    'APP@VER', // Tiene acceso a ver la página de inicio de la aplicación.
                    'EMPLEADOS@VER_PROPIO', // Tiene acceso a ver sus propios datos.
                    'EMPLEADOS@EDITAR_PROPIO' // Tiene acceso a editar sus datos propios (incluyendo la contraseña)
                ],
            ],
            // Permisos exclusivos para Celadores. Además de los que se incluyen aquí, heredan los permisos de los empleados.
            'celador' => [
                'padre' => 'empleado',
                'permitido' => [
                    'PACIENTES@VER', // El celador tiene acceso a ver listados de pacientes.
                    'INFORMES@VER_PROPIOS', // El celador tiene acceso a ver sus propios informes.
                    'INFORMES@CREAR', // El celador tiene acceso a crear sus propios informes.
                ],
            ],
            // Permisos exclusivos para Nutricionistas. Además de los que se incluyen aquí, heredan los permisos de los celadores.
            'nutricionista' => [
                'padre' => 'celador',
                'permitido' => [
                    'INFORMES@VER', // El nutricionista tiene acceso a ver listados de informes.
                    'INFORMES@EDITAR', // El nutricionista tiene acceso a editar informes.
                    'PACIENTES@ASIGNAR_DIETA', // El nutricionista tiene acceso a asignar/cambiar la dieta de los pacientes.
                ],
            ],
            // Permisos exclusivos para los Administradores. Además de los que se incluyen aquí, heredan los permisos de los celadores.
            'administrador' => [
                'padre' => 'nutricionista',
                'permitido' => [
                    'APP@TOTAL', // De momento le damos permiso total al administrador.
                ],
            ],
        ],
    ],
];