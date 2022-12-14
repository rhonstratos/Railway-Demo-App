<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Appointments
 *
 * @property int $id
 * @property string $appointmentId
 * @property int $user_id
 * @property mixed|null $alt_contact
 * @property array $product_details
 * @property mixed $concern
 * @property string $appointment_date_time
 * @property mixed|null $appointment_status
 * @property mixed|null $repair_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AppointmentsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments query()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereAltContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereAppointmentDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereAppointmentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereConcern($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereProductDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereRepairStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereUserId($value)
 * @mixin \Eloquent
 * @property int $shop_id
 * @property mixed|null $reason
 * @property-read \App\Models\Billing|null $billing
 * @property-read \App\Models\Reviews|null $review
 * @property-read \App\Models\Shop $shop
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointments whereShopId($value)
 */
class Appointments extends Model
{
	use HasFactory;

	const APPOINTMENT_APPROVED = 0;
	const APPOINTMENT_PENDING = 1;
	const APPOINTMENT_CANCELED = 2;
	const APPOINTMENT_REJECTED = 3;

	const REPAIR_NOT_STARTED = 0;
	const REPAIR_REPAIRING = 1;
	const REPAIR_WAITING_PARTS = 2;
	const REPAIR_COMPLETED = 3;
	const REPAIR_FAILED = 4;

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function shop()
	{
		return $this->belongsTo(Shop::class);
	}

	public function billing()
	{
		return $this->hasOne(Billing::class, 'appointment_id', 'id');
	}

	public function review()
	{
		return $this->hasOne(Reviews::class, 'appointment_id', 'id');
	}

	protected $primaryKey = 'appointmentId';
	protected $keyType = 'string';
	// public $incrementing = false;
	protected $with = [
		'user', 'shop', 'billing'
	];

	protected $guarded = [];

	protected $dates = ['appointment_date_time'];

	protected $hidden = [
		// 'appointmentId',
		// 'user_id',
	];

	protected $casts = [
		// 'appointmentId' => 'encrypted',
		'alt_contact' => 'encrypted',
		'product_details' => 'encrypted:array',
		'concern' => 'encrypted',
		'reason' => 'encrypted',
	];
}
