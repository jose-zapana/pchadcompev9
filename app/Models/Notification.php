<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'message', 'role'];

    // TODO: Relaciones
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
