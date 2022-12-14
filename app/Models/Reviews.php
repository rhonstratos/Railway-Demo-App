<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reviews
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $product_id
 * @property int|null $appointment_id
 * @property mixed $message
 * @property string $ratings
 * @property array|null $attachments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Products|null $product
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ReviewsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereRatings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reviews whereUserId($value)
 * @mixin \Eloquent
 */
class Reviews extends Model
{
	use HasFactory;

	public function product()
	{
		return $this->belongsTo(Products::class);
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function appointment()
	{
		return $this->belongsTo(Appointments::class, 'appointment_id', 'id');
	}

	protected $guarded = [];
	protected $hidden = [];
	protected $casts = [
		'message' => 'encrypted',
		'attachments' => 'encrypted:array',
	];
}
