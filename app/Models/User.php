<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
//CipherSweet Imports
use ParagonIE\CipherSweet\BlindIndex;
use ParagonIE\CipherSweet\EncryptedRow;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $userId
 * @property string $firstname
 * @property string $lastname
 * @property mixed $contact
 * @property mixed $birthday
 * @property mixed|null $two_factor_secret
 * @property bool $is_2fa_enabled
 * @property bool $is_business
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $active_status
 * @property string $avatar
 * @property int $dark_mode
 * @property string $messenger_color
 * @property mixed|null $address
 * @property mixed|null $google2fa_secret
 * @property string|null $google2fa_ts
 * @property bool $is_banned
 * @property string|null $is_banned_reason
 * @property-read \App\Models\AccountSettings|null $accountSettings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointments[] $appointments
 * @property-read int|null $appointments_count
 * @property-read \App\Models\Carts|null $cart
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Favorites[] $favorite
 * @property-read int|null $favorite_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reviews[] $productReviews
 * @property-read int|null $product_reviews_count
 * @property-read \App\Models\Shop|null $shop
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User orWhereBlind(string $column, string $indexName, array|string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|User ordered()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActiveStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBlind(string $column, string $indexName, array|string $value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDarkMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogle2faSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogle2faTs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIs2faEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsBanned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsBannedReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsBusiness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMessengerColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserId($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements CipherSweetEncrypted, MustVerifyEmail, CanResetPassword
{
	use HasApiTokens, HasFactory, Notifiable, UsesCipherSweet;

	/**
	 * Send the email verification notification.
	 *
	 * @return void
	 */
	public function sendEmailVerificationNotification()
	{
		$this->notify(new \App\Notifications\VerifyEmailQueued);
	}
	public const IS_CUSTOMER = 0;
	public const IS_BUSINESS = 1;
	public const IS_ACCOUNT_ACTIVE = 0;
	public const IS_ACCOUNT_BANNED = 1;
	public const TWO_FA_DISABLED = 0;
	public const TWO_FA_ENABLED = 1;

	public static function configureCipherSweet(EncryptedRow $encryptedRow): void
	{
		$encryptedRow
			->addField('email')
			->addBlindIndex('email', new BlindIndex('email_index'));
	}

	public function appointments()
	{
		return $this->hasMany(Appointments::class);
	}

	public function shop()
	{
		return $this->hasOne(Shop::class);
	}

	public function cart()
	{
		return $this->hasOne(Carts::class);
	}
	public function favorite()
	{
		return $this->hasMany(Favorites::class);
	}

	public function accountSettings()
	{
		return $this->hasOne(AccountSettings::class);
	}

	public function productReviews()
	{
		return $this->hasMany(Reviews::class);
	}

	public function scopeOrdered($query)
	{
		return $query->orderByRaw('CONCAT(firstname, lastname) ASC');
	}

	protected $with = ['accountSettings'];

	protected $guarded = [];
	// protected $dates = ['birthday'];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'two_factor_secret',
		'is_2fa_enabled',
		'google2fa_secret',
		'google2fa_ts',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		// 'firstname' => 'encrypted',
		// 'lastname' => 'encrypted',
		'contact' => 'encrypted',
		'birthday' => 'encrypted',
		'two_factor_secret' => 'encrypted',
		'address' => 'encrypted',
		'google2fa_secret' => 'encrypted',
		'email_verified_at' => 'datetime',
		'is_2fa_enabled' => 'boolean',
		'is_business' => 'boolean',
		'is_banned' => 'boolean',
	];
}
