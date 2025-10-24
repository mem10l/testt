<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'name', 'status', 'created_at', 'updated_at', 'comments_id', 'user_id'
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comments_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

