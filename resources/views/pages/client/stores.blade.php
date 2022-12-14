@extends('layouts.customer')

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Shops</title>
@endsection

@section('content')
	<section class="bg-[#F8F9FA] lg:pt-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">
		<h1 class="text-center mb-[4rem] relative"><span
				class="text-[3rem] pt-[.5rem] pb-[1rem] px-[2rem] text-[#344767] font-extrabold"> <span>Components</span>
		</h1>

		<x-customer.empty-section-samples />







		<!--toast-->


		{{--  <div id="toast-success"
            class="flex items-center p-6 mb-4 w-full max-w-[30rem] text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex flex-shrink-0 justify-center items-center w-10 h-10 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-5 text-[1.3rem] font-normal">Item moved successfully.</div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-10 w-10 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div id="toast-danger"
            class="flex items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ml-3 text-[1.3rem] font-normal">Item has been deleted.</div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-danger" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div id="toast-warning"
            class="flex items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Warning icon</span>
            </div>
            <div class="ml-3 text-[1.3rem] font-normal">Improve password difficulty.</div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-warning" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div> --}}


		<!--end toast-->




		<button onclick="launch_successtoast()" class="text-[#fff] text-[1.3rem] p-4 bg-{{$site_settings->site_color_theme}} block mb-5">Click this button
			to show a successful Toast</button>
		<button onclick="launch_errortoast()" class="text-[#fff] p-4 text-[1.3rem] bg-{{$site_settings->site_color_theme}} block">Click this button to show
			an error Toast</button>


		<button onclick="cancelAppointmentModal.show()"
			class="inline-block mt-3 ml-[10px] h-[4rem] text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border-none text-[1.3rem] font-medium px-6 py-2.5 hover:text-gray-900 focus:z-10">
			Cancel Appointment
		</button>

		<date-picker format="MMMM DD (DDD), YYYY"
			class="bg-[#F2F2F2] border-none flex items-center text-gray-900 rounded-lg text-[1.3rem] focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} w-full p-2.5 py-auto h-[2.9rem]">
		</date-picker>




		{{-- <div id="toast" class="invisible max-w-[50px] h-[50px] m-auto
bg-[#333] text-[#fff]
text-center rounded-[2px]
fixed z-[1] left-0 right-0
bottom-[30px] text-[1.3rem] whitespace-nowrap"><div id="img" class="w-[50px]
h-[50px]
float-left
pt-[16px]
pb-[16px]
box-border
bg-[#111]
text-[#fff]">Icon</div><div id="desc" class="text-[#fff]
p-[16px]
overflow-hidden
whitespace-nowrap">A notification message..</div></div> --}}

		{{-- The css class is at the customer.blade.php --}}

		<div id="toast">
			<div id="img">
				<div class="inline-flex justify-center items-center w-10 h-10 text-green-500 bg-green-100 rounded-lg">
					<svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd"
							d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
							clip-rule="evenodd"></path>
					</svg>
					<span class="sr-only">Check icon</span>
				</div>
			</div>
			<div id="desc">Item has been added to your shopping cart</div>
		</div>


		<div id="toast-error">
			<div id="img">
				<div class="inline-flex justify-center items-center w-10 h-10 text-orange-500 bg-orange-100 rounded-lg">
					<svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd"
							d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
							clip-rule="evenodd"></path>
					</svg>
					<span class="sr-only">Error icon</span>
				</div>

			</div>
			<div id="desc"">This tem is already in your cart!</div>
		</div>




		<!--Start Modal for cancel appointment-->

		<div id="cancel-appointment-modal" tabindex="-1"
			class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center"
			aria-hidden="true">
			<div class="relative p-4 h-auto">
				<div class="relative bg-white rounded-lg shadow">
					<button type="button"
						class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
						onclick="cancelAppointmentModal.hide()">
						<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd"
								d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
					<div class="p-6 text-center">


						<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700">Cancel Appointment</h3>

						<div class="mb-6">
							<label for="email" class="block mb-2 text-[1.3rem] text-left font-medium text-gray-900 dark:text-gray-300">
								Reason for Cancelling <span class="text-red-500">*</span>
							</label>

							<textarea name="reason-cancel" rows="4"
							 class="h-[110px] resize-none block p-2.5 w-full text-[1.3rem] text-gray-900 bg-[#F2F2F2] rounded-lg border-none focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-{{$site_settings->site_color_theme}} dark:focus:border-{{$site_settings->site_color_theme}}"
							 placeholder="Ex. I had a work conflict"></textarea>
						</div>

						<p class="mb-5 text-[1.3rem] text-left font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
							cancel? After cancelling,
							no further changes can be made to this appointment.
						</p>


						<button type="button" onclick="newcancelAppointmentModal.show(); cancelAppointmentModal.hide()"
							class="text-white bg-red-500 hover:bg-red-700 text-[1.3rem] rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
							Yes, Cancel
						</button>
						<button onclick="cancelAppointmentModal.hide()" type="button"
							class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm text-[1.3rem] px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
							Go back</button>
					</div>
				</div>
			</div>
		</div>

		<!--End Modal for cancel appointment-->


	</section>

	{{-- start button for disable auth --}}

	<div>
		<button onclick="disableauthenticationModal.show()"
			class="inline-flex items-center font-bold text-[#fff] bg-red-500 hover:bg-red-700 shadow-xl hover:shadow-none focus:outline-none rounded-lg text-[1.3rem] px-3 py-1"
			type="button">
			<i class="fa-solid fa-mobile-screen-button mr-3 w-5 h-5 mb-1"></i>
			Disable Two Factor Auth
		</button>
	</div>

	{{-- end button for disable auth --}}

	{{-- Start Modal for disable 2fa --}}
	<div id="disable-authentication" tabindex="-1"
	class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center"
	aria-hidden="true">
	<div class="relative p-4 h-auto">
		<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
			{{-- clost modal --}}
			<button type="button"
				class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
				onclick="disableauthenticationModal.hide()">
				<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
					xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd"
						d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
						clip-rule="evenodd"></path>
				</svg>
				<span class="sr-only">Close modal</span>
			</button>
			{{-- modal body --}}
			<form id="2fa-form-validate" method="post" autocomplete="off"
				 class="p-6 text-center">
				@csrf
				<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700 md:w-[50rem] w-[35rem]">
					Disable Two Factor Authentication
				</h3>
				<p class="mb-5 text-[1.3rem] text-left font-normal text-gray-500 ">
					Enter your password first
				</p>
				<div class="mb-6">
					<label for="2fa_password"
						class="block mb-2 text-[1.3rem] text-left font-medium text-gray-900 dark:text-gray-300">
						Password
					</label>
					<input type="password" id="2fa_password" name="password" autocomplete="off"
						class="bg-gray-50 text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} block w-full p-2.5"
						placeholder="•••••••••">
				</div>

				<p class="mb-5 text-[1.3rem] text-left font-normal text-gray-500 ">
					Then enter the 6 digit code from the authenticator
				</p>
				<div class="mb-6">
					<input class="bg-gray-50 text-gray-900 border-none rounded-lg w-full text-[1.3rem] focus:border-{{$site_settings->site_color_theme}} focus:ring-{{$site_settings->site_color_theme}} p-2.5" type="number" name="gAuth" pattern="[0-9]{6}"
						placeholder="000000" id="gAuth">
				</div>

				<button type="submit"
					class="text-white button-shade text-[1.3rem] rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
					Continue
				</button>
				<button onclick="disableauthenticationModal.hide()" type="reset"
					class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm text-[1.3rem] px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
			</form>
		</div>
	</div>
</div>
{{-- End Modal for disable 2fa --}}

	<script>
		$(() => {
			cancelAppointmentModal = new Modal(document.getElementById('cancel-appointment-modal'))
			disableauthenticationModal = new Modal(document.getElementById('disable-authentication'))
		});

		function launch_successtoast() {
			var x = document.getElementById("toast")
			x.className = "show";
			setTimeout(function() {
				x.className = x.className.replace("show", "");
			}, 5000);
		}

		function launch_errortoast() {
			var x = document.getElementById("toast-error")
			x.className = "show";
			setTimeout(function() {
				x.className = x.className.replace("show", "");
			}, 5000);
		}



		function getWeekNumber(date) {
			const firstDayOfTheYear = new Date(date.getFullYear(), 0, 1);
			const pastDaysOfYear = (date.getTime() - firstDayOfTheYear.getTime()) / 86400000;

			return Math.ceil((pastDaysOfYear + firstDayOfTheYear.getDay() + 1) / 7)
		}

		function isLeapYear(year) {
			return year % 100 === 0 ? year % 400 === 0 : year % 4 === 0;
		}

		class Day {
			constructor(date = null, lang = 'default') {
				date = date ?? new Date();

				this.Date = date;
				this.date = date.getDate();
				this.day = date.toLocaleString(lang, {
					weekday: 'long'
				});
				this.dayNumber = date.getDay() + 1;
				this.dayShort = date.toLocaleString(lang, {
					weekday: 'short'
				});
				this.year = date.getFullYear();
				this.yearShort = date.toLocaleString(lang, {
					year: '2-digit'
				});
				this.month = date.toLocaleString(lang, {
					month: 'long'
				});
				this.monthShort = date.toLocaleString(lang, {
					month: 'short'
				});
				this.monthNumber = date.getMonth() + 1;
				this.timestamp = date.getTime();
				this.week = getWeekNumber(date);
			}

			get isToday() {
				return this.isEqualTo(new Date());
			}

			isEqualTo(date) {
				date = date instanceof Day ? date.Date : date;

				return date.getDate() === this.date &&
					date.getMonth() === this.monthNumber - 1 &&
					date.getFullYear() === this.year;
			}

			format(formatStr) {
				return formatStr
					.replace(/\bYYYY\b/, this.year)
					.replace(/\bYYY\b/, this.yearShort)
					.replace(/\bWW\b/, this.week.toString().padStart(2, '0'))
					.replace(/\bW\b/, this.week)
					.replace(/\bDDDD\b/, this.day)
					.replace(/\bDDD\b/, this.dayShort)
					.replace(/\bDD\b/, this.date.toString().padStart(2, '0'))
					.replace(/\bD\b/, this.date)
					.replace(/\bMMMM\b/, this.month)
					.replace(/\bMMM\b/, this.monthShort)
					.replace(/\bMM\b/, this.monthNumber.toString().padStart(2, '0'))
					.replace(/\bM\b/, this.monthNumber)
			}
		}

		class Month {
			constructor(date = null, lang = 'default') {
				const day = new Day(date, lang);
				const monthsSize = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
				this.lang = lang;

				this.name = day.month;
				this.number = day.monthNumber;
				this.year = day.year;
				this.numberOfDays = monthsSize[this.number - 1];

				if (this.number === 2) {
					this.numberOfDays += isLeapYear(day.year) ? 1 : 0;
				}

				this[Symbol.iterator] = function*() {
					let number = 1;
					yield this.getDay(number);
					while (number < this.numberOfDays) {
						++number;
						yield this.getDay(number);
					}
				}
			}

			getDay(date) {
				return new Day(new Date(this.year, this.number - 1, date), this.lang);
			}
		}

		class Calendar {
			weekDays = Array.from({
				length: 7
			});

			constructor(year = null, monthNumber = null, lang = 'default') {
				this.today = new Day(null, lang);
				this.year = year ?? this.today.year;
				this.month = new Month(new Date(this.year, (monthNumber || this.today.monthNumber) - 1), lang);
				this.lang = lang;

				this[Symbol.iterator] = function*() {
					let number = 1;
					yield this.getMonth(number);
					while (number < 12) {
						++number;
						yield this.getMonth(number);
					}
				}

				this.weekDays.forEach((_, i) => {
					const day = this.month.getDay(i + 1);
					if (!this.weekDays.includes(day.day)) {
						this.weekDays[day.dayNumber - 1] = day.day
					}
				})
			}

			get isLeapYear() {
				return isLeapYear(this.year);
			}

			getMonth(monthNumber) {
				return new Month(new Date(this.year, monthNumber - 1), this.lang);
			}

			getPreviousMonth() {
				if (this.month.number === 1) {
					return new Month(new Date(this.year - 1, 11), this.lang);
				}

				return new Month(new Date(this.year, this.month.number - 2), this.lang);
			}

			getNextMonth() {
				if (this.month.number === 12) {
					return new Month(new Date(this.year + 1, 0), this.lang);
				}

				return new Month(new Date(this.year, this.month.number + 2), this.lang);
			}

			goToDate(monthNumber, year) {
				this.month = new Month(new Date(year, monthNumber - 1), this.lang);
				this.year = year;
			}

			goToNextYear() {
				this.year += 1;
				this.month = new Month(new Date(this.year, 0), this.lang);
			}

			goToPreviousYear() {
				this.year -= 1;
				this.month = new Month(new Date(this.year, 11), this.lang);
			}

			goToNextMonth() {
				if (this.month.number === 12) {
					return this.goToNextYear();
				}

				this.month = new Month(new Date(this.year, (this.month.number + 1) - 1), this.lang);
			}

			goToPreviousMonth() {
				if (this.month.number === 1) {
					return this.goToPreviousYear();
				}

				this.month = new Month(new Date(this.year, (this.month.number - 1) - 1), this.lang);
			}
		}

class DatePicker extends HTMLElement {
  format = 'MMM DD, YYYY';
  position = 'top';
  visible = false;
  date = null;
  mounted = false;
  // elements
  toggleButton = null;
  calendarDropDown = null;
  calendarDateElement = null;
  calendarDaysContainer = null;
  selectedDayElement = null;

			constructor() {
				super();

				const lang = window.navigator.language;
				const date = new Date(this.date ?? (this.getAttribute("date") || Date.now()));

				this.shadow = this.attachShadow({
					mode: "open"
				});
				this.date = new Day(date, lang);
				this.calendar = new Calendar(this.date.year, this.date.monthNumber, lang);

				this.format = this.getAttribute('format') || this.format;
				this.position = DatePicker.position.includes(this.getAttribute('position')) ?
					this.getAttribute('position') :
					this.position;
				this.visible = this.getAttribute('visible') === '' ||
					this.getAttribute('visible') === 'true' ||
					this.visible;

				this.render();
			}

			connectedCallback() {
				this.mounted = true;

				this.toggleButton = this.shadow.querySelector('.date-toggle');
				this.calendarDropDown = this.shadow.querySelector('.calendar-dropdown');
				const [prevBtn, calendarDateElement, nextButton] = this.calendarDropDown
					.querySelector('.header').children;
				this.calendarDateElement = calendarDateElement;
				this.calendarDaysContainer = this.calendarDropDown.querySelector('.month-days');

				this.toggleButton.addEventListener('click', () => this.toggleCalendar());
				prevBtn.addEventListener('click', () => this.prevMonth());
				nextButton.addEventListener('click', () => this.nextMonth());
				document.addEventListener('click', (e) => this.handleClickOut(e));

				this.renderCalendarDays();
			}

			attributeChangedCallback(name, oldValue, newValue) {
				if (!this.mounted) return;

				switch (name) {
					case "date":
						this.date = new Day(new Date(newValue));
						this.calendar.goToDate(this.date.monthNumber, this.date.year);
						this.renderCalendarDays();
						this.updateToggleText();
						break;
					case "format":
						this.format = newValue;
						this.updateToggleText();
						break;
					case "visible":
						this.visible = ['', 'true', 'false'].includes(newValue) ?
							newValue === '' || newValue === 'true' :
							this.visible;
						this.toggleCalendar(this.visible);
						break;
					case "position":
						this.position = DatePicker.position.includes(newValue) ?
							newValue :
							this.position;
						this.calendarDropDown.className =
							`calendar-dropdown ${this.visible ? 'visible' : ''} ${this.position}`;
						break;
				}
			}

			toggleCalendar(visible = null) {
				if (visible === null) {
					this.calendarDropDown.classList.toggle('visible');
				} else if (visible) {
					this.calendarDropDown.classList.add('visible');
				} else {
					this.calendarDropDown.classList.remove('visible');
				}

				this.visible = this.calendarDropDown.className.includes('visible');

				if (this.visible) {
					this.calendarDateElement.focus();
				} else {
					this.toggleButton.focus();

					if (!this.isCurrentCalendarMonth()) {
						this.calendar.goToDate(this.date.monthNumber, this.date.year);
						this.renderCalendarDays();
					}
				}
			}

			prevMonth() {
				this.calendar.goToPreviousMonth();
				this.renderCalendarDays();
			}

			nextMonth() {
				this.calendar.goToNextMonth();
				this.renderCalendarDays();
			}

			updateHeaderText() {
				this.calendarDateElement.textContent =
					`${this.calendar.month.name}, ${this.calendar.year}`;
				const monthYear = `${this.calendar.month.name}, ${this.calendar.year}`
				this.calendarDateElement
					.setAttribute('aria-label', `current month ${monthYear}`);
			}

			isSelectedDate(date) {
				return date.date === this.date.date &&
					date.monthNumber === this.date.monthNumber &&
					date.year === this.date.year;
			}

			isCurrentCalendarMonth() {
				return this.calendar.month.number === this.date.monthNumber &&
					this.calendar.year === this.date.year;
			}

			selectDay(el, day) {
				if (day.isEqualTo(this.date)) return;

				this.date = day;

				if (day.monthNumber !== this.calendar.month.number) {
					this.prevMonth();
				} else {
					el.classList.add('selected');
					this.selectedDayElement.classList.remove('selected');
					this.selectedDayElement = el;
				}

				this.toggleCalendar();
				this.updateToggleText();
			}

			handleClickOut(e) {
				if (this.visible && (this !== e.target)) {
					this.toggleCalendar(false);
				}
			}

			getWeekDaysElementStrings() {
				return this.calendar.weekDays
					.map(weekDay => `<span>${weekDay.substring(0, 3)}</span>`)
					.join('');
			}

			getMonthDaysGrid() {
				const firstDayOfTheMonth = this.calendar.month.getDay(1);
				const prevMonth = this.calendar.getPreviousMonth();
				const totalLastMonthFinalDays = firstDayOfTheMonth.dayNumber - 1;
				const totalDays = this.calendar.month.numberOfDays + totalLastMonthFinalDays;
				const monthList = Array.from({
					length: totalDays
				});

				for (let i = totalLastMonthFinalDays; i < totalDays; i++) {
					monthList[i] = this.calendar.month.getDay(i + 1 - totalLastMonthFinalDays)
				}

				for (let i = 0; i < totalLastMonthFinalDays; i++) {
					const inverted = totalLastMonthFinalDays - (i + 1);
					monthList[i] = prevMonth.getDay(prevMonth.numberOfDays - inverted);
				}

				return monthList;
			}

			updateToggleText() {
				const date = this.date.format(this.format)
				this.toggleButton.textContent = date;
			}

			updateMonthDays() {
				this.calendarDaysContainer.innerHTML = '';

				this.getMonthDaysGrid().forEach(day => {
					const el = document.createElement('button');
					el.className = 'month-day';
					el.textContent = day.date;
					el.addEventListener('click', (e) => this.selectDay(el, day));
					el.setAttribute('aria-label', day.format(this.format));

					if (day.monthNumber === this.calendar.month.number) {
						el.classList.add('current');
					}

					if (this.isSelectedDate(day)) {
						el.classList.add('selected');
						this.selectedDayElement = el;
					}

					this.calendarDaysContainer.appendChild(el);
				})
			}

			renderCalendarDays() {
				this.updateHeaderText();
				this.updateMonthDays();
				this.calendarDateElement.focus();
			}

			static get observedAttributes() {
				return ['date', 'format', 'visible', 'position'];
			}

			static get position() {
				return ['top', 'left', 'bottom', 'right'];
			}

			get style() {
				return `
					:host {
						position: relative;
						font-family: sans-serif;
					}

					/* .date-toggle {
						padding: 8px 15px;
						border: none;
						-webkit-appearance: none;
						-moz-appearance: none;
						appearance: none;
						background: #eee;
						color: #344767
						border-radius: 6px;
						font-weight: bold;
						cursor: pointer;
						text-transform: capitalize;
					} */

					.date-toggle {
						border: none;
						height: 100%;
						width: 100%;
						-webkit-appearance: none;
						-moz-appearance: none;
						appearance: none;
						background: #F2F2F2;
						cursor: pointer;
						text-transform: capitalize;
						color: #808080;
					}

					.calendar-dropdown {
						display: none;
						width: 300px;
						height: 300px;
						position: absolute;
						top: 100%;
						left: 50%;
						transform: translate(-50%, 8px);
						padding: 20px;
						background: #fff;
						border-radius: 5px;
						box-shadow: 0 0 8px rgba(0,0,0,0.2);
						color: #344767
					}

					.calendar-dropdown.top {
						top: auto;
						bottom: 100%;
						transform: translate(-50%, -8px);
					}

					.calendar-dropdown.left {
						top: 50%;
						left: 0;
						transform: translate(calc(-8px + -100%), -50%);
					}

					.calendar-dropdown.right {
						top: 50%;
						left: 100%;
						transform: translate(8px, -50%);
					}

					.calendar-dropdown.visible {
						display: block;
					}

					.header {
						display: flex;
						justify-content: space-between;
						align-items: center;
						margin: 10px 0 30px;
					}

					.header h4 {
						margin: 0;
						text-transform: capitalize;
						font-size: 21px;
						font-weight: bold;
					}

					.header button {
						padding: 0;
						border: 8px solid transparent;
						width: 0;
						height: 0;
						border-radius: 2px;
						border-top-color: #344767;
						transform: rotate(90deg);
						cursor: pointer;
						background: none;
						position: relative;
					}

					.header button::after {
						content: '';
						display: block;
						width: 25px;
						height: 25px;
						position: absolute;
						left: 50%;
						top: 50%;
						transform: translate(-50%, -50%);
					}

					.header button:last-of-type {
						transform: rotate(-90deg);
					}

					.week-days {
						display: grid;
						grid-template-columns: repeat(7, 1fr);
						grid-gap: 5px;
						margin-bottom: 10px;
					}

					.week-days span {
						display: flex;
						justify-content: center;
						align-items: center;
						font-size: 10px;
						text-transform: capitalize;
					}

					.month-days {
						display: grid;
						grid-template-columns: repeat(7, 1fr);
						grid-gap: 5px;
					}

					.month-day {
						padding: 8px 5px;
						background: #c7c9d3;
						color: #fff;
						display: flex;
						justify-content: center;
						align-items: center;
						border-radius: 2px;
						cursor: pointer;
						border: none;
					}

					.month-day.current {
						background: #344767;
					}

					.month-day.selected {
						background: #ff9595;
						color: #ffffff;
					}

					.month-day:hover {
						background: #ff9595;
					}
					`;
			}

			render() {
				const monthYear = `${this.calendar.month.name}, ${this.calendar.year}`;
				const date = this.date.format(this.format)
				this.shadow.innerHTML =
					`<style>${this.style}</style>
					<button type="button" class="date-toggle">${date}</button>
					<div class="calendar-dropdown ${this.visible ? 'visible' : ''} ${this.position}">
						<div class="header">
							<button type="button" class="prev-month" aria-label="previous month"></button>
							<h4 tabindex="0" aria-label="current month ${monthYear}">
							${monthYear}
							</h4>
							<button type="button" class="prev-month" aria-label="next month"></button>
						</div>
						<div class="week-days">${this.getWeekDaysElementStrings()}</div>
						<div class="month-days"></div>
					</div>`
			}
		}

		customElements.define("date-picker", DatePicker);
	</script>
@endsection
