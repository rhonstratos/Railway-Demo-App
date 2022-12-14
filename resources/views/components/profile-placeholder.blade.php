@php
	$classes = 'fa-solid
	fa-user
	cursor-pointer
	text-[2.5rem]
	text-[#344767]
	hover:text-{{$site_settings->site_color_theme}}
	transition-all
	duration-[.2s]
	ease-linear';
@endphp
<i {{ $attributes->merge(['class' => $classes]) }}></i>
