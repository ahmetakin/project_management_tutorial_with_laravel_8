<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
//biz yarattık bunları
    protected $fillable = [
        'id',
        'name',
        'description',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function projects(){
        return $this->hasMany('App\Models\Project');
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable'); //comment modelindeki fonksiyon ile
    }

}
