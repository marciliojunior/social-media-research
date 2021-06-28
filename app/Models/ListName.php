<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class ListName
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property Person[]|Collection $persons
 */
class ListName extends Model
{
    use HasFactory;

    protected $table = 'lists';

    protected $fillable = ['name'];

    public function persons(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'lists_persons', 'list_id', 'person_id');
    }
}
