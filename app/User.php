<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\SocialProfile;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dni','nombres','apellido_paterno','apellido_materno','img', 'email','ubigeo','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'user_rols');
    }

    public function hasRoles(array $rolesFromView)
    {
        foreach ($rolesFromView as $rv) {
            foreach ($this->roles as $rm) {
                if ($rm->nombre === $rv) {
                    return true;
                }
            }
        }
        return false;
    }
    public function postulantes() {
		return $this->hasMany(Postulante::class);
	}
    public function experiencialabusers() {
		return $this->hasMany(ExperienciaLabUser::class);
    }
    public function experiencialabpostulantes() {
		return $this->hasMany(ExperienciaLabPostulante::class);
    }
    public function capacitacionusers() {
		return $this->hasMany(CapacitacionUser::class);
    }
    public function datosusers() {
		return $this->hasMany(DatosUser::class);
    }
    public function formacionusers() {
		return $this->hasMany(FormacionUser::class);
	}

}
