<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class softwareModel extends Model
{
    protected $table = 'software';
    protected $fillable = [
        'softwareName',
        'language',
        'version',
        'user_createby',
        'createdAt',
        'updatedAt',
        'is_delete',
        'description',
    ];
    protected function casts(): array
    {
        return [
            'createdAt' => 'datetime',
            'updatedAt' => 'datetime',
            'is_delete' => 'boolean',
            'assigned_at' => 'datetime',
        ];
    }
}
