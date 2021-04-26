<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professor_id', 'title', 'slug', 'content'];

    public function getRouteKeyName()
    {
      return 'slug';
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function professor()
    {
    	return $this->belongsTo(Professor::class);
    }

    public function replies()
    {
    	return $this->hasMany(Reply::class);
    }
}
