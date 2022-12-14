
	<div class="gallery-item business-whitecard-bg">
		{{-- header part --}}
		<div class="flex flex-row justify-between items-center gap-2">
			<div class="flex flex-row items-center font-semibold grow">
				<span><i class="fa-solid fa-pencil"></i></span>
				<input class="w-full business-input-textbox px-1 mx-1 bg-transparent focus:bg-dirtywhite placeholder:text-customgray-gray"
					type="text" name="" id="" placeholder="Title">
			</div>
			<div class="flex flex-row gap-2 text-white">
				<button
					class="business-label-as-button gap-1 bg-status-red shadow-lg">
					<i class="fa-solid fa-trash-can"></i>
					<span class="">
						Delete
					</span>
				</button>
				<button class="business-label-as-button gap-1 bg-status-green shadow-lg"
					onclick="">
					<i class="fa-solid fa-floppy-disk"></i>
					<span>Save</span>
				</button>
			</div>
		</div>

		<div class="flex flex-col md:flex-row gap-2">
			{{-- description --}}
			<div class="grow flex flex-col gap-2">
				<span>Description:</span>
				<textarea class="mx-2 border-none px-2 py-1 bg-dirtywhite rounded-[4px]"
					name="about" id="" rows="5" placeholder=""></textarea>
			</div>

			<div class="md:order-first flex flex-col gap-2">
				{{-- pag walang image --}}
				<i class="fa-solid fa-image text-{{$site_settings->site_color_theme}} object-contain w-full md:w-[150px] h-[125px]"></i>

				{{-- pag meron --}}
				{{-- <img class="object-contain w-full md:w-[150px] h-[125px]"
					src="https://th.bing.com/th/id/R.4cfb6ea3e537cc86c89e65b2230cba73?rik=DmGEyMYVAnrYog&riu=http%3a%2f%2fimg3.wikia.nocookie.net%2f__cb20131017123233%2fkyoukainokanata%2fimages%2fe%2fe2%2fMirai_Kuriyama_anime.png&ehk=VG96WJbwVGOFBVgc2joIimFafgCmbFCX02NAnIa7VR4%3d&risl=&pid=ImgRaw&r=0" alt=""> --}}

				{{-- upload --}}
				<button class="business-label-as-button bg-{{$site_settings->site_color_theme}} self-center w-1/2 md:w-fit min-w-fit max-w-[200px] gap-1 shadow-lg"
					onclick="">
					<i class="fa-solid fa-upload"></i>
					<span>Upload</span>
				</button>
			</div>
		</div>
	</div>
