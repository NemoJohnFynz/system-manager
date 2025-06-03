<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class permissionModel extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'permissions_name'; // Khóa chính của bảng permissions
    public $incrementing = false; // Vì khóa chính là string
    protected $keyType = 'string';
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
