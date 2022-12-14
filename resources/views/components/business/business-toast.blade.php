<div class="{{-- fixed z-[10] top-[16px] left-1/2 text-[14px] 2xl:text-[16px] --}}" id="business-toast">
	<div class="relative px-3 py-2 -left-1/2 flex flex-row gap-2 justify-around items-center bg-white rounded-[8px] shadow-xl" id="business-toaster">
		{{-- icon --}}
		<div class="flex justify-center items-center">
			@if ($lefticon == 'success')
			<i class="fa-solid fa-check text-status-green"></i>
			@elseif ($lefticon == 'failed')
			<i class="fa-solid fa-xmark text-status-red"></i>
			@endif
		</div>
	
		{{-- message --}}
		<div @class([($messageclass ?? ''), ''])>
			{{ $message }}
		</div>
	</div>
</div>

<script>
	function launch_toast() {
		var x = document.getElementById("business-toast")
		x.className = "toast-show";
		setTimeout(() => {
			x.className = x.className.replace("toast-show", "");
		}, 2000);
	}
	launch_toast();
</script>