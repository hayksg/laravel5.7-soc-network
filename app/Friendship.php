<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    protected $fillable = [
        'requester', 'user_requested', 'status'
    ];

    public function friends()
	{
		return $this->belongsToMany(User::class, 'friendships', 'requester', 'user_requested');
    }
}
