<?php

namespace App\Models;

use App\Traits\ModelFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes, ModelFilterTrait;

    protected $fillable = [
        'content',
        'user_id',
        'post_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }
}
