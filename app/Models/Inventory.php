<?php

namespace App\Models;

use Caryley\LaravelInventory\Inventory as BaseModel;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Inventory
 *
 * @property int $id
 * @property int $quantity
 * @property string|null $description
 * @property string $inventoriable_type
 * @property int $inventoriable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $model
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereInventoriableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereInventoriableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Inventory extends BaseModel
{
    /**
     * Relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }
}
