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
	<div id="desc">
		{{ $message }}
	</div>
</div>
<script>
	function launch_errortoast() {
		var x = document.getElementById("toast-error")
		x.className = "show";
		setTimeout(() => {
			x.className = x.className.replace("show", "");
		}, 5000);
	}
	launch_errortoast();
</script>
