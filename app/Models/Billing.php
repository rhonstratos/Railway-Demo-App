<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Billing
 *
 * @property int $id
 * @property string $billingId
 * @property int $appointment_id
 * @property string $repair_remarks
 * @property string $repair_cost
 * @property array $items
 * @property string $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Appointments $appointment
 * @method static \Illuminate\Database\Eloquent\Builder|Billing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Billing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Billing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereBillingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereRepairCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereRepairRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Billing whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Billing extends Model
{
	use HasFactory;

	public function appointment()
	{
		return $this->belongsTo(Appointments::class, 'appointment_id', 'id');
	}

	protected $table = 'billings';

	protected $primaryKey = 'billingId';
	protected $keyType = 'string';

	protected $guarded = [];
	protected $hidden = [];
	protected $casts = [
		'items' => 'encrypted:array',
	];
}
