<li
	class="px-3 md:px-0 py-2 mb-2 md:my-1 md:border-b-[1px] flex flex-col md:flex-row gap-2 {{-- md:justify-around md:items-center --}} bg-white md:bg-transparent rounded-[8px] shadow-lg md:shadow-none text-center">
	{{-- top-row --}}
	<div class="md:basis-1/5 flex flex-row justify-between md:justify-around items-center">
		{{-- order id --}}
		<div class="flex flex-row gap-1 italic">
			<span class="md:hidden">Order ID:</span>
			<span>{{ $data->orderId }}</span>
		</div>
	</div>

	{{-- middle-row --}}
	<div class="md:basis-3/5 flex flex-row gap-2 justify-around items-center">
		{{-- customer name --}}
		<div class="md:basis-1/3 flex flex-col items-start md:items-center">
			<span class="font-semibold">{{ $data->user->firstname . ' ' . $data->user->lastname }}</span>
			<span class="italic">{{$data->user->email}}</span>
		</div>

		{{-- order --}}
		<div class="md:basis-1/3 flex flex-col items-start md:items-center">
			<span>{{$data->created_at->format('M d, o')}}</span>
		</div>

		{{-- price --}}
		<div class="md:basis-1/3 flex flex-col items-start md:items-center">
			<span class="">{{config('enums.order_status')[$data->status]}}</span>
			{{-- <span class="text-status-green">Paid</span> --}}
			{{-- <span class="text-status-red">Cancelled</span> --}}
			{{-- <span class="text-status-yellow">Pending</span> --}}
		</div>
	</div>

	{{-- bottom-row --}}
	<div class="md:basis-1/5 flex justify-end md:justify-around items-center">
		{{-- Action --}}
		<button class="px-3 py-1 bg-{{$site_settings->site_color_theme}} text-white rounded-[4px] shadow-lg truncate"
			onclick="location.href='{{ route('business.orders.show', $data->orderId) }}'">
			<span class="">Action</span>
		</button>
	</div>
</li>
