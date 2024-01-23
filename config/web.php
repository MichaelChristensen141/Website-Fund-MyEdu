<?php

return [
    /**
    |--------------------------------------------------------------------------
    | Web Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration used in meta tags in HTML, for the first step of
    | SEO (Search Engine Optimization)
    |
     */
    'title'         => env('WEB_TITLE', 'Prima.js'),
    'footer'         => env('WEB_FOOTER', 'Prima.js'),
    'description'   => env('WEB_DESCRIPTION', 'Prima.js'),
    'keywords'      => env('WEB_KEYWORDS', 'Prima.js'),
    'make'      => env('WEB_MAKE', 'Prima.js'),

    /**
    |--------------------------------------------------------------------------
    | Author Detail
    |--------------------------------------------------------------------------
    |
    | Complete information on site ownership, as the main parameter for SEO
    |
     */
    'author' => [
        'name' => env('WEB_AUTHOR_NAME', 'Prima.js'),
        'email' => env('WEB_AUTHOR_EMAIL', 'prima.jsx@gmail.com'),
        'phone' => env('WEB_AUTHOR_PHONE'),
    ]
];
