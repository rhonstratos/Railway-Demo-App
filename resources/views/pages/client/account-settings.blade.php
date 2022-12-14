@extends('layouts.customer')

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Account Settings</title>
@endsection

@section('content')
	<section class="bg-[#F8F9FA] lg:pt-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">
		<h1 class="text-center mb-[4rem] relative">
			<span class="text-[3rem] pt-[.5rem] pb-[1rem] px-[2rem] text-[#344767] font-extrabold">
				Account Settings
			</span>
		</h1>

		<div>
			{{-- Session Status --}}
			<x-auth-session-status class="mb-4" :status="session('status')" />

			{{-- Validation Errors --}}
			<x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>


		<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative">
			<form action="{{ route('customer.settings.form.store') }}" method="post" enctype="multipart/form-data"
				autocomplete="off">
				@csrf
				@method('PATCH')
				<input type="file" id="user_img" name="user_img" accept="image/*" hidden class="hidden"
					onchange="
				if (this.files && this.files[0]) {
					let reader = new FileReader();
					reader.onload = (e) => {
						$('#user_img_preview').attr('src', e.target.result);
					}
					reader.readAsDataURL(this.files[0]);
				}
			">

				<div class="flex justify-between items-center pb-4 dark:bg-gray-900">
					<div class="relative">
						<h3 class="text-[1.5rem] font-bold text-gray-700">
							Account Information
						</h3>
					</div>

					<div>
						@if (false)
							<button id="edit-profile"
								class="inline-flex items-center font-bold text-gray-500 bg-white shadow-xl hover:shadow-none mr-2 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg text-[1.3rem] px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
								type="button">
								<i class="fa-solid fa-pen mr-3 w-5 h-5 mb-1"></i>
								Edit
							</button>
						@endif

						<button type="submit" name="action" value="basic"
							class="inline-flex items-center font-bold text-[#fff] button-shade shadow-xl hover:shadow-none focus:outline-none rounded-lg text-[1.3rem] px-3 py-1"
							type="button">
							<i class="fa-solid fa-floppy-disk mr-3 w-5 h-5 mb-1"></i>
							Save Changes
						</button>

					</div>
				</div>

				<div class="grid gap-6 md:grid-cols-2 md:grid-flow-col md:grid-rows-5 mb-5">

					<div class="row-span-5">
						<label for="user_img">
							<div
								class="image-hover-text-container mx-auto mt-9
						relative
						w-auto
						h-auto
						transition-all">
								<div class="image-hover-image block">
									<img id="user_img_preview" src="{{ asset($profile_img_path) }}" alt="profile"
										class="mx-auto rounded-full w-[20rem] h-[20rem] object-cover cursor-pointer">
								</div>
								<div
									class="image-hover-text
						  absolute
						  top-0
						  w-full
						  h-full
						  my-0
						  mx-auto
						  opacity-0
						  cursor-pointer
						  transition-opacity
						">
									<div
										class="image-hover-text-bubble
							relative box-border
  							top-0 left-0 right-[100%]
  							h-[20rem]
 							w-[20rem]
  							bg-[rgba(60,60,60,0.8)]
  							rounded-full
 							 my-0 mx-auto
  							md:pt-[10%] pt-[15%] px-[8px] pb-[5px]
  							overflow-hidden
  							text-[1.5rem]
  							text-center
							text-[#fff]
  							break-words
							">
										<span class="image-hover-text-title text-[1.8rem] text-{{$site_settings->site_color_theme}} font-semibold
									block">Upload
											a Picture</span>
										Click to change profile picture
									</div>
								</div>
							</div>
						</label>
						<p class="text-gray-800 text-[2rem] font-bold mt-4 text-center">
							{{ $full_name }}
						</p>
						<p class="text-gray-500 text-[1.5rem] lowercase text-center">
							{{ $user->email }}
						</p>
					</div>

					<div>
						<label for="first_name" class="block mb-2 text-[1.3rem] border-none font-medium text-gray-900 dark:text-gray-300">
							First name
						</label>
						<input type="text" id="first_name" name="first_name"
							class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
							value="{{ $user->firstname }}">
					</div>

					<div>
						<label for="last_name" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
							Last name
						</label>
						<input type="text" id="last_name" name="last_name"
							class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
							value="{{ $user->lastname }}">
					</div>

					<div>
						<label for="contact" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
							Contact Number
						</label>
						<input type="tel" id="contact" name="contact"
							class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
							value="{{ $user->contact }}" pattern="[0-9]{11}">
					</div>

					<div>
						<label for="birthday" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
							Birthday
						</label>
						<input type="date" id="birthday" name="birthday"
							class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
							value="{{ $user->birthday }}">
					</div>

					<div>
						<label for="address" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
							Address
						</label>
						<input type="text" id="address" name="address"
							class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
							value="{{ $user->address ?? __('') }}">
					</div>
				</div>
			</form>
		</div>

		<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative">
			<form action="{{ route('customer.settings.form.store') }}" method="post" autocomplete="off">
				@csrf
				@method('PATCH')
				<div class="flex justify-between items-center pb-4 ">
					<div class="relative">
						<h3 class="text-[1.5rem] font-bold text-gray-70">
							Change Email
						</h3>
					</div>
					<div>
						<button id="edit-email" onclick="emailModal.show()"
							class="inline-flex items-center font-bold text-gray-500 bg-white shadow-xl hover:shadow-none mr-2 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg text-[1.3rem] px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
							type="button">
							<i class="fa-solid fa-pen mr-3 w-5 h-5 mb-1"></i>
							Edit
						</button>
						@if (false)
							<button type="submit" name="action" value="security"
								class="inline-flex items-center font-bold text-[#fff] button-shade shadow-xl hover:shadow-none focus:outline-none rounded-lg text-[1.3rem] px-3 py-1"
								type="button">
								<i class="fa-solid fa-floppy-disk mr-3 w-5 h-5 mb-1"></i>
								Save Changes
							</button>
						@endif
					</div>
				</div>
				<div class="mb-6">
					<label for="email" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
						Email Address
					</label>
					<input type="email" id="email" name="email" autocomplete="nope" readonly
						class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
						placeholder="{{ $user->email }}" value="{{ $user->email }}">
				</div>
			</form>
		</div>

		{{-- Start Modal for change email address --}}
		<div id="email-modal" tabindex="-1"
			class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center"
			aria-hidden="true">
			<div class="relative p-4 h-auto">
				<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
					{{-- close btn --}}
					<button type="button"
						class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
						onclick="emailModal.hide()">
						<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
							xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
					{{-- modal body --}}
					<form id="email-form-validate" action="{{ route('customer.settings.form.pass.validate') }}" method="post"
						autocomplete="off" onsubmit="validatePassword(event,this)" class="p-6 text-center">
						@csrf
						<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700 md:w-[50rem] w-[35rem]">Change Email</h3>
						<p class="mb-5 text-[1.3rem] text-left font-normal text-gray-500 dark:text-gray-400">Enter your password first
						</p>
						<div class="mb-6">
							<label for="password" class="block mb-2 text-[1.3rem] text-left font-medium text-gray-900 dark:text-gray-300">
								Password
							</label>
							<input type="password" id="email_validate_password" name="password" autocomplete="nope"
								class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
								placeholder="•••••••••" value="">
						</div>
						<button type="submit" {{-- onclick="newEmailModal.show(); emailModal.hide()" --}}
							class="text-white button-shade text-[1.3rem] rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
							Continue
						</button>
						<button type="reset" onclick="emailModal.hide()"
							class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm text-[1.3rem] px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
					</form>
				</div>
			</div>
		</div>
		{{-- End Modal for change email address --}}

		{{-- Start Modal for verify otp --}}
		<div id="popup-verify" tabindex="-1"
			class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full justify-center items-center"
			aria-hidden="true">
			<div class="relative p-4 h-full md:h-auto">
				<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
					{{-- close btn --}}
					<button type="button"
						class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
						onclick="emailVerify.hide()">
						<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
							xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
					{{-- modal body --}}
					<div class="p-6 text-center">
						<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700 ">Verify OTP</h3>
						<p class="mb-5 text-[1.3rem] font-normal text-gray-500 dark:text-gray-400">We sent an OTP to
							<br><span class="font-semibold">allenvincentbuning@gmail.com</span>
						</p>
						<form action="" class="mt-5">
							<div id="divOuter" class="w-[190px] overflow-hidden">
								<div id="divInner" class="left-0 sticky">
									<input id="partitioned" type="text" maxlength="4" />
								</div>
							</div>
							<button onclick="newEmailModal.show(); emailVerify.hide()" type="button"
								class="block mt-5 text-white button-shade text-[1.3rem] rounded-lg w-full text-sm items-center px-5 py-2.5 text-center mr-2">
								Verify
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		{{-- end Modal for verify otp --}}

		{{-- Start Modal for input new email address --}}
		<div id="popup-new-email" tabindex="-1"
			class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center"
			aria-hidden="true">
			<div class="relative p-4 h-auto">
				<div class="relative bg-white rounded-lg shadow">
					{{-- close btn --}}
					<button type="button"
						class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
						onclick="newEmailModal.hide()">
						<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
							xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
					{{-- modal body --}}
					<form action="{{ route('customer.settings.form.email.store') }}" method="post" class="p-6 text-center">
						@csrf
						@method('PATCH')
						<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700 ">Enter new email address</h3>
						<div class="mb-6">
							<label for="email" class="block mb-2 text-[1.3rem] text-left font-medium text-gray-900 dark:text-gray-300">
								Email Address
							</label>
							<input type="email" id="new_email" name="new_email" autocomplete="email"
								class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] w-[30rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block p-2.5"
								placeholder="{{ $user->email }}">
						</div>
						<button type="submit"
							class="text-white button-shade text-[1.3rem] rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
							Done
						</button>
						<button onclick="newEmailModal.hide()" type="button"
							class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm text-[1.3rem] px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
					</form>
				</div>
			</div>
		</div>
		{{-- End Modal for input new email address --}}

		{{-- Start Modal for input new password --}}
		<div id="password-modal" tabindex="-1"
			class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center"
			aria-hidden="true">
			<div class="relative p-4 h-auto">
				<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
					{{-- close btn --}}
					<button type="button"
						class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
						onclick="passwordModal.hide()">
						<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
							xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
					{{-- modal body --}}
					<form action="{{ route('customer.settings.form.password.store') }}" method="post" autocomplete="off"
						class="p-6 text-center">
						@csrf
						@method('PATCH')
						<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700 ">Update your password</h3>
						<p class="mb-5 text-[1.3rem] font-normal text-gray-500 dark:text-gray-400">Enter your current password and a new
							password</p>

						<div class="mb-6">
							<label for="current_password"
								class="block mb-2 text-[1.3rem] text-left font-medium text-gray-900 dark:text-gray-300">
								Current Password
							</label>
							<input type="password" id="current_password" name="current_password" autocomplete="nope"
								class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
								placeholder="•••••••••">
						</div>
						<div class="mb-6">
							<label for="new_password"
								class="block mb-2 text-[1.3rem] text-left font-medium text-gray-900 dark:text-gray-300">
								New Password
							</label>
							<input type="password" id="new_password" name="new_password" autocomplete="nope"
								class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
								placeholder="•••••••••">
						</div>
						<div class="mb-6">
							<label for="new_password_confirmation"
								class="block mb-2 text-[1.3rem] text-left font-medium text-gray-900 dark:text-gray-300">
								Confirm New Password
							</label>
							<input type="password" id="new_password_confirmation" name="new_password_confirmation" autocomplete="nope"
								class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
								placeholder="•••••••••">
						</div>
						<button type="submit"
							class="text-white button-shade text-[1.3rem] rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
							Done
						</button>
						<button onclick="passwordModal.hide()" type="reset"
							class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm text-[1.3rem] px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
							Cancel
						</button>
					</form>
				</div>
			</div>
		</div>
		{{-- End Modal for input new password --}}

		<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative">
			<form action="{{ route('customer.settings.form.store') }}" method="post" autocomplete="off">
				@csrf
				@method('PATCH')
				<div class="flex justify-between items-center pb-4 ">
					<div class="relative">
						<h3 class="text-[1.5rem] font-bold text-gray-70">
							Password and Authentication
						</h3>
					</div>
				</div>
				<div class="mb-6 mt-3">
					<div>
						<button onclick="passwordModal.show()"
							class="inline-flex items-center font-bold text-[#fff] button-shade shadow-xl hover:shadow-none focus:outline-none rounded-lg text-[1.3rem] px-3 py-1"
							type="button">
							<i class="fa-solid fa-unlock-keyhole mr-3 w-5 h-5 mb-1"></i>
							Change Password
						</button>
					</div>
				</div>
				<div class="mb-6 mt-3">
					<div class="block mb-5 text-[1.3rem] font-medium text-gray-900">
						Provide extra layer of protection to your account by using two-factor authentication
					</div>
					<div>
						<button onclick="authenticationModal.show()"
							class="inline-flex items-center font-bold text-[#fff] button-shade shadow-xl hover:shadow-none focus:outline-none rounded-lg text-[1.3rem] px-3 py-1"
							type="button">
							<i class="fa-solid fa-mobile-screen-button mr-3 w-5 h-5 mb-1"></i>
							Enable Two Factor Auth
						</button>
					</div>
				</div>
			</form>
		</div>

		{{-- Start Modal for 2fa --}}
		<div id="authentication-modal" tabindex="-1"
			class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center"
			aria-hidden="true">
			<div class="relative p-4 h-auto">
				<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
					{{-- clost modal --}}
					<button type="button"
						class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
						onclick="authenticationModal.hide()">
						<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
							xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
					{{-- modal body --}}
					<form id="2fa-form-validate" action="{{ route('customer.settings.form.pass.validate') }}" method="post"
						onsubmit="validatePassword(event,this)" class="p-6 text-center">
						@csrf
						<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700 md:w-[50rem] w-[35rem]">
							Enable Two Factor Authentication
						</h3>
						<p class="mb-5 text-[1.3rem] text-left font-normal text-gray-500 dark:text-gray-400">
							Enter your password first
						</p>
						<div class="mb-6">
							<label for="2fa_password"
								class="block mb-2 text-[1.3rem] text-left font-medium text-gray-900 dark:text-gray-300">
								Password
							</label>
							<input type="password" id="2fa_password" name="password" autocomplete="off"
								class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
								placeholder="•••••••••">
						</div>
						<button type="submit" {{-- onclick="authenticationQRModal.show(); authenticationModal.hide()" --}}
							class="text-white button-shade text-[1.3rem] rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
							Continue
						</button>
						<button onclick="authenticationModal.hide()" type="reset"
							class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm text-[1.3rem] px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
					</form>
				</div>
			</div>
		</div>
		{{-- End Modal for 2fa --}}

		{{-- Start Modal for continue 2fa --}}
		<div id="authentication-qr-modal" tabindex="-1"
			class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center"
			aria-hidden="true">
			<div class="relative p-4 h-auto">
				<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
					<button type="button"
						class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
						onclick="authenticationQRModal.hide()">
						<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
							xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
					<div class="p-6 text-center">
						<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700 md:w-[50rem]">Enable Two Factor Authentication</h3>
						<div class="grow flex flex-col gap-2 text-gray-500 text-[1.3rem] mb-5">
							{{-- span --}}
							<div class="flex flex-row gap-2 justify-center">
								<span class="basis-1/2 text-center">Download and install the Google Authenticator app</span>
								<span class="basis-1/2 text-center">Scan the QR code using the Authenticator app</span>
							</div>
							{{-- logo and qr image --}}
							<div class="flex flex-row gap-2 justify-around items-center">
								<div class="w-[150px] h-[150px]">
									<img class="w-full h-auto"
										src="https://img.talkandroid.com/uploads/2015/12/Google_Authenticator_update_material_design_Wear_120715_1.png"
										alt="">
								</div>

								<div id="qr-img" class="w-[150px] h-[150px]">
									{{-- qr image --}}
								</div>
							</div>
						</div>
						<button type="button" onclick="show2faForm()"
							class="text-white button-shade text-[1.3rem] rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
							Continue
						</button>
						<button onclick="authenticationQRModal.hide()" type="button"
							class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm text-[1.3rem] px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
					</div>
				</div>
			</div>
		</div>
		{{-- End Modal for continue 2fa --}}


		{{-- Start Modal for 6 digit verification --}}
		<div id="six-digit" tabindex="-1"
			class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center"
			aria-hidden="true">
			<div class="relative p-4 h-auto">
				<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
					{{-- closode btn --}}
					<button type="reset"
						class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
						onclick="sixDigit.hide();$('#gAuth-string').remove();">
						<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
							xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
					{{-- modal body --}}
					<form id="form-gAuth" action="{{ route('customer.settings.form.2fa.store') }}" method="post"
						class="p-6 text-center">
						@csrf
						@method('PATCH')
						<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700">
							Six Digit Verification
						</h3>
						<p class="mb-5 text-[1.3rem] font-normal text-gray-500 dark:text-gray-400">
							Enter the 6 digit code from the authenticator
						</p>
						<div>
							<input class="business-input-textbox w-full focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}}" type="number" name="gAuth" pattern="[0-9]{6}"
								placeholder="000000" id="gAuth">
						</div>
						<button type="submit"
							class="block mt-5 text-white button-shade text-[1.3rem] rounded-lg w-full text-sm items-center px-5 py-2.5 text-center mr-2">
							Verify
						</button>
					</form>
				</div>
			</div>
			{{-- end Modal for 6 digit verification --}}
	</section>

	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var emailModal
		var emailVerify
		var newEmailModal
		var passwordModal
		var obj = document.getElementById('partitioned');
		var auth_string

		// functions
		const stopCarret = () => {
			if (obj.value.length > 3) {
				setCaretPosition(obj, 3);
			}
		};
		const setCaretPosition = (elem, caretPos) => {
			if (elem != null) {
				if (elem.createTextRange) {
					var range = elem.createTextRange();
					range.move('character', caretPos);
					range.select();
				} else {
					if (elem.selectionStart) {
						elem.focus();
						elem.setSelectionRange(caretPos, caretPos);
					} else
						elem.focus();
				}
			}
		};
		const getCodeBoxElement = (index) => {
			return document.getElementById('codeBox' + index);
		};
		const onKeyUpEvent = (index, event) => {
			const eventCode = event.which || event.keyCode;
			if (getCodeBoxElement(index).value.length === 1) {
				if (index !== 6) {
					getCodeBoxElement(index + 1).focus();
				} else {
					getCodeBoxElement(index).blur();
					// Submit code
					console.log('submit code ');
				}
			}
			if (eventCode === 8 && index !== 1) {
				getCodeBoxElement(index - 1).focus();
			}
		};
		const onFocusEvent = (index) => {
			for (item = 1; item < index; item++) {
				const currentElement = getCodeBoxElement(item);
				if (!currentElement.value) {
					currentElement.focus();
					break;
				}
			}
		};
		const validatePassword = (event, el) => {
			event.preventDefault();

			let password = el.id == 'email-form-validate' ? $('#email_validate_password').val() : null
			password = el.id == '2fa-form-validate' ? $('#2fa_password').val() : password

			$.post(el.action, {
					password: password
				})
				.done((data) => {
					if (el.id == 'email-form-validate') {
						emailModal.hide()
						newEmailModal.show()
					}
					if (el.id == '2fa-form-validate') {
						getQRCode()
						$(() => {
							authenticationModal.hide()
							authenticationQRModal.show()
						})
					}
				})
				.fail((xhr, textStatus, error) => {
					alert('password is not valid, please try again')
				})
		};
		const getQRCode = () => {
			$.get(window.location.href + '/create', (data) => {})
				.done((data) => {
					console.log(data);
					let id = '#qr-img'

					$(id).html(data['qr'])
					auth_string = data['string']
				})
		};

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

		const show2faForm = () => {
			if (auth_string) {
				loadString()
			}
			$(() => {
				sixDigit.show()
				authenticationQRModal.hide()
			})
		};

		// on document ready
		$(() => {
			emailModal = new Modal(document.getElementById('email-modal'))
			emailVerify = new Modal(document.getElementById('popup-verify'))
			newEmailModal = new Modal(document.getElementById('popup-new-email'))
			passwordModal = new Modal(document.getElementById('password-modal'))
			authenticationModal = new Modal(document.getElementById('authentication-modal'))
			authenticationQRModal = new Modal(document.getElementById('authentication-qr-modal'))
			sixDigit = new Modal(document.getElementById('six-digit'))
			obj.addEventListener('keydown', stopCarret);
			obj.addEventListener('keyup', stopCarret);
		});
	</script>
@endsection
