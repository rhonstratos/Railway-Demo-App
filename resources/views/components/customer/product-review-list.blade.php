<tr class="mb-3 text-gray-500 text-[1.3rem]">
	<td class="py-4 px-6">

		<article>
			<div class="flex items-center mb-4 space-x-4">
				<img class="w-[4rem] h-[4rem] rounded-full"
					src="{{ $data->user->accountSettings->profile_img ? asset('storage/users/' . $data->user->userId . '/images/profile/' . $data->user->accountSettings->profile_img) : asset('assets/master/placeholders/poggy.png') }}"
					alt="">
				<div class="space-y-1 text-[1.3rem] dark:text-white">
					<p class="font-bold">
						{{ $data->user->firstname . ' ' . $data->user->lastname }}
						<time datetime="2022-10-10 19:00" class="block text-[1.1rem] text-gray-500 dark:text-gray-400 font-normal">
							Joined on {{ $data->user->created_at->format('F o') }}
						</time>
					</p>
				</div>
			</div>
			<div class="PRODUCT REVIEW inline-flex">
				@forelse (is_null($data->attachments)?[]:$data->attachments as $files)
				<a href="{{ asset('storage/reviews/' . $files) }}" data-gallery="reviews_gallery" class="glightbox">
					<img class="w-[80px] h-[80px] object-cover mr-4" src="{{ asset('storage/reviews/' . $files) }}" alt="img">
				</a>
				@empty
				@endforelse
			</div>

			<div class="flex items-center mt-2.5 mb-2">
				<x-star-ratings :ratings="$data->ratings" />
			</div>
			<footer class="mb-5 text-[1.3rem] text-gray-500 dark:text-gray-400">
				<p>{{ $data->created_at->format('M d, o - h:i A') }}</p>
			</footer>
			<p class="mb-2 font-light text-gray-500 dark:text-gray-400">
				{{ $data->message }}
			</p>
			@if (false)
				<aside>
					<p class="mt-4 text-[1.1rem] text-gray-500 dark:text-gray-400">19 people found this helpful
					</p>
					<div class="flex items-center mt-7 space-x-3 divide-x divide-gray-200 dark:divide-gray-600">
						<a href="#"
							class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 text-[1.3rem] rounded-lg px-2 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
							Helpful
						</a>
						<a href="#" class="capitalize pl-4 text-[1.3rem] font-medium text-{{ $site_settings->site_color_theme }} hover:underline">
							Report abuse
						</a>
					</div>
				</aside>
			@endif
		</article>
	</td>
</tr>
