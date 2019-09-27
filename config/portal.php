<?php

return [

    'title' => 'Support site',

    'logo' => 'default.png',

    'css' => '',

    'logo_path' => env('LOGO_URL', '/assets/logos/'),

    'hash' => 'none',

    'channel_id' => 0,

    'laravel_template_wrapper' => env('LARAVEL_TEMPLATE_WRAPPER'),

    'source_id' => env('BERTIE_SOURCE', 1),

    'privacy_link' => false,

    'client_secret' => env('BERTIE_OAUTH_SECRET', ''),

    'client_id' => env('BERTIE_OAUTH_ID', ''),

    'url' => env('APP_URL', 'http://localhost'),

];
