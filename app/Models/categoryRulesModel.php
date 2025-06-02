<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categoryRulesModel extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
