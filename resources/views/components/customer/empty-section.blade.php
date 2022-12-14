<div {{ $attributes->merge(['class' => $divclass . ' grid flex-wrap justify-center grid-cols-1 text-center']) }}>
	<div class="h-[40rem]">
		<img src="{{ $asset }}" alt="image" {{ $attributes->merge(['class' => $imgclass . ' mx-auto ']) }}>
		<h3 class="text-[2rem] my-[1rem] font-semibold text-{{ $site_settings->site_color_theme }}">{{ $header }}</h3>
		<p class="text-[1.3rem] leading-normal my-[1rem] font-semibold text-[#959596]">
			{{ $paragraph1 }}
			<br>
			{{ $paragraph2 }}
		</p>
		@if (!empty($route) && !empty($buttontext))
			<a href="{{ $route }}"
				{{ $attributes->merge([
				    'class' =>
				        $buttonclass .
				        '  inline-block
											rounded-[.5rem]
											text-[#fff] bg-' .
				        $site_settings->site_color_theme .
				        '
											text-[1.5rem] cursor-pointer
											font-[500] button-shade',
				]) }}
				type="button">
				{{ $buttontext }}
			</a>
		@endif
	</div>
</div>
