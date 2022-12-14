<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Orders
 *
 * @property int $id
 * @property int $user_id
 * @property int $shop_id
 * @property string $status
 * @property string $total
 * @property string $transfer_method
 * @property string $payment_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $orderId
 * @property string|null $reason
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderedProducts[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\OrdersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders query()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereTransferMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereUserId($value)
 * @mixin \Eloquent
 */
class Orders extends Model
{
	use HasFactory;
	public const STATUS_WAITING = 0;
	public const STATUS_PREPARING = 1;
	public const STATUS_SHIPPING = 2;
	public const STATUS_SHIPPED = 3;
	public const STATUS_CONFIRM_MEET_UP = 4;
	public const STATUS_READY_TO_PICK = 5;
	public const STATUS_COMPLETED = 6;
	public const STATUS_CANCELED = 7;

	public function items()
	{
		return $this->hasMany(OrderedProducts::class, 'order_id', 'id');
	}

	// public function order()
	// {
	// 	return $this->belongsTo(Orders::class, 'order_id', 'id');
	// }

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	protected $table = 'orders';
	// protected $primaryKey = 'orderId';
	// protected $keyType = 'string';
	// public $incrementing = false;
	// protected $with = ['order'];
	protected $guarded = [];
	protected $hidden=[];
}
