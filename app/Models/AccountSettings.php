<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountSettings
 *
 * @property int $id
 * @property int $user_id
 * @property mixed|null $profile_img
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountSettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountSettings whereProfileImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountSettings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountSettings whereUserId($value)
 * @mixin \Eloquent
 * @property mixed|null $google_2fa_key_temp
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|AccountSettings whereGoogle2faKeyTemp($value)
 */
class AccountSettings extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'profile_img',
        'google_2fa_key_temp',
    ];

    protected $hidden = [
        'user_id',
    ];

    protected $casts = [
        'profile_img' => 'encrypted',
        'google_2fa_key_temp' => 'encrypted',
    ];
}
