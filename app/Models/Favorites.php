<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Favorites
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Products $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reviews[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\FavoritesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites query()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites whereUserId($value)
 * @mixin \Eloquent
 */
class Favorites extends Model
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
	public function reviews()
	{
		return $this->hasManyThrough(Reviews::class, Products::class, 'id', 'product_id','product_id');
	}


	protected $fillable = [
		'user_id',
		'product_id',
	];
}
