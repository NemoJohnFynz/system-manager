<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    
        protected $fillable = [
            'user_creately',
            'permissions_name',
            'type',
    ];


    protected function casts(): array
    {
    return [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    }
}
