@forelse ($reviews as $data)
	<li class="business-whitecard-bg flex-row gap-3 mb-2">
		<img class="object-cover w-[50px] h-[50px] rounded-full"
			src="{{ $data->user->accountSettings->profile_img ? asset('storage/users/' . $data->user->userId . '/images/profile/' . $data->user->accountSettings->profile_img) : asset('assets/master/placeholders/poggy.png') }}" alt="img">

		{{-- right side of the card --}}
		<div class="w-full flex flex-col gap-2">
			{{-- upper part --}}
			<div class="w-full flex flex-row justify-between items-center">
				<div class='flex flex-row gap-2 items-center'>
					<span class="font-semibold">{{ $data->user->firstname . ' ' . $data->user->lastname }}</span>
					<span class="italic">{{ $data->created_at->format('D, M d, o - h:i A') }}</span>
				</div>

				{{-- stars --}}
				<div class="flex flex-row gap-1 justify-around items-center text-{{ $site_settings->site_color_theme }}">
					<x-star-ratings :ratings="$data->ratings" />
				</div>
			</div>

			{{-- review --}}
			<p>
				{{ $data->message }}
			</p>
		</div>

		<div class="flex justify-center items-center text-[24px] 2xl:text-[26px]">
			<label for="check#id" id="heart#{{ $data->id }}" onclick="changeheart(this.id,'{{ $data->id }}')"
				{{ isset($shop->shop_settings['fav_reviews']) && Arr::exists($shop->shop_settings['fav_reviews'], $data->id) ? __('style=color:#F03023;') : null }}>
				<i class="fa-solid fa-heart"></i>
			</label>
		</div>

		<input class="absolute -top-full" type="checkbox" checked name="favorites" id="check#id">
	</li>
@empty
	<li>
		<div class="text-[24px] text-center">
			<h2>no reviews yet</h2>
		</div>
	</li>
@endforelse
