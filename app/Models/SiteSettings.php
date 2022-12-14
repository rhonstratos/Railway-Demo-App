<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SiteSettings
 *
 * @property int $id
 * @property mixed|null $site_color_theme
 * @property array|null $placeholders
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $gallery
 * @property string|null $site_icon
 * @property array|null $site_assets
 * @property mixed|null $site_color_hex
 * @property string|null $site_name
 * @method static \Database\Factories\SiteSettingsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings whereGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings wherePlaceholders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings whereSiteAssets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings whereSiteColorHex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings whereSiteColorTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings whereSiteIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings whereSiteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSettings whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SiteSettings extends Model
{
	use HasFactory;
	protected $table = 'site_settings';
	protected $guarded = [];
	protected $hidden = [];
	protected $casts = [
		'site_color_theme' => 'encrypted',
		'site_color_hex' => 'encrypted',
		'site_assets' => 'encrypted:array',
		'placeholders' => 'encrypted:array',
		'gallery' => 'encrypted:array',
	];
}
