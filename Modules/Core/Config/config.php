<?php

return [
    'name' => 'Core',
    'app_version' => '1.0.0',
    'app_timezone' => 'Asia/Jakarta',
    'main_menu' => [
        [  
            'icon' => 'mdi-desktop-mac-dashboard',
            'icon-alt' => 'mdi-chevron-down',
            'text' => 'Dashboard',
            'uri' => 'dashboard.index',
            'model' => false,
            'show' => true,
            'children' => null
        ],
    	[
    	    'icon' => 'mdi-database',
    	    'icon-alt' => 'mdi-chevron-down',
    	    'text' => 'Master Data',
    	    'model' => false,
    	    'show' => true,
    	    'children' => [
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Banner',
                    'uri' => 'banner.index',
                    'model' => false,
                    'show' => true
                ],
    	        [
    	            'icon' => 'mdi-adjust',
    	            'text' => 'E-Learning',
                    'uri' => 'e-learning.index',
    	            'model' => false,
    	            'show' => true
    	        ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'FAQ E-Learning',
                    'uri' => 'faq.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Products',
                    'uri' => '',
                    'model' => false,
                    'show' => true
                ],
    	    ]
    	],
        [  
            'icon' => 'mdi-newspaper-variant-outline',
            'icon-alt' => 'mdi-chevron-down',
            'text' => 'Contact Us',
            'uri' => '',
            'model' => false,
            'show' => true,
            'children' => null
        ],
    ],
    'user_menu' => [
        [  
            'icon' => 'mdi-power',
            'text' => 'Logout',
            'uri' => 'logout',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        base_path('public') => base_path('admin/public'),
        base_path() . '/../fonts' => base_path('fonts'),
    ],
];