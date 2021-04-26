<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'professor_id', 'discussion_id', 'content'];

    public function discussion()
    {
      return $this->belongsTo(Discussion::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function professor()
    {
      return $this->belongsTo(Professor::class);
    }
}
