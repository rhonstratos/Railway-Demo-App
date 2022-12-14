<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderedProducts
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $quantity
 * @property string $subtotal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders $order
 * @property-read \App\Models\Products $product
 * @method static \Database\Factories\OrderedProductsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderedProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderedProducts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderedProducts query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderedProducts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderedProducts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderedProducts whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderedProducts whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderedProducts whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderedProducts whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderedProducts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderedProducts extends Model
{
	use HasFactory;

	public function product()
	{
		return $this->belongsTo(Products::class);
	}
	public function order()
	{
		return $this->belongsTo(Orders::class);
	}

	protected $with = ['product'];
	protected $guarded = [];
}
