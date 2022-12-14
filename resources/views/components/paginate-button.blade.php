{{-- the page selector --}}
@props(['data'])
<div class="mx-4 basis-[60px] shrink-0 flex gap-1 flex-col sm:flex-row justify-evenly sm:justify-between items-center text-black dark:text-dirtywhite">
	{{-- number of items --}}
	<div class="sm:mr-10 order-last sm:order-first text-[12px] 2xl:text-[16px]">
		@if ($data->firstItem())
			<span>{{ $data->firstItem() }}</span>
			<span>-</span>
			<span>{{ $data->lastItem() }}</span>
		@else
			{{ $data->count() }}
		@endif
		<span>out of</span>
		<span>{{ $data->total() }}</span>
	</div>

	<div class="pt-[10px] sm:pt-0 flex gap-1 flex-row text-[12px] 2xl:text-[16px]">

		{{-- "go to the beginning" page button --}}
		<button data-href="{{ \Request::url() }}" {{ $data->onFirstPage() ? __('disabled') : __('') }} class="_paginate_btn px-2 sm:px-3 py-1 bg-white dark:bg-black border-[rgba(0,0,0,0.1)] border-[1px] rounded-md">
			<span>&#10094;</span>
			<span>&#10094;</span>
		</button>

		{{-- previous page button --}}
		<button data-href="{{ $data->previousPageUrl() }}" {{ $data->previousPageUrl() ? __('') : __('disabled') }} class="_paginate_btn px-3 py-1 bg-white dark:bg-black border-[rgba(0,0,0,0.1)] border-[1px] rounded-md">
			<span>&#10094;</span>
		</button>

		{{-- page selector button --}}
		<button {{ $data->hasPages() ? __('') : __('disabled') }} class="px-3 py-1 bg-white dark:bg-black border-[rgba(0,0,0,0.1)] border-[1px] rounded-md" onclick="showPages()">
			<span>Page {{ $data->currentPage() }}</span>
		</button>

		{{-- next page button --}}
		<button data-href="{{ $data->nextPageUrl() }}" {{ $data->nextPageUrl() ? __('') : __('disabled') }} class="_paginate_btn px-3 bg-white dark:bg-black border-[rgba(0,0,0,0.1)] border-[1px] rounded-md">
			<span>&#10095;</span>
		</button>

		{{-- "go to end" page button --}}
		<button data-href="{{ \Request::url() . '?page=' . $data->lastPage() }}" {{ $data->hasPages() ? __('') : __('disabled') }} class="_paginate_btn px-2 sm:px-3 py-1 bg-white dark:bg-black border-[rgba(0,0,0,0.1)] border-[1px] rounded-md">
			<span>&#10095;</span>
			<span>&#10095;</span>
		</button>
	</div>

	{{-- the pages --}}
	<div class="w-screen h-screen top-0 left-0 z-[2] fixed hidden justify-center items-center bg-[rgba(0,0,0,0.2)]" id="pages">
		<div class="w-[80%] max-w-[715px] xl:max-w-[915px] h-1/2 xl:h-[60%] p-[10px] flex flex-col justify-between items-center bg-white dark:bg-dark rounded-[10px]">
			<div class="w-full basis-[calc(100%_-_40px)] overflow-y-auto">
				<ul class="w-full h-fit grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 list-none">
					{{-- basis-[calc(100%_-_40px)] --}}
					@for ($page = 1; $page <= $data->lastPage(); $page++)
						@php
							$_url = $page == $data->currentPage() ? '#' : $data->url($page);
						@endphp
						<li data-href="{{ $_url }}" class="_paginate_btn p-1 cursor-pointer">
							<div class="w-full h-fit py-2 border-[rgba(0,0,0,0.1)] border-[1px] flex justify-center items-center text-[16px] bg-white dark:bg-black rounded-md shadow-sm">
								<span class="">Page {{ $page }}</span>
							</div>
						</li>
					@endfor
				</ul>
			</div>

			{{-- close button --}}
			<button class="w-[40px] basis-[40px] border-[rgba(0,0,0,0.1)] border-[1px] flex justify-center items-center text-[20px] bg-white dark:bg-black rounded-full shadow-sm" onclick="showPages()">
				<i class="fa-solid fa-xmark"></i>
			</button>

		</div>
	</div>
</div>
