@extends('layouts.customer')

@section('title')
    <title>{{ Str::title(config('app.name')) }} - Messages</title>
@endsection

@section('content')
{{-- do your front end code here --}}

<div class="loader-container">
	<img src="{{ asset('assets/Rectify/customer-home/gear-loader.gif') }}" alt="">
</div>

<div>
	<iframe src="{{route('messages')}}" class="w-screen md:h-[calc(100vh_-_150px)] md:top-[150px] h-[calc(100vh_-_117.5px)] top-[64px] fixed" frameborder="0"></iframe>
</div>

<script>
    // do your custom scripts here
	function loader() {
			document.querySelector('.loader-container').classList.add('fade-out');
		}

		function fadeOut() {
			setInterval(loader, 2000);
		}

		window.onload = fadeOut();
</script>
@endsection
