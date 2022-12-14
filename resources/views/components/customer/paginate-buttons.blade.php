<div class="flex flex-col items-center mt-[5rem]">
	<!-- Help text -->
	<span class="text-[1.5rem] text-gray-700 dark:text-gray-400">
		Showing
		<span class="font-semibold text-gray-900 dark:text-white">
			{{ $data->firstItem() }}
		</span>
		to
		<span class="font-semibold text-gray-900">
			{{ $data->lastItem() }}
		</span>
		of
		<span class="font-semibold text-gray-900 dark:text-white">
			{{ $data->total() }}
		</span>
		Entries
	</span>

	<div class="inline-flex mt-2 xs:mt-0">
		<!-- Buttons -->
		<button {{ $data->previousPageUrl() ? null : __('disabled') }}
			onclick="location.href='{{ $data->onFirstPage() ? null : $data->previousPageUrl() }}'"
			class="inline-flex items-center py-2 px-4 text-[1.5rem] font-medium text-white button-shade rounded-l border-[#fff]">
			<svg aria-hidden="true" class="mr-4 w-7 h-7" fill="currentColor" viewBox="0 0 20 20"
				xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd"
					d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
					clip-rule="evenodd">
				</path>
			</svg>
			Prev
		</button>

		<button {{ $data->nextPageUrl() ? null : __('disabled') }}
			onclick="location.href='{{ $data->nextPageUrl() ? $data->nextPageUrl() : null }}'"
			class="inline-flex items-center py-2 px-4 text-[1.5rem] font-medium text-white button-shade rounded-r border-0 border-l border-[#fff]">
			Next
			<svg aria-hidden="true" class="ml-4 w-7 h-7" fill="currentColor" viewBox="0 0 20 20"
				xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd"
					d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
					clip-rule="evenodd">
				</path>
			</svg>
		</button>
	</div>
</div>
