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
	<div id="desc" @class([($messageclass ?? ''), ''])>
		{{ $message }}
	</div>
</div>

<script>
	function launch_successtoast() {
		var x = document.getElementById("toast")
		x.className = "show";
		setTimeout(() => {
			x.className = x.className.replace("show", "");
		}, 5000);
	}
	launch_successtoast();
</script>
