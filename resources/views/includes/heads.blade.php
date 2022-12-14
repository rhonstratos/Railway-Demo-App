<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

@php
	// meta tags
	$_meta_title = Str::title(config('app.name')) . ' - A Web-based Online Order and Appointment Management System for Technology Repair Shops in Bulacan';
	$_meta_description =
	    'The study’s main objective was to develop a web-based online order and appointment management that will replace the manual processes of the shop that they are currently using in performing their services for their customers and a web-based online transaction processing system for technology repair shops’ clients to transact with. Technology Repair Shops. This study provides a better system for repair shops. This study will provide growth to the business as it will help them manage their shops, goods, and services.  Technology Repair Shop Staff. In this study, repair shop staff would be able to manage the shop well as the transaction would be made digitally and the monitoring of the information will be easier as it will be stored online. Their customers would be able to communicate with them directly and make appointments with ease. And lastly, the generation of reports would be much simpler as it will be automated. Customers. This study would be beneficial to them as they would be able to communicate with the shop’s representatives first before making an appointment at the shop. They would also be able to buy the goods offered by the shop. Future Researchers. The study could provide relevant information to academic and industry researchers, especially in Information Technology, in conducting a study related to the development of e-commerce systems.';
	$_meta_content = asset('assets/meta/content.png');
	$_meta_url = 'https://www.' . config('app.url');
@endphp

{{-- Primary Meta Tags --}}
<meta name="title" content="{{ $_meta_title }}">
<meta name="description" content="{{ $_meta_description }}">

{{-- Open Graph / Facebook --}}
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $_meta_url }}">
<meta property="og:title" content="{{ $_meta_title }}">
<meta property="og:description" content="{{ $_meta_description }}">
<meta property="og:image" content="{{ $_meta_content }}">

{{-- Twitter --}}
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $_meta_url }}">
<meta property="twitter:title" content="{{ $_meta_title }}">
<meta property="twitter:description" content="{{ $_meta_description }}">
<meta property="twitter:image" content="{{ $_meta_content }}">

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
<link rel="stylesheet" href="{{ asset('css/glightbox.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/plyr.min.css') }}">

<script src="{{ asset('js/app.js') }}"></script>
@laravelPWA
