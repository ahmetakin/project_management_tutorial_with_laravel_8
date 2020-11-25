<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;
//biz yarattık bunları
    protected $fillable = [
        'project_id',
        'user_id'
    ];
}
