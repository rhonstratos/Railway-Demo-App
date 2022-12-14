<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChMessage
 *
 * @property int $id
 * @property string $type
 * @property int $from_id
 * @property int $to_id
 * @property string|null $body
 * @property string|null $attachment
 * @property int $seen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChMessage extends Model
{
    //
}
