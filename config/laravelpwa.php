<?php

return [
	'name' => config('app.name', 'Rectify'),
	'manifest' => [
		'name' => config('app.name', 'Rectify'),
		'short_name' => config('app.name', 'Rectify'),
		'description' => 'Find tech repair shops near you!',
		'start_url' => './',
		'scope' => '.',
		'lang' => 'en-US',
		'background_color' => '#ffffff',
		'theme_color' => '#000000',
		'display' => 'standalone',
		'orientation' => 'any',
		'status_bar' => 'black',
		'prefer_related_applications' => 'false',
		'icons' => [
			'57x57' => [
				'path' => '/assets/PWA/rectify-57x57.png',
				'purpose' => 'any',
				'sizes' => '57x57',
				'type' => 'image/png',
			],
			'60x60' => [
				'path' => '/assets/PWA/rectify-60x60.png',
				'purpose' => 'any',
				'sizes' => '60x60',
				'type' => 'image/png',
			],
			'72x72' => [
				'path' => '/assets/PWA/rectify-72x72.png',
				'purpose' => 'any',
				'sizes' => '72x72',
				'type' => 'image/png',
			],
			'76x76' => [
				'path' => '/assets/PWA/rectify-76x76.png',
				'purpose' => 'any',
				'sizes' => '76x76',
				'type' => 'image/png',
			],
			'96x96' => [
				'path' => '/assets/PWA/rectify-96x96.png',
				'purpose' => 'any',
				'sizes' => '96x96',
				'type' => 'image/png',
			],
			'114x114' => [
				'path' => '/assets/PWA/rectify-114x114.png',
				'purpose' => 'any',
				'sizes' => '114x114',
				'type' => 'image/png',
			],
			'152x152' => [
				'path' => '/assets/PWA/rectify-152x152.png',
				'purpose' => 'any',
				'sizes' => '152x152',
				'type' => 'image/png',
			],
			'180x180' => [
				'path' => '/assets/PWA/rectify-180x180.png',
				'purpose' => 'any',
				'sizes' => '180x180',
				'type' => 'image/png',
			],
			'192x192' => [
				'path' => '/assets/PWA/rectify-192x192.png',
				'purpose' => 'any',
				'sizes' => '192x192',
				'type' => 'image/png',
			],
			'256x256' => [
				'path' => '/assets/PWA/rectify-256x256.png',
				'purpose' => 'any',
				'sizes' => '256x256',
				'type' => 'image/png',
			],
			'384x384' => [
				'path' => '/assets/PWA/rectify-384x384.png',
				'purpose' => 'any',
				'sizes' => '384x384',
				'type' => 'image/png',
			],
			'512x512' => [
				'path' => '/assets/PWA/rectify-512x512.png',
				'purpose' => 'any',
				'sizes' => '512x512',
				'type' => 'image/png',
			],
		],
		'splash' => [
			'640x1136' => '/assets/PWA/splash-640x1136.png',
			'750x1334' => '/assets/PWA/splash-750x1334.png',
			'828x1792' => '/assets/PWA/splash-828x1792.png',
			'1125x2436' => '/assets/PWA/splash-1125x2436.png',
			'1242x2208' => '/assets/PWA/splash-1242x2208.png',
			'1242x2688' => '/assets/PWA/splash-1242x2688.png',
			'1536x2048' => '/assets/PWA/splash-1536x2048.png',
			'1668x2224' => '/assets/PWA/splash-1668x2224.png',
			'1668x2388' => '/assets/PWA/splash-1668x2388.png',
			'2048x2732' => '/assets/PWA/splash-2048x2732.png',
		],
		'shortcuts' => [
			[
				'name' => 'Shortcut Link 1',
				'description' => 'Shortcut Link 1 Description',
				'url' => '/shortcutlink1',
				// 'icons' => [
				// 	'src' => '/assets/PWA/rectify-72x72.png',
				// 	'purpose' => 'any',
				// 	'type' => 'image/png',
				// ],

			],
			[
				'name' => 'Shortcut Link 2',
				'description' => 'Shortcut Link 2 Description',
				'url' => '/shortcutlink2',
			],
		],
		'custom' => [],
	],
];
