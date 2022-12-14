@php
	$id = \Illuminate\Support\Str::snake($data);
@endphp
<li id="tagline-capsule-{{ $id }}"
	class="px-3 py-1 flex flex-row justify-between items-center gap-1 bg-{{$site_settings->site_color_theme}} text-center text-white rounded-full">
	<input class="hidden" readonly hidden type="text" name="tagline[]" value="{{ $data }}">
	<span>{{ $data }}</span>
	<button type="button" onclick="$('#tagline-capsule-{{ $id }}').remove()">
		<span class="text-[16px]">&#10799;</span>
	</button>
</li>
