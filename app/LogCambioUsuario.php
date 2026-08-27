<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogCambioUsuario extends Model
{
    protected $table = 'logs_cambios_usuarios';
    protected $fillable = [
        'admin_id',
        'user_id',
        'campo',
        'valor_anterior',
        'valor_nuevo',
        'ip',
        'fecha',
    ];
    public $timestamps = false;

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
