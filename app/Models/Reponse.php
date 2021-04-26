<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'module_id', 'exam_id', 'file'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function exam()
    {
      return $this->belongsTo(Exam::class);
    }
}
