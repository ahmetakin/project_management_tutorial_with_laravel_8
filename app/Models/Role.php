<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
//biz yarattık bunları
    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->hasMany('App\Models\User');//her rolün birden fazla kullanıcısı var
    }

}
