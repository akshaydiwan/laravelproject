<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function getNameAttribute($val){
        return strtolower($val);
    }

    public function setNameAttribute($val){
        $this->attributes['name'] = strtolower($val);
    }

}
