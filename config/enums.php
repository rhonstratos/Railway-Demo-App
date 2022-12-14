<?php

use App\Models\{Appointments, Orders, Shop, User};

return [
	'user_types' => [
		User::IS_CUSTOMER => 'customer',
		User::IS_BUSINESS => 'business',
	],
	'week_days' => [
		Shop::WEEK_MONDAY => 'Monday',
		Shop::WEEK_TUESDAY => 'Tuesday',
		Shop::WEEK_WEDNESDAY => 'Wednesday',
		Shop::WEEK_THURSDAY => 'Thursday',
		Shop::WEEK_FRIDAY => 'Friday',
		Shop::WEEK_SATURDAY => 'Saturday',
		Shop::WEEK_SUNDAY => 'Sunday',
	],
	'appointment_status' => [
		Appointments::APPOINTMENT_APPROVED => 'Approved',
		Appointments::APPOINTMENT_PENDING => 'Pending',
		Appointments::APPOINTMENT_CANCELED => 'Canceled',
		Appointments::APPOINTMENT_REJECTED => 'Rejected',
	],
	'repair_status' => [
		Appointments::REPAIR_NOT_STARTED => 'Not yet started',
		Appointments::REPAIR_REPAIRING => 'Reparing',
		Appointments::REPAIR_WAITING_PARTS => 'Waiting for parts',
		Appointments::REPAIR_COMPLETED => 'Completed',
		Appointments::REPAIR_FAILED => 'Failed',
	],
	'order_status' => [
		Orders::STATUS_WAITING => 'Waiting For Confirmation',
		Orders::STATUS_PREPARING => 'Preparing',
		Orders::STATUS_SHIPPING => 'Shipping',
		Orders::STATUS_SHIPPED => 'Shipped',
		Orders::STATUS_CONFIRM_MEET_UP => 'Confirm Meet-up Location',
		Orders::STATUS_READY_TO_PICK => 'Ready To Be Picked Up',
		Orders::STATUS_COMPLETED => 'Completed',
		Orders::STATUS_CANCELED => 'Canceled',
	],
	'order_status_optgroup' => [
		Orders::STATUS_WAITING => 'Waiting For Confirmation',
		Orders::STATUS_CANCELED => 'Cancel Order',
		Orders::STATUS_PREPARING => 'Preparing',
		'delivery' => [
			Orders::STATUS_SHIPPING => 'Shipping',
			Orders::STATUS_SHIPPED => 'Shipped',
		],
		'meet-up' => [
			Orders::STATUS_CONFIRM_MEET_UP => 'Confirm Meet-up Location',
		],
		'pick-up' => [
			Orders::STATUS_READY_TO_PICK => 'Ready To Be Picked Up',
		],
		Orders::STATUS_COMPLETED => 'Completed',
	],

	'appointment_status_colors' => [
		Appointments::APPOINTMENT_APPROVED => 'text-status-green',
		Appointments::APPOINTMENT_PENDING => 'text-status-purple',
		Appointments::APPOINTMENT_CANCELED => 'text-status-yellow',
		Appointments::APPOINTMENT_REJECTED => 'text-status-red',
	],
	'repair_status_colors' => [
		Appointments::REPAIR_NOT_STARTED => 'text-status-bluegreen',
		Appointments::REPAIR_REPAIRING => 'text-status-purple',
		Appointments::REPAIR_WAITING_PARTS => 'text-status-yellow',
		Appointments::REPAIR_COMPLETED => 'text-status-green',
		Appointments::REPAIR_FAILED => 'text-status-red',
	],

];
