<?php

return [
    'datos_dietas' => [
        'normal' => [
            'nombre' => 'Normal',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ]
            ],
        ],
        'absoluta' => [
            'nombre' => 'Absoluta'
        ],
        'astringente' => [
            'nombre' => 'Astringente',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal',
                    'hijas' => [
                        'astringente_hemodialisis' => [
                            'nombre' => 'Astringente hemodiálisis'
                        ]
                    ]
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal',
                    'hijas' => [
                        'astringente_hemodialisis' => [
                            'nombre' => 'Astringente hemodiálisis'
                        ],
                    ],
                ],
            ],
        ],
        'baja_en_potasio' => [
            'nombre' => 'Baja en potasio',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ],
            ],
        ],
        'baja_en_proteinas' => [
            'nombre' => 'Baja en proteinas',
            'hijas' => [
                'hijas' => [
                    'con_sal' => [
                        'nombre' => 'Con sal'
                    ],
                    'sin_sal' => [
                        'nombre' => 'Sin sal'
                    ],
                ],
            ],
        ],
        'diabetica' => [
            'nombre' => 'Diabética',
            'hijas' => [
                'hijas' => [
                    'con_sal' => [
                        'nombre' => 'Con sal',
                        'hijas' => [
                            'cal1500' => [
                                'nombre' => '1500 calorías',
                            ],
                            'cal2000' => [
                                'nombre' => '2000 calorías',
                            ],
                        ],
                    ],
                    'sin_sal' => [
                        'nombre' => 'Sin sal',
                        'hijas' => [
                            'cal1500' => [
                                'nombre' => '1500 calorías',
                            ],
                            'cal2000' => [
                                'nombre' => '2000 calorías',
                            ],
                        ],
                    ]
                ],
            ],
        ],
        'dieta_de_transicion' => [
            'nombre' => 'Dieta de transición',
            'hijas' => [
                'hijas' => [
                    'con_sal' => [
                        'nombre' => 'Con sal',
                        'hijas' => [
                            'basal_astringente' => [
                                'nombre' => 'Basal astringente',
                            ],
                        ],
                    ],
                    'sin_sal' => [
                        'nombre' => 'Sin sal',
                        'hijas' => [
                            'basal_astringente' => [
                                'nombre' => 'Basal astringente',
                            ],
                        ],
                    ]
                ],
            ],
        ],
        'dieta_de_no_cerdo' => [
            'nombre' => 'Dieta de no cerdo',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ]
            ],
        ],
        'estricta_en_grasas' => [
            'nombre' => 'Estricta en grasas',
            'hijas' => [
                'hijas' => [
                    'con_sal' => [
                        'nombre' => 'Con sal',
                        'hijas' => [
                            'grasas_1' => [
                                'nombre' => 'Grasas 1',
                            ],
                            'grasas_2' => [
                                'nombre' => 'Grasas 2',
                            ],
                        ],
                    ],
                    'sin_sal' => [
                        'nombre' => 'Sin sal',
                        'hijas' => [
                            'grasas_1' => [
                                'nombre' => 'Grasas 1',
                            ],
                            'grasas_2' => [
                                'nombre' => 'Grasas 2',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'facil_digestion' => [
            'nombre' => 'Fácil digestion',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ]
            ],
        ],
        'facil_masticacion' => [
            'nombre' => 'Fácil masticación',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ]
            ],
        ],
        'hemodialisis' => [
            'nombre' => 'Hemodiálisis',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ]
            ],
        ],
        'ileostomia' => [
            'nombre' => 'Ileostómia',
            'hijas' => [
                'hijas' => [
                    'con_sal' => [
                        'nombre' => 'Con sal',
                        'hijas' => [
                            'ileostomia_1' => [
                                'nombre' => 'Ileostómia 1',
                            ],
                            'ileostomia_2' => [
                                'nombre' => 'Ileostómia 2',
                            ],
                        ],
                    ],
                    'sin_sal' => [
                        'nombre' => 'Sin sal',
                        'hijas' => [
                            'ileostomia_1' => [
                                'nombre' => 'Ileostómia 1',
                            ],
                            'ileostomia_2' => [
                                'nombre' => 'Ileostómia 2',
                            ],
                        ],
                    ]
                ],
            ],
        ],
        'liquida' => [
            'nombre' => 'Líquida',
            'hijas' => [
                'hijas' => [
                    'con_sal' => [
                        'nombre' => 'Con sal',
                        'hijas' => [
                            'liquida' => [
                                'nombre' => 'Líquida',
                            ],
                            'astringente' => [
                                'nombre' => 'Astringente',
                            ],
                            'bariatrica' => [
                                'nombre' => 'Bariátrica',
                            ],
                            'fria' => [
                                'nombre' => 'Fría',
                            ],
                        ],
                    ],
                    'sin_sal' => [
                        'nombre' => 'Sin sal',
                        'hijas' => [
                            'liquida' => [
                                'nombre' => 'Líquida',
                            ],
                            'astringente' => [
                                'nombre' => 'Astringente',
                            ],
                            'bariatrica' => [
                                'nombre' => 'Bariátrica',
                            ],
                            'fria' => [
                                'nombre' => 'Fría',
                            ],
                        ],
                    ]
                ],
            ],
        ],
        'pediatrica' => [
            'nombre' => 'Pediátrica',
            'hijas' => [
                'hijas' => [
                    'con_sal' => [
                        'nombre' => 'Con sal',
                        'hijas' => [
                            'pediatrica' => [
                                'nombre' => 'Pediátrica',
                            ],
                            'cal1500' => [
                                'nombre' => '1500 Calorías',
                            ],
                            'cal2000' => [
                                'nombre' => '2000 Calorías',
                            ],
                            'facil_masticacion' => [
                                'nombre' => 'Fácil masticación',
                            ],
                        ],
                    ],
                    'sin_sal' => [
                        'nombre' => 'Sin sal',
                        'hijas' => [
                            'pediatrica' => [
                                'nombre' => 'Pediátrica',
                            ],
                            'cal1500' => [
                                'nombre' => '1500 Calorías',
                            ],
                            'cal2000' => [
                                'nombre' => '2000 Calorías',
                            ],
                            'facil_masticacion' => [
                                'nombre' => 'Fácil masticación',
                            ],
                        ],
                    ]
                ],
            ],
        ],
        'pobre_grasa_colesterol' => [
            'nombre' => 'Pobre en grasa y colesterol',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ],
            ],
        ],
        'pobre_residuos' => [
            'nombre' => 'Pobre en residuos',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ],
            ],
        ],
        'proteccion_hepatica' => [
            'nombre' => 'Protección hepática',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ],
            ],
        ],
        'proteccion_gastrica' => [
            'nombre' => 'Protección gástrica',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ],
            ],
        ],
        'pure_pediatrico' => [
            'nombre' => 'Estricta en grasas',
            'hijas' => [
                'hijas' => [
                    'sin_sal' => [
                        'nombre' => 'Sin sal',
                        'hijas' => [
                            'pediatrico_1' => [
                                'nombre' => 'Pediátrico 1',
                            ],
                            'pediatrico_2' => [
                                'nombre' => 'Pediátrico 2',
                            ],
                            'pediatrico_3' => [
                                'nombre' => 'Pediátrico 3',
                            ],
                            'pediatrico_4' => [
                                'nombre' => 'Pediátrico 4',
                            ],
                            'astringente_1' => [
                                'nombre' => 'Pediátrico 1',
                            ],
                            'astringente_2' => [
                                'nombre' => 'Pediátrico 2',
                            ],
                            'astringente_3' => [
                                'nombre' => 'Pediátrico 3',
                            ],
                            'astringente_4' => [
                                'nombre' => 'Pediátrico 4',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'sin_gluten' => [
            'nombre' => 'Sin gluten',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ],
            ],
        ],
        'triturada' => [
            'nombre' => 'Triturada', 'hijas' => ['hijas' => ['nombre' => '']]
        ],
        'urologia' => [
            'nombre' => 'Urología',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ],
            ],
        ],
        'vegetal' => [
            'nombre' => 'Vegetal',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ],
            ],
        ],
        'ingreso' => [
            'nombre' => 'Ingreso',
            'hijas' => [
                'con_sal' => [
                    'nombre' => 'Con sal'
                ],
                'sin_sal' => [
                    'nombre' => 'Sin sal'
                ],
            ],
        ],
    ]
];