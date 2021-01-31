<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRol extends Model
{
    protected $table = 'user_rols';
    protected $fillable = [
        'user_id', 'rol_id'
    ];

    public function rol() {
        return $this->belongsto(Rol::class);
    }
    public function user() {
        return $this->belongsto(User::class);
    }
}