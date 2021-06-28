<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'posts';

    protected $dates = ['post_date'];

    protected $casts = [
        'post_date' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = ['account_id', 'content', 'post_date'];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
