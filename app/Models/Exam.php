<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'file', 'delivery_date', 'module_id'];

    public function module()
    {
      return $this->belongsTo(Module::class);
    }

    public function reponses()
    {
      return $this->hasMany(Reponse::class);
    }
}
