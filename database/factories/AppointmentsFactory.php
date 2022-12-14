<?php

namespace Database\Factories;

use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointments>
 */
class AppointmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'appointmentId' => uniqid(),
            'user_id' => 2,
            'shop_id' => 1,
            'alt_contact' => fake()->phoneNumber(),
            'product_details' => [],
            'concern' => 'fake concern',
            'appointment_date_time' => Carbon::createFromFormat('yy-m-d H:i:s','2022-10-26 11:30:00'),
            'appointment_status' => Appointments::APPOINTMENT_PENDING,
            'repair_status' => Appointments::REPAIR_NOT_STARTED,
        ];
    }
}
