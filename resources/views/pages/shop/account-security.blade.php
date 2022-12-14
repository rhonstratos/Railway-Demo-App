@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Account Settings</title>
@endsection

@section('content')
{{-- header --}}
<div class="business-header">
	<div class="flex flex-col gap-1">
		<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Account Security</h1>
		<span class="italic text-[12px]">Strengthen your account's security using these settings.</span>
	</div>
</div>

{{-- main content --}}
<div class="h-[calc(100vh_-_137px)] px-4 pb-4 flex flex-col overflow-y-auto">
	{{-- account information and two factor authentication section --}}
	<section class="flex flex-col md:flex-row gap-2">
		{{-- account information --}}
		<div class="business-whitecard-bg md:basis-3/5">
			<span class="font-semibold">Account information</span>

			<section class="px-2 py-1 flex flex-col gap-2">
				{{-- email --}}
				<div class="flex flex-row gap-2 justify-between items-center">
					<span class="">Email</span>
					<span class="px-2 grow truncate">
						{{ $user->email }}
					</span>

					{{-- change button --}}
					<label class="business-label-as-button bg-{{$site_settings->site_color_theme}} gap-2" for="reenterPassCheckbox"
						onclick="reenterPass('reenterPass4EmailModal')">
						<i class="fa-solid fa-pen-to-square"></i>
						<span>Change</span>
					</label>
				</div>

				{{-- password --}}
				<div class="flex flex-row gap-2 justify-between items-center">
					<span class="">Password</span>
					<span class="px-2 grow truncate">***********</span>

					{{-- change button --}}
					<label class="business-label-as-button bg-{{$site_settings->site_color_theme}} gap-2" for="reenterPassCheckbox" onclick="reenterPass('newPasswordModal')">
						<i class="fa-solid fa-pen-to-square"></i>
						<span>Change</span>
					</label>
				</div>

				{{-- account created --}}
				<div class="flex flex-row gap-2 items-center italic">
					<span>Account created:</span>
					<span>{{ $user->created_at->format('M d, o') }}</span>
				</div>
			</section>
		</div>

		{{-- two factor authentication --}}
		<div class="business-whitecard-bg md:basis-2/5 sm:h-fit ustify-center lg:justify-start">
			<div class="flex flex-row justify-between items-center">
				<span class="">Two-factor authentication</span>

				@if ($user->is_2fa_enabled)
					<div class="px-2 py-1 flex flex-row gap-2 justify-center items-center text-status-green italic">
						<i class="fa-solid fa-check"></i>
						<span>Turned on</span>
					</div>
				@else
					{{-- if disabled --}}
					<div class="px-2 py-1 flex flex-row gap-2 justify-center items-center text-customgray-lightgray italic">
						<span class="">&#10799;</span>
						<span>Disabled</span>
					</div>
				@endif
			</div>
			<label class="px-2 py-1 border-[1px] flex flex-row gap-7 justify-between items-center rounded-[4px] cursor-pointer"
				for="qrCodeCheckbox" onclick="qrCodeModal()">
				<div class="flex flex-col gap-1">
					<span class="text-left">
						Provide extra layer of protection to your account
						by using two-factor authentication
					</span>
				</div>

				<span>&#10095;</span>
			</label>
		</div>
	</section>

	{{-- modals --}}
	<div class="business-modalbg" id="motherModal"> {{-- account information modal --}}
		<div class="business-modal1">
			{{-- reenter password for email modal --}}
			<div class="hidden flex-col gap-1" id="reenterPass4EmailModal">
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Change Email</span>

					{{-- close button --}}
					<label class="business-close-button" for="reenterPassCheckbox" onclick="reenterPass()">
						<span class="text-[20px]">&#10799;</span>
					</label>
				</div>

				<div class="grow flex flex-col gap-2">
					<span class="">To continue, you need to re-enter your password</span>

					<div class="flex flex-row gap-3 justify-between items-center">
						<input class="business-input-textbox grow focus:ring-{{$site_settings->site_color_theme}}" type="password" autocomplete="nope" placeholder="Current password"
							id="password4email">

						{{-- next button --}}
						<label class="px-5 py-1 bg-{{$site_settings->site_color_theme}} text-white rounded-[4px] cursor-pointer" for="reenterPass4EmailCheckbox"
							id="next1" onclick="validateNewEmail('password4email');">
							<span>Next</span>
						</label>
					</div>
				</div>
			</div>

			{{-- change password modal --}}
			<div class="hidden flex-col gap-1" id="newPasswordModal">
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Change Password</span>

					{{-- close button --}}
					<label class="business-close-button" for="reenterPassCheckbox" onclick="reenterPass()">
						<span class="text-[20px]">&#10799;</span>
					</label>
				</div>

				<div class="grow flex flex-col gap-2">
					<form class="flex flex-col gap-2" action="{{ route('business.account-settings.password.store') }}" method="post">
						@csrf
						@method('PATCH')
						<section class="w-full flex flex-col gap-1">
							{{-- old password --}}
							<div class="w-full self-start flex flex-col gap-1">
								<span class="">Enter your old password</span>
								<input class="business-input-textbox grow focus:ring-{{$site_settings->site_color_theme}}" type="password" name="current_password" placeholder=""
									id="oldPassword">
							</div>

							{{-- new password --}}
							<div class="w-full self-start flex flex-col gap-1">
								<span class="">Enter your new password</span>
								<input class="business-input-textbox grow focus:ring-{{$site_settings->site_color_theme}}" type="password" name="new_password" placeholder="" id="newPassword">
							</div>

							{{-- reenter new password --}}
							<div class="w-full self-start flex flex-col gap-1">
								<span class="">Reenter your new password</span>
								<input class="business-input-textbox grow focus:ring-{{$site_settings->site_color_theme}}" type="password" name="new_password_confirmation" placeholder=""
									id="reenteredNewPassword">
							</div>
						</section>

						{{-- confirm button --}}
						<button type="submit" class="px-5 py-1 bg-{{$site_settings->site_color_theme}} text-white rounded-[4px]" for="" id="next1">
							<span>Confirm</span>
						</button>
					</form>
				</div>
			</div>

			{{-- change email modal --}}
			<div class="hidden flex-col gap-1" id="newEmailModal">
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">New Email</span>

					{{-- close button --}}
					<label class="business-close-button" for="reenterPassCheckbox" onclick="reenterPass()">
						<span class="text-[20px]">&#10799;</span>
					</label>
				</div>

				<div class="grow flex flex-col gap-2">
					<form action="{{ route('business.account-settings.email.store') }}" method="post">
						@csrf
						@method('PATCH')
						<section class="w-full flex flex-col gap-1">
							<span class="">Enter your new email</span>
							<input class="business-input-textbox grow focus:ring-{{$site_settings->site_color_theme}}" type="email" name="newEmail" placeholder="Email"
								id="newEmail">

							<span class="">Reenter your password</span>
							<input class="business-input-textbox grow focus:ring-{{$site_settings->site_color_theme}}" type="password" name="password" placeholder="Password"
								id="reenterPassword4email">
						</section>

						{{-- next button --}}
						<button type="submit" class="px-5 py-1 bg-{{$site_settings->site_color_theme}} text-white rounded-[4px] text-center" id="confirm1"
							onclick="changeEmail()">
							<span>Confirm</span>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- qr code modal --}}
	<div class="business-modalbg" id="qrCodeModal">
		<div class="business-modal1">
			<div class="flex flex-row justify-between items-center">
				<span class="font-semibold">Enable two-factor authentication</span>

				{{-- close button --}}
				<label class="business-close-button" for="qrCodeCheckbox" onclick="qrCodeModal()">
					<span class="text-[20px]">&#10799;</span>
				</label>
			</div>

			<div class="grow flex flex-col gap-2">
				{{-- span --}}
				<div class="flex flex-row gap-2 justify-center">
					<span class="basis-1/2 text-center">Download and install the Google Authenticator app</span>
					<span class="basis-1/2 text-center">Scan the qr code using the authenticator app</span>
				</div>

				{{-- logo and qr image --}}
				<div class="flex flex-row gap-2 justify-around items-center">
					<div class="w-[150px] h-[150px]">
						<img class="w-full h-auto"
							src="https://img.talkandroid.com/uploads/2015/12/Google_Authenticator_update_material_design_Wear_120715_1.png"
							alt="">
					</div>

					<div id="qr-img" class="w-[150px] h-[150px]">
						{{-- this is a placeholder only --}}
						{{-- <img class="w-full h-auto" src="https://pngimg.com/uploads/qr_code/qr_code_PNG25.png" alt=""> --}}
					</div>
				</div>

				{{-- next button --}}
				<div class="flex flex-col gap-2 justify-center items-center">
					<label class="w-1/2 px-5 py-1 bg-{{$site_settings->site_color_theme}} text-white text-center rounded-[4px] cursor-pointer"
						for="sixDigitCodeCheckbox" id="" onclick="sixDigitCode()">
						<span>Next</span>
					</label>
				</div>
			</div>

			<div class="business-modalbg" id="sixDigitCodeModal">
				{{-- enable qr code success --}}
				<div class="w-[90%] max-w-[546px] px-3 py-3 flex flex-col gap-2 bg-white rounded-[8px] shadow-lg">
					<div class="flex flex-row justify-between items-center">
						<span class="font-semibold">6 digit verification</span>
						{{-- close button --}}
						<label class="business-close-button" for="sixDigitCodeCheckbox" onclick="sixDigitCode()">
							<span class="text-[20px]">&#10799;</span>
						</label>
					</div>

					<div class="flex flex-col gap-1">
						<span>Enter the 6 digit code from the authenticator</span>
						<form class="flex flex-row gap-2" id="form-gAuth" action="{{ route('business.account-settings.2fa') }}" method="post">
							@csrf
							@method('PATCH')
							<input class="business-input-textbox w-full" type="number" name="gAuth" pattern="[0-9]{6}"
								placeholder="000000" id="gAuth">
							<button type="submit" class="px-5 py-1 bg-{{$site_settings->site_color_theme}} text-white rounded-[4px]" id="" onclick="">
								<span>Confirm</span>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- turn off 2fa modal --}}
	{{-- <div class="business-modalbg" id="qrCodeModal">
		<div class="business-modal1">
			<div class="flex flex-row justify-between items-center">
				<span class="font-semibold">Disable two-factor authentication</span>

				<label class="business-close-button" for="qrCodeCheckbox" onclick="qrCodeModal()">
					<span class="text-[20px]">&#10799;</span>
				</label>
			</div>

			<div class="flex flex-col gap-2">
				<section class="w-full flex flex-col gap-1">
					<span class="">Enter your email</span>
					<input class="business-input-textbox grow" type="email" name="disableEmail" placeholder="Email"
						id="">

					<span class="">Enter the 6 digit code from the authenticator</span>
					<input class="business-input-textbox grow" type="number" name="disable6Digit" placeholder="000000"
						id="">
				</section>
				<button type="submit" class="px-5 py-1 bg-{{$site_settings->site_color_theme}} text-white rounded-[4px]" id="" onclick="">
					<span>Turn off 2FA</span>
				</button>
			</div>
		</div>
	</div> --}}
</div>

{{-- all checkboxes here --}}
<input class="absolute -top-full" type="checkbox" name="" checked id="reenterPassCheckbox">
<input class="absolute -top-full" type="checkbox" name="" checked id="reenterPass4EmailCheckbox">
<input class="absolute -top-full" type="checkbox" name="" checked id="qrCodeCheckbox">
<input class="absolute -top-full" type="checkbox" name="" checked id="sixDigitCodeCheckbox">

<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	// do your custom scripts here
	const reenterPass = (modal) => {
		if (document.getElementById("reenterPassCheckbox").checked) {
			document.getElementById("motherModal").style.display = "flex";
			document.getElementById(modal).style.display = "flex";
		} else {
			document.getElementById("motherModal").style.display = "none";

			document.getElementById("reenterPass4EmailModal").style.display = "none";
			document.getElementById("newEmailModal").style.display = "none";
			document.getElementById("newPasswordModal").style.display = "none";

			// reset the check state of this modals
			document.getElementById("reenterPass4EmailCheckbox").checked = true;
		}
	}

	const reenterPass4Email = () => {
		// here
		if (document.getElementById("reenterPass4EmailCheckbox").checked) {
			$("#newEmailModal").css("display", "flex");
			$("#reenterPass4EmailModal").css("display", "none");
		} else {
			// SELF
			$("#motherModal").css("display", "none");
		}
	}

	const loadString = () => {
		$('#form-gAuth').append(
			$('<input>', {
				id: 'gAuth-string',
				type: 'hidden',
				val: auth_string,
				readonly: true,
				name: 'string'
			})
		);
	}

	const getQRCode = () => {
		$.get(window.location.href + '/create', (data) => {})
			.done((data) => {
				console.log(data);
				const id = '#qr-img'

				$(id).html(data['qr'])
				auth_string = data['string']
			})
	}

	const qrCodeModal = () => {
		const modal = document.getElementById("qrCodeModal");
		if (document.getElementById("qrCodeCheckbox").checked) {
			getQRCode()
			$(() => modal.style.display = "flex")
		} else {
			modal.style.display = "none";
		}
	}

	const sixDigitCode = () => {
		if (document.getElementById("sixDigitCodeCheckbox").checked) {
			document.getElementById("sixDigitCodeModal").style.display = "flex";
			if (auth_string) {
				loadString();
			}
		} else {
			document.getElementById("sixDigitCodeModal").style.display = "none";
			$('#gAuth-string').remove()
		}
	}

	const validateNewEmail = (id) => {
		let pass = $('#' + id).val()
		console.log(pass)
		$.get('{{ route('business.account-settings.verify.pass') }}', {
				pass: pass
			})
			.done((data) => {
				if (data == 1) {
					$("#newEmailModal").css("display", "flex");
					$("#reenterPass4EmailModal").css("display", "none");
				} else {
					alert('Wrong password, please try again')
				}
			})
		// reenterPass4Email()
	}
	const changeEmail = () => {
		let email = $('#newEmail').val()
		let repass = $('#reenterPassword4email').val()
		$.post('{{ route('business.account-settings.email.store') }}')
			.done((data) => {

			})
	}
	// 		newEmail
	// reenterPassword4email
	$(() => {
		$('#password4email').removeAttr('autocomplete')
	});
</script>
@endsection
