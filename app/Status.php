<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'user_id', 'parent_id', 'body', 'image', 'video_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Status::class, 'parent_id');
    }

    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }
}
