<?php
namespace App\Actions\Customer\Appointments;

class SearchAppointments
{
	public function searchByAppointmentId($appointment, $appointmentId)
	{
		return $appointment->where('appointmentId', 'LIKE', '%' . $appointmentId . '%');
	}
}
