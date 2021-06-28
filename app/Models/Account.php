<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Account
 * @package App\Models
 * @property integer $id
 * @property integer $person_id
 * @property integer $social_network_id
 * @property string $email
 * @property Person $person
 * @property SocialNetwork $social_network
 * @property Post[]|Collection $posts
 */
class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';

    protected $fillable = ['person_id', 'social_network_id', 'email'];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function social_network(): BelongsTo
    {
        return $this->belongsTo(SocialNetwork::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
