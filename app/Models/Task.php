<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
//biz yarattık bunları
    protected $fillable = [
        'name',
        'project_id',
        'user_id',
        'company_id',
        'days',
        'hours'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function project(){
        return $this->belongsTo('App\Models\Project');
    }

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable'); //comment modelindeki fonksiyon ile
    }
}
