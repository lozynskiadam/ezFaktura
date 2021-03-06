<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
      'title',
      'message',
      'date',
      'icon',
      'class',
      'is_confirmed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
