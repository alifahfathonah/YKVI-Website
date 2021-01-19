<?php 

namespace Modules\Core\Providers;

class CoreProvider
{
	public function main_menu()
	{
	    return [
	        [  
	            'icon' => 'mdi-desktop-mac-dashboard',
	            'icon-alt' => 'mdi-chevron-down',
	            'text' => __('Dashboard'),
	            'uri' => 'dashboard.index',
	            'model' => false,
	            'show' => true,
	            'children' => null
	        ],
	        [
	            'icon' => 'mdi-database',
	            'icon-alt' => 'mdi-chevron-down',
	            'text' => __('Master Data'),
	            'model' => false,
	            'show' => true,
	            'children' => [
	                [
	                    'icon' => 'mdi-adjust',
	                    'text' => __('About Us'),
	                    'uri' => 'about-us.index',
	                    'model' => false,
	                    'show' => true
	                ],
	                [
	                    'icon' => 'mdi-adjust',
	                    'text' => __('Banner'),
	                    'uri' => 'banner.index',
	                    'model' => false,
	                    'show' => true
	                ],
	                [
	                    'icon' => 'mdi-adjust',
	                    'text' => 'CME',
	                    'uri' => 'cme.index',
	                    'model' => false,
	                    'show' => true
	                ],
	                [
	                    'icon' => 'mdi-adjust',
	                    'text' => __('E-Learning'),
	                    'uri' => 'e-learning.index',
	                    'model' => false,
	                    'show' => true
	                ],
	                [
	                    'icon' => 'mdi-adjust',
	                    'text' => __('FAQ E-Learning'),
	                    'uri' => 'faq.index',
	                    'model' => false,
	                    'show' => true
	                ],
	                [
	                    'icon' => 'mdi-adjust',
	                    'text' => __('Product Category'),
	                    'uri' => 'product-category.index',
	                    'model' => false,
	                    'show' => true
	                ],
	                [
	                    'icon' => 'mdi-adjust',
	                    'text' => __('Product'),
	                    'uri' => 'product.index',
	                    'model' => false,
	                    'show' => true
	                ],
	                [
	                    'icon' => 'mdi-adjust',
	                    'text' => 'SymCard',
	                    'uri' => 'sym-card.index',
	                    'model' => false,
	                    'show' => true
	                ],
	            ]
	        ],
	        [  
	            'icon' => 'mdi-account-group',
	            'icon-alt' => 'mdi-chevron-down',
	            'text' => __('Manage User'),
	            'uri' => 'user.index',
	            'model' => false,
	            'show' => true,
	            'children' => null
	        ],
	        [  
	            'icon' => 'mdi-newspaper-variant-outline',
	            'icon-alt' => 'mdi-chevron-down',
	            'text' => __('Contact Us'),
	            'uri' => 'contact-us.index',
	            'model' => false,
	            'show' => true,
	            'children' => null
	        ],
	    ];
	}

	public function user_menu()
	{
	    return [
	        [  
	            'icon' => 'mdi-cog-outline',
	            'text' => __('Change Password'),
	            'uri' => 'change-password.form',
	        ],
	        [  
	            'icon' => 'mdi-power',
	            'text' => __('Logout'),
	            'uri' => 'logout',
	        ],
	    ];
	}
}