<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialNetwork
 * @package App\Models
 * @property integer $id
 */
class SocialNetwork extends Model
{
    use HasFactory;

    protected $table = 'social_networks';

    protected $fillable = ['name'];
}
