<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registration',
        'name', 
        'birthDate',
        'phone',
        'celPhone',
        'permission_id',
        'occupation_id',
        'department_id',
        'email', 
        'password',
        'username',
        'registration',
        'status'
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

    public function department(){
        return $this->belongsTo(Department::class);
    }

     public function occupation(){
        return $this->belongsTo(Occupation::class);
    }

    public function getFormatedStatusAttribute()
    {
        $status = $this->attributes['status'];

        switch ($status) {
            case "1":
                $status = "Ativo";
                break;

            case "2":
                $status = "Inativo";
                break;
        }
        return $status;
    }
}

