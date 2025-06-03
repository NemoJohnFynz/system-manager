<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role_permissionModel extends Model
{
    protected $fillable = [
        'role_name',
        'permission_name',
        'assigned_at',
        'created_at',
        'updated_at'

    ];

    protected function casts(): array
    {
        return [
            'assigned_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    
}
