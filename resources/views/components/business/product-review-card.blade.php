<li class="business-whitecard-bg flex-row gap-3 mb-2">
	@php
		$_user = $review->user;
		$_fullname = $_user->firstname . ' ' . $_user->lastname;
		$_userImg = isset($_user->accountSettings->profile_img) ? $_user->accountSettings->profile_img : null;
		$_userImgFile = $_userImg ? asset('storage/users/' . $_user->userId . '/images/profile/' . $_userImg) : asset('assets/master/placeholders/poggy.png');
	@endphp

	<img class="object-cover w-[50px] h-[50px] rounded-full" src="{{ $_userImgFile }}" alt="img">


	{{-- right side of the card --}}
	<div class="w-full flex flex-col gap-2">
		{{-- upper part --}}
		<div class="w-full flex flex-row justify-between items-center">
			<div class='flex flex-row gap-2 items-center'>
				<span class="font-semibold">{{ $_fullname }}</span>
				<span class="italic">{{ $review->created_at->format('M d, o - h:i A') }}</span>
			</div>

			{{-- stars --}}
			<div class="flex flex-row gap-1 justify-around items-center text-{{$site_settings->site_color_theme}}">
				<x-star-ratings :ratings="$review->ratings" />
			</div>
		</div>

		{{-- attachments --}}
		<div class="flex flex-row gap-1 items-center">
			@forelse (($review->attachments ?? []) as $_img)
				@php
					$_reviewImg = asset('storage/reviews/' . $_img);
				@endphp
				<a class="glightbox" data-gallery="productReviewGallery-{{ $review->id }}" href="{{ $_reviewImg }}">
					<img class="object-cover w-[50px] h-[50px]" src="{{ $_reviewImg }}" alt="img">
				</a>
			@empty
				<div class="hidden">
					{{-- no attachments --}}
				</div>
			@endforelse
		</div>

		{{-- reviews --}}
		<p>
			{{ $review->message }}
		</p>
	</div>
</li>
