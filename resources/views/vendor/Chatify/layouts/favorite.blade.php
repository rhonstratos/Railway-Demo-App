@php
	$_user_img = !is_null($user->accountSettings->profile_img) ? asset("/storage/users/{$user->userId}/images/profile/{$user->accountSettings->profile_img}") : asset('assets/master/placeholders/poggy.png');
@endphp

<div class="favorite-list-item">
	<div data-id="{{ $user->id }}" data-action="0" class="avatar av-m" style="background-image: url('{{ $_user_img }}');">
	</div>
	<p>{{ strlen($user->firstname . ' ' . $user->lastname) > 5 ? substr($user->firstname . ' ' . $user->lastname, 0, 6) . '..' : $user->firstname . ' ' . $user->lastname }}</p>
</div>
