<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'user_id', 'parent_id', 'body', 'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
