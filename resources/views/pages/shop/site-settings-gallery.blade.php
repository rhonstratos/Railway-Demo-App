@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Site Settings</title>
@endsection

@section('content')
	{{-- header --}}
	<div class="business-header md:flex-row md:justify-between md:items-center">
		<span class="w-fit flex flex-row gap-3 items-center cursor-pointer"
			onclick="location.href='{{ route('business.site-settings.index') }}'">
			<span class="text-[20px]">&#10094;</span>
			<div class="flex flex-col gap-1">
				<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Your Gallery</h1>
			</div>
		</span>
		@if (false)
			<button
				class="business-label-as-button w-fit px-3 py-2 absolute md:static bottom-[53px] sm:bottom-[10px] right-[10px] gap-2 text-[14px] 2xl:text-[20px] rounded-[8px] md:shadow-lg"
				onclick="addNew()">
				<i class="fa-solid fa-plus"></i>
				<span>Add another</span>
			</button>
		@endif
	</div>

	{{-- main content --}}
	<div
		class="h-[calc(100vh_-_143px)] sm:h-[calc(100vh_-_118px)] xl:h-[calc(100vh_-_72px)] px-4 pb-4 flex flex-col gap-2 text-[12px] 2xl:text-[14px] overflow-y-auto"
		id="gallery-body">
		<!-- Session Status -->
		<x-auth-session-status class="mb-4" :status="session('status')" />

		<!-- Validation Errors -->
		<x-auth-validation-errors class="mb-4" :errors="$errors" />


		{{-- Card body --}}
		@foreach (range(1, 5) as $i)
			<form id="gallery-form-{{ $loop->iteration }}" action="{{ route('business.site-settings.form10') }}" method="post"
				enctype="multipart/form-data" class="gallery-item business-whitecard-bg">
				@csrf
				@method('PATCH')
				{{-- header part --}}
				<div class="flex flex-row justify-between items-center gap-2">
					<div class="flex flex-row items-center font-semibold grow">
						<label for="gallery-title-{{ $loop->iteration }}"><i class="fa-solid fa-pencil"></i></label>
						<input
							class="w-full business-input-textbox px-1 mx-1 bg-transparent focus:bg-dirtywhite placeholder:text-customgray-gray"
							type="text" name="gallery_title[{{ $loop->iteration }}]" id="gallery-title-{{ $loop->iteration }}"
							placeholder="Title"
							value="{{ !is_null($siteSettings->gallery['gallery_title'][$i]) ? $siteSettings->gallery['gallery_title'][$i] : null }}">
					</div>
					<div class="flex flex-row gap-2 text-white">
						<input type="text" name="delete" value="{{ $loop->iteration }}" hidden class="hidden">
						<button type="submit" name="action" value="delete"
							class="business-label-as-button gap-1 bg-status-red shadow-lg">
							<i class="fa-solid fa-trash-can"></i>
							<span class="">
								Delete
							</span>
						</button>
						<button type="submit" name="action" value="save"
							class="business-label-as-button gap-1 bg-status-green shadow-lg" onclick="">
							<i class="fa-solid fa-floppy-disk"></i>
							<span>Save</span>
						</button>
					</div>
				</div>

				{{-- fillable data --}}
				<div class="flex flex-col md:flex-row gap-2">
					{{-- description --}}
					<div class="grow flex flex-col gap-2">
						<label for="gallery_desc-{{ $loop->iteration }}">Description:</label>
						<textarea class="mx-2 border-none px-2 py-1 bg-dirtywhite text-[12px] 2xl:text-[14px] rounded-[4px]"
						 name="gallery_desc[{{ $loop->iteration }}]" id="gallery_desc-{{ $loop->iteration }}" rows="5" placeholder="">{{ isset($siteSettings->gallery['gallery_desc'][$i]) && !is_null($siteSettings->gallery['gallery_desc'][$i]) ? $siteSettings->gallery['gallery_desc'][$i] : null }}</textarea>
					</div>

					<div class="md:order-first flex flex-col gap-2">
						{{-- gallery img --}}
						<div id="gallery-preview-{{ $loop->iteration }}">
							@if (isset($siteSettings->gallery['gallery_img'][$i]) && !is_null($siteSettings->gallery['gallery_img'][$i]))
								{{-- pag meron --}}
								<img class="object-contain w-full md:w-[150px] h-[125px] rounded-[4px]"
									src="{{ asset('storage/master/gallery/' . $siteSettings->gallery['gallery_img'][$i]) }}" alt="img">
							@else
								{{-- pag walang image --}}
								<i class="fa-solid fa-image text-{{$site_settings->site_color_theme}} object-contain w-full md:w-[150px] h-[125px]"></i>
							@endif
						</div>

						{{-- upload --}}
						<input id="gallery-img-{{ $loop->iteration }}" name="gallery_img[{{ $loop->iteration }}]" type="file"
							accept="image/*" hidden class="hidden"
							onchange="previewGalleryImg(this,'gallery-preview-{{ $loop->iteration }}')">
						<button type="button"
							class="business-label-as-button bg-{{$site_settings->site_color_theme}} self-center w-1/2 md:w-fit min-w-fit max-w-[200px] gap-1 shadow-lg"
							onclick="$('#gallery-img-{{ $loop->iteration }}').click()">
							<i class="fa-solid fa-upload"></i>
							<span>Upload</span>
						</button>
					</div>
				</div>
			</form>
		@endforeach
	</div>

	<script>
		const previewGalleryImg = (el, parent) => {
			if (el.files && el.files[0]) {
				let reader = new FileReader();
				reader.onload = (e) => {
					$('#' + parent).html('');
					$('#' + parent).append(
						$('<img>', {
							src: e.target.result,
							alt: 'img',
							class: 'object-contain w-full md:w-[150px] h-[125px] rounded-[4px]'
						})
					);
				}
				reader.readAsDataURL(el.files[0]);
			}
		};
		//custom scripts here
		// const displayImage = (imgId) => {
		// 	for (i = 1; i < 6; i++) {
		// 		document.getElementById('img' + i).style.display = "none";
		// 		document.getElementById('textbox' + i).style.display = "none";
		// 	}

		// 	document.getElementById('img' + imgId).style.display = "block";
		// 	document.getElementById('textbox' + imgId).style.display = "flex";
		// };

		// const addNew = () => {
		// 	$.get('{{ route('business.site-settings.gallery.create') }}')
		// 		.done((data) => {
		// 			console.log(data);
		// 			let items = document.querySelectorAll('.gallery-item');
		// 			if (items.length < 5) {
		// 				$('#gallery-body').append(data);
		// 			}
		// 		})
		// };
	</script>
@endsection
