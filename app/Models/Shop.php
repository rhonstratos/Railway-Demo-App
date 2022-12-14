<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
//CipherSweet Imports
use ParagonIE\CipherSweet\EncryptedRow;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;


/**
 * App\Models\Shop
 *
 * @property int $id
 * @property int $user_id
 * @property mixed $name
 * @property mixed|null $description
 * @property mixed|null $address
 * @property array|null $appointment_settings
 * @property array|null $shop_settings
 * @property array|null $services
 * @property array|null $contacts
 * @property mixed|null $googleMaps
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop query()
 * @method static \Illuminate\Database\Eloquent\Builder|Shop role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereAppointmentSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereContacts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereGoogleMaps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereServices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereShopSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereUserId($value)
 * @mixin \Eloquent
 * @property mixed|null $tagline
 * @property mixed|null $googleMaps_embed
 * @property array|null $transfer_method
 * @property array|null $payment_method
 * @property array|null $payment_settings
 * @property array|null $about_us
 * @property array|null $socials
 * @property array|null $faqs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointments[] $appointment
 * @property-read int|null $appointment_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products[] $product
 * @property-read int|null $product_count
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereAboutUs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereFaqs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereGoogleMapsEmbed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop wherePaymentSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereSocials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Shop whereTransferMethod($value)
 */
class Shop extends Model
{
	use HasFactory, Notifiable;

	public const WEEK_MONDAY = 0;
	public const WEEK_TUESDAY = 1;
	public const WEEK_WEDNESDAY = 2;
	public const WEEK_THURSDAY = 3;
	public const WEEK_FRIDAY = 4;
	public const WEEK_SATURDAY = 5;
	public const WEEK_SUNDAY = 6;


	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function appointment()
	{
		return $this->hasMany(Appointments::class);
	}
	public function product()
	{
		return $this->hasMany(Products::class);
	}

	// protected $with = ['product'];

	protected $guarded = [];

	protected $hidden = [
		'id',
		'user_id',
		// 'two_factor_secret',
		// 'is_2fa_enabled',
	];

	protected $casts = [
		'transfer_method' => 'array',
		'payment_method' => 'array',

		'name' => 'encrypted',
		'description' => 'encrypted',
		'tagline' => 'encrypted',
		'googleMaps' => 'encrypted',
		'googleMaps_embed' => 'encrypted',

		'address' => 'encrypted:array',
		'appointment_settings' => 'encrypted:array',
		'shop_settings' => 'encrypted:array',
		'services' => 'encrypted:array',
		'contacts' => 'encrypted:array',
		'payment_settings' => 'encrypted:array',
		'about_us' => 'encrypted:array',
		'socials' => 'encrypted:array',
		'faqs' => 'encrypted:array',
		// 'is_2fa_enabled' => 'boolean',
		// 'is_business' => 'boolean',
	];
}
