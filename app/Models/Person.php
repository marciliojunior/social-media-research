<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class Person
 * @package App\Models
 * @property integer $id
 * @property string $name
 * @property Account[]|Collection $accounts
 * @property Post[]|Collection $posts
 * @property ListName[]|Collection $lists
 * @property SocialNetwork[]|Collection $social_networks
 */
class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['name', 'created_at', 'updated_at'];

    public function lists(): BelongsToMany
    {
        return $this->belongsToMany(ListName::class, 'lists_persons', 'person_id', 'list_id');
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    public function posts(): HasManyThrough
    {
        return $this->hasManyThrough(Post::class, Account::class, 'person_id', 'account_id');
    }

    public function social_networks(): BelongsToMany
    {
        return $this->belongsToMany(SocialNetwork::class, 'accounts', 'person_id', 'social_network_id');
    }
}
