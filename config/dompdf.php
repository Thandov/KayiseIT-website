<?php

return [
    'paper_size' => 'letter',
    'orientation' => 'portrait',
    'pdf_backend' => 'cpdf',

    'header' => [
        'html' => [
            'enabled' => true,
            'content' => '<div style="text-align: center; font-size: 12px;">Header Content</div>',
            'width' => '100%',
        ],
    ],

    'footer' => [
        'html' => [
            'enabled' => true,
            'content' => '<div style="text-align: center; font-size: 12px;">Page: [page] of [topage]</div>',
            'width' => '100%',
        ],
    ],
];
