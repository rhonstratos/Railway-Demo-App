<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Carts
 *
 * @property int $id
 * @property int $shop_id
 * @property int $user_id
 * @property string $quantity
 * @property string $subtotal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $product_id
 * @property-read \App\Models\Products $product
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CartsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carts query()
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereUserId($value)
 * @mixin \Eloquent
 */
class Carts extends Model
{
	use HasFactory;

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function product()
	{
		return $this->belongsTo(Products::class);
	}

	protected $with = [];
	protected $fillable = [
		'shop_id',
		'user_id',
		'product_id',
		'quantity',
		'subtotal',
	];
	protected $cast = [];
}
