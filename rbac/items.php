<?php
return [
    'administrador' => [
        'type' => 1,
        'children' => [
            'ver',
            'editar',
            'crear',
            'borrar',
        ],
    ],
    'gestor' => [
        'type' => 1,
        'children' => [
            'ver',
            'editar',
            'crear',
        ],
    ],
    'operador' => [
        'type' => 1,
        'children' => [
            'ver',
        ],
    ],
    'ver' => [
        'type' => 2,
    ],
    'editar' => [
        'type' => 2,
    ],
    'crear' => [
        'type' => 2,
    ],
    'borrar' => [
        'type' => 2,
    ],
];
