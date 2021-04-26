<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'professor_id', 'filiere_id'];

    public function getRouteKeyName()
    {
      return 'slug';
    }

    public function filiere()
    {
      return $this->belongsTo(Filiere::class);
    }

    public function professor()
    {
      return $this->belongsTo(Professor::class);
    }

    public function chapters()
    {
      return $this->hasMany(Chapter::class);
    }

    public function works()
    {
      return $this->hasMany(Work::class);
    }

    public function exams()
    {
      return $this->hasMany(Exam::class);
    }

    public function users()
    {
      return $this->hasMany(User::class);
    }

}
