@php
	$baseClass = 'text-' . $site_settings->site_color_theme . ' py-[1rem] px-0 text-[1.1rem]';
	$productRatings = $ratings;
	$h = $hidden ?? false;
@endphp
<div class="stars">
	@foreach (range(1, 5) as $i)
		<i @class([
			$baseClass,
			'fa-solid fa-star' => floor($productRatings) >= $i,
			'fa-regular fa-star' => floor($productRatings) < $i,
		])></i>
	@endforeach
</div>
<span @class([
	'text-[#344767] bg-[#f2f2f2] text-[1rem] font-semibold mr-2 px-2.5 py-0.5 rounded ml-3',
	'hidden' => $h,
])>
	{{ $productRatings ?? __('Unrated') }}
</span>
