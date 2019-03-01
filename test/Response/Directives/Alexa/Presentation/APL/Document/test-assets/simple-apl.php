<?php
return [
    'type'         => 'APL',
    'version'      => '1.0',
    'theme'        => 'dark',
    'import'       =>
        [
            [
                'name'    => 'alexa-layouts',
                'version' => '1.0.0',
            ],
        ],
    'resources'    =>
        [
            [
                'description' => 'Stock color for the light theme',
                'colors'      =>
                    [
                        'colorTextPrimary' => '#151920',
                    ],
            ],
            [
                'description' => 'Stock color for the dark theme',
                'when'        => '${viewport.theme == \'dark\'}',
                'colors'      =>
                    [
                        'colorTextPrimary' => '#f0f1ef',
                    ],
            ],
            [
                'description' => 'Standard font sizes',
                'dimensions'  =>
                    [
                        'textSizeBody'          => 48,
                        'textSizePrimary'       => 27,
                        'textSizeSecondary'     => 23,
                        'textSizeSecondaryHint' => 25,
                    ],
            ],
            [
                'description' => 'Common spacing values',
                'dimensions'  =>
                    [
                        'spacingThin'       => 6,
                        'spacingSmall'      => 12,
                        'spacingMedium'     => 24,
                        'spacingLarge'      => 48,
                        'spacingExtraLarge' => 72,
                    ],
            ],
            [
                'description' => 'Common margins and padding',
                'dimensions'  =>
                    [
                        'marginTop'    => 40,
                        'marginLeft'   => 60,
                        'marginRight'  => 60,
                        'marginBottom' => 40,
                    ],
            ],
        ],
    'styles'       =>
        [
            'textStyleBase'          =>
                [
                    'description' => 'Base font description; set color and core font family',
                    'values'      =>
                        [
                            [
                                'color'      => '@colorTextPrimary',
                                'fontFamily' => 'Amazon Ember',
                            ],
                        ],
                ],
            'textStyleBase0'         =>
                [
                    'description' => 'Thin version of basic font',
                    'extend'      => 'textStyleBase',
                    'values'      =>
                        [
                            'fontWeight' => '100',
                        ],
                ],
            'textStyleBase1'         =>
                [
                    'description' => 'Light version of basic font',
                    'extend'      => 'textStyleBase',
                    'values'      =>
                        [
                            'fontWeight' => '300',
                        ],
                ],
            'mixinBody'              =>
                [
                    'values' =>
                        [
                            'fontSize' => '@textSizeBody',
                        ],
                ],
            'mixinPrimary'           =>
                [
                    'values' =>
                        [
                            'fontSize' => '@textSizePrimary',
                        ],
                ],
            'mixinSecondary'         =>
                [
                    'values' =>
                        [
                            'fontSize' => '@textSizeSecondary',
                        ],
                ],
            'textStylePrimary'       =>
                [
                    'extend' =>
                        [
                            0 => 'textStyleBase1',
                            1 => 'mixinPrimary',
                        ],
                ],
            'textStyleSecondary'     =>
                [
                    'extend' =>
                        [
                            0 => 'textStyleBase0',
                            1 => 'mixinSecondary',
                        ],
                ],
            'textStyleBody'          =>
                [
                    'extend' =>
                        [
                            0 => 'textStyleBase1',
                            1 => 'mixinBody',
                        ],
                ],
            'textStyleSecondaryHint' =>
                [
                    'values' =>
                        [
                            'fontFamily' => 'Bookerly',
                            'fontStyle'  => 'italic',
                            'fontSize'   => '@textSizeSecondaryHint',
                            'color'      => '@colorTextPrimary',
                        ],
                ],
        ],
    'layouts'      =>
        [
        ],
    'mainTemplate' =>
        [
            'description' => '********* Full-screen background image **********',
            'parameters'  =>
                [
                    0 => 'payload',
                ],
            'items'       =>
                [
                    [
                        'when'      => '${viewport.shape == \'round\'}',
                        'type'      => 'Container',
                        'direction' => 'column',
                        'items'     =>
                            [
                                [
                                    'type'     => 'Image',
                                    'source'   => '${payload.bodyTemplate1Data.backgroundImage.sources[0].url}',
                                    'position' => 'absolute',
                                    'width'    => '100vw',
                                    'height'   => '100vh',
                                    'scale'    => 'best-fill',
                                ],
                                [
                                    'type'                   => 'AlexaHeader',
                                    'headerTitle'            => '${payload.bodyTemplate1Data.title}',
                                    'headerAttributionImage' => '${payload.bodyTemplate1Data.logoUrl}',
                                ],
                                [
                                    'type'          => 'Container',
                                    'grow'          => 1,
                                    'paddingLeft'   => '@marginLeft',
                                    'paddingRight'  => '@marginRight',
                                    'paddingBottom' => '@marginBottom',
                                    'items'         =>
                                        [
                                            [
                                                'type'     => 'Text',
                                                'text'     => '${payload.bodyTemplate1Data.textContent.largeText.text}',
                                                'fontSize' => '@textSizeBody',
                                                'spacing'  => '@spacingSmall',
                                                'style'    => 'textStyleBody',
                                            ],
                                        ],
                                ],
                            ],
                    ],
                    1 =>
                        [
                            'type'   => 'Container',
                            'height' => '100vh',
                            'items'  =>
                                [
                                    [
                                        'type'     => 'Image',
                                        'source'   => '${payload.bodyTemplate1Data.backgroundImage.sources[0].url}',
                                        'position' => 'absolute',
                                        'width'    => '100vw',
                                        'height'   => '100vh',
                                        'scale'    => 'best-fill',
                                    ],
                                    [
                                        'type'                   => 'AlexaHeader',
                                        'headerTitle'            => '${payload.bodyTemplate1Data.title}',
                                        'headerAttributionImage' => '${payload.bodyTemplate1Data.logoUrl}',
                                    ],
                                    [
                                        'type'          => 'Container',
                                        'paddingLeft'   => '@marginLeft',
                                        'paddingRight'  => '@marginRight',
                                        'paddingBottom' => '@marginBottom',
                                        'items'         =>
                                            [
                                                [
                                                    'type'     => 'Text',
                                                    'text'     => '${payload.bodyTemplate1Data.textContent.largeText.text}',
                                                    'fontSize' => '@textSizeBody',
                                                    'spacing'  => '@spacingSmall',
                                                    'style'    => 'textStyleBody',
                                                ],
                                            ],
                                    ],
                                ],
                        ],
                ],
        ],
];