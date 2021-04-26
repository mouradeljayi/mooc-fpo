<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'filiere_id',
        'avatar'
    ];

    public function filiere()
    {
      return $this->belongsTo(Filiere::class);
    }

    public function reponses()
    {
      return $this->hasMany(Reponse::class);
    }

    public function discussions()
    {
      return $this->hasMany(Discussion::class);
    }
}
