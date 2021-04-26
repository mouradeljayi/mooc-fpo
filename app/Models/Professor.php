<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Professor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'professor';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    public function modules()
    {
      return $this->hasMany(Module::class);
    }

    public function discussions()
    {
      return $this->hasMany(Discussion::class);
    }
}
