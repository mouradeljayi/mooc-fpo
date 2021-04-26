<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'file', 'module_id'];

    public function module()
    {
      return $this->belongsTo(Module::class);
    }
}
