<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogIngreso extends Model
{
    protected $table = 'logs_ingresos';
    protected $fillable = ['user_id', 'ip', 'fecha'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
