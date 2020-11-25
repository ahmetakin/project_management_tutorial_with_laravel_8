<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'city',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //biz yarattık bunları
   
   
    public function role(){
        return $this->belongsTo('App\Models\Role');//her kullanıcının bir rolü var
    }

    public function companies(){
        return $this->hasMany('App\Models\Company');
    }

    public function tasks(){
        return $this->belongsToMany('App\Models\Task');
    }

    public function projects(){//kullanıcı birden fazla projeye sahip olabilir
        return $this->belongsToMany('App\Models\Project');
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable'); //comment modelindeki fonksiyon ile
    }

}
