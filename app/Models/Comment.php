<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
//biz yarattık bunları
    protected $fillable = [
        'body',
        'url',
        'user_id',
        'commentable_id',
        'commentable_type'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user(){//user modelden alıyor
        return $this->hasOne('App\Models\User','id','user_id');
    }
    
}
