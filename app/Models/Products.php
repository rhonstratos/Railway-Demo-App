<?php

namespace App\Models;


use Caryley\LaravelInventory\HasInventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Products
 *
 * @property int $id
 * @property string $productId
 * @property int $shop_id
 * @property string $name
 * @property mixed $img_showcase
 * @property array $img
 * @property string $category
 * @property string $price
 * @property array $details
 * @property bool $is_variant
 * @property string|null $ratings
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $cart_max_quantity
 * @property string|null $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Favorites[] $favorite
 * @property-read int|null $favorite_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inventory[] $inventories
 * @property-read int|null $inventories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders[] $orderedItems
 * @property-read int|null $ordered_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reviews[] $rev
 * @property-read int|null $rev_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reviews[] $revCa
 * @property-read int|null $rev_ca_count
 * @property-read \App\Models\Reviews|null $reviews
 * @property-read \App\Models\Shop $shop
 * @method static \Database\Factories\ProductsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Products inventoryIs($quantity = 0, $operator = '=', ...$inventoriableId)
 * @method static \Illuminate\Database\Eloquent\Builder|Products inventoryIsNot($quantity = 0, ...$inventoriableId)
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCartMaxQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereImgShowcase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereIsVariant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereRatings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Products extends Model
{
	use HasFactory, HasInventory;

	public function shop()
	{
		return $this->belongsTo(Shop::class);
	}
	// public function sales()
	// {
	// 	return $this->belongsToMany(Sales::class);
	// }
	public function favorite()
	{
		return $this->hasMany(Favorites::class, 'product_id');
	}
	public function reviews()
	{
		return $this->hasOneThrough(Reviews::class, User::class, 'id', 'user_id');
	}
	public function rev()
	{
		return $this->hasMany(Reviews::class, 'product_id');
	}
	public function revCa()
	{
		return $this->hasMany(Reviews::class, 'product_id');
	}
	// public function orderedItems()
	// {
	// 	return $this->hasManyThrough(Orders::class,OrderedProducts::class,'product_id','id','id','order_id');
	// }
	public function orderedItems()
	{
		return $this->hasMany(OrderedProducts::class,'product_id')->with([
			'order' =>
			fn($q) =>
			$q->where('orders.status', Orders::STATUS_COMPLETED)
		]);
	}
	// public function scopeHasReview($q)
	// {
	// 	return $this->reviews()
	// 		->where('id', $q->id)
	// 		->where('reviews.user_id', Auth::id())
	// 		->exists();
	// }

	/**
	 * Get inventory of the model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function inventories()
	{
		return $this->morphMany($this->getInventoryModelClassName(), 'inventoriable')->latest('id');
	}

	protected $with = [
		// 'shop',
		'inventories'
	];

	protected $guarded = [];

	protected $casts = [
		'is_variant' => 'boolean',
		'img' => 'encrypted:array',
		'img_showcase' => 'encrypted',
		'details' => 'array',
	];
}
