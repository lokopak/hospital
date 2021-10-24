<?php

return [
    'datos_dietas' => [
        'normal' => [
            'descripcion' => 'Normal',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ]
            ],
        ],
        'absoluta' => [
            'descripcion' => 'Absoluta'
        ],
        'astringente' => [
            'descripcion' => 'Astringente',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal',
                    'hijas' => [
                        'astringente_hemodialisis' => [
                            'descripcion' => 'Astringente hemodiálisis'
                        ]
                    ]
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal',
                    'hijas' => [
                        'astringente_hemodialisis' => [
                            'descripcion' => 'Astringente hemodiálisis'
                        ],
                    ],
                ],
            ],
        ],
        'baja_en_potasio' => [
            'descripcion' => 'Baja en potasio',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ],
            ],
        ],
        'baja_en_proteinas' => [
            'descripcion' => 'Baja en proteinas',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ],
            ],
        ],
        'diabetica' => [
            'descripcion' => 'Diabética',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal',
                    'hijas' => [
                        'cal1500' => [
                            'descripcion' => '1500 calorías',
                        ],
                        'cal2000' => [
                            'descripcion' => '2000 calorías',
                        ],
                    ],
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal',
                    'hijas' => [
                        'cal1500' => [
                            'descripcion' => '1500 calorías',
                        ],
                        'cal2000' => [
                            'descripcion' => '2000 calorías',
                        ],
                    ],
                ],
            ],
        ],
        'dieta_de_transicion' => [
            'descripcion' => 'Dieta de transición',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal',
                    'hijas' => [
                        'basal_astringente' => [
                            'descripcion' => 'Basal astringente',
                        ],
                    ],
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal',
                    'hijas' => [
                        'basal_astringente' => [
                            'descripcion' => 'Basal astringente',
                        ],
                    ],
                ],
            ],
        ],
        'dieta_de_no_cerdo' => [
            'descripcion' => 'Dieta de no cerdo',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ]
            ],
        ],
        'estricta_en_grasas' => [
            'descripcion' => 'Estricta en grasas',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal',
                    'hijas' => [
                        'grasas_1' => [
                            'descripcion' => 'Grasas 1',
                        ],
                        'grasas_2' => [
                            'descripcion' => 'Grasas 2',
                        ],
                    ],
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal',
                    'hijas' => [
                        'grasas_1' => [
                            'descripcion' => 'Grasas 1',
                        ],
                        'grasas_2' => [
                            'descripcion' => 'Grasas 2',
                        ],
                    ],
                ],
            ],
        ],
        'facil_digestion' => [
            'descripcion' => 'Fácil digestion',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ]
            ],
        ],
        'facil_masticacion' => [
            'descripcion' => 'Fácil masticación',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ]
            ],
        ],
        'hemodialisis' => [
            'descripcion' => 'Hemodiálisis',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ]
            ],
        ],
        'ileostomia' => [
            'descripcion' => 'Ileostómia',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal',
                    'hijas' => [
                        'ileostomia_1' => [
                            'descripcion' => 'Ileostómia 1',
                        ],
                        'ileostomia_2' => [
                            'descripcion' => 'Ileostómia 2',
                        ],
                    ],
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal',
                    'hijas' => [
                        'ileostomia_1' => [
                            'descripcion' => 'Ileostómia 1',
                        ],
                        'ileostomia_2' => [
                            'descripcion' => 'Ileostómia 2',
                        ],
                    ],
                ],
            ],
        ],
        'liquida' => [
            'descripcion' => 'Líquida',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal',
                    'hijas' => [
                        'liquida' => [
                            'descripcion' => 'Líquida',
                        ],
                        'astringente' => [
                            'descripcion' => 'Astringente',
                        ],
                        'bariatrica' => [
                            'descripcion' => 'Bariátrica',
                        ],
                        'fria' => [
                            'descripcion' => 'Fría',
                        ],
                    ],
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal',
                    'hijas' => [
                        'liquida' => [
                            'descripcion' => 'Líquida',
                        ],
                        'astringente' => [
                            'descripcion' => 'Astringente',
                        ],
                        'bariatrica' => [
                            'descripcion' => 'Bariátrica',
                        ],
                        'fria' => [
                            'descripcion' => 'Fría',
                        ],
                    ],
                ],
            ],
        ],
        'pediatrica' => [
            'descripcion' => 'Pediátrica',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal',
                    'hijas' => [
                        'pediatrica' => [
                            'descripcion' => 'Pediátrica',
                        ],
                        'cal1500' => [
                            'descripcion' => '1500 Calorías',
                        ],
                        'cal2000' => [
                            'descripcion' => '2000 Calorías',
                        ],
                        'facil_masticacion' => [
                            'descripcion' => 'Fácil masticación',
                        ],
                    ],
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal',
                    'hijas' => [
                        'pediatrica' => [
                            'descripcion' => 'Pediátrica',
                        ],
                        'cal1500' => [
                            'descripcion' => '1500 Calorías',
                        ],
                        'cal2000' => [
                            'descripcion' => '2000 Calorías',
                        ],
                        'facil_masticacion' => [
                            'descripcion' => 'Fácil masticación',
                        ],
                    ],
                ],
            ],
        ],
        'pobre_grasa_colesterol' => [
            'descripcion' => 'Pobre en grasa y colesterol',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ],
            ],
        ],
        'pobre_residuos' => [
            'descripcion' => 'Pobre en residuos',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ],
            ],
        ],
        'proteccion_hepatica' => [
            'descripcion' => 'Protección hepática',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ],
            ],
        ],
        'proteccion_gastrica' => [
            'descripcion' => 'Protección gástrica',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ],
            ],
        ],
        'pure_pediatrico' => [
            'descripcion' => 'Puré pediátrico',
            'hijas' => [
                'sin_sal' => [
                    'descripcion' => 'Sin sal',
                    'hijas' => [
                        'pediatrico_1' => [
                            'descripcion' => 'Pediátrico 1',
                        ],
                        'pediatrico_2' => [
                            'descripcion' => 'Pediátrico 2',
                        ],
                        'pediatrico_3' => [
                            'descripcion' => 'Pediátrico 3',
                        ],
                        'pediatrico_4' => [
                            'descripcion' => 'Pediátrico 4',
                        ],
                        'astringente_1' => [
                            'descripcion' => 'Astringente 1',
                        ],
                        'astringente_2' => [
                            'descripcion' => 'Astringente 2',
                        ],
                        'astringente_3' => [
                            'descripcion' => 'Astringente 3',
                        ],
                        'astringente_4' => [
                            'descripcion' => 'Astringente 4',
                        ],
                    ],
                ],
            ],
        ],
        'sin_gluten' => [
            'descripcion' => 'Sin gluten',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ],
            ],
        ],
        'triturada' => [
            'descripcion' => 'Triturada',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal',
                    'hijas' => [
                        'basal' => [
                            'descripcion' => 'Basal',
                        ],
                        'astringente' => [
                            'descripcion' => 'Astringente',
                        ],
                        'bariatrica' => [
                            'descripcion' => 'Bariátrica',
                        ],
                        'dialisis' => [
                            'descripcion' => 'Diálisis',
                        ],
                        'dialisis_astringente' => [
                            'descripcion' => 'Diálisis astringente',
                        ],
                        'predialisis' => [
                            'descripcion' => 'Prediálisis',
                        ],
                        'predialisis_astringente' => [
                            'descripcion' => 'Prediálisis astringente',
                        ],
                    ],
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal',
                    'hijas' => [
                        'basal' => [
                            'descripcion' => 'Basal',
                        ],
                        'astringente' => [
                            'descripcion' => 'Astringente',
                        ],
                        'bariatrica' => [
                            'descripcion' => 'Bariátrica',
                        ],
                        'dialisis' => [
                            'descripcion' => 'Diálisis',
                        ],
                        'dialisis_astringente' => [
                            'descripcion' => 'Diálisis astringente',
                        ],
                        'predialisis' => [
                            'descripcion' => 'Prediálisis',
                        ],
                        'predialisis_astringente' => [
                            'descripcion' => 'Prediálisis astringente',
                        ],
                    ],
                ],
            ],
        ],
        'urologia' => [
            'descripcion' => 'Urología',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ],
            ],
        ],
        'vegetal' => [
            'descripcion' => 'Vegetal',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ],
            ],
        ],
        'ingreso' => [
            'descripcion' => 'Ingreso',
            'hijas' => [
                'con_sal' => [
                    'descripcion' => 'Con sal'
                ],
                'sin_sal' => [
                    'descripcion' => 'Sin sal'
                ],
            ],
        ],
    ]
];