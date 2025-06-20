<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hardwarePemisssionModel extends Model
{
    protected $table = 'hardware_permission';
    protected $fillable = [
        'hardware_ip',
        'user_name',
        'permissions_name',
        'user_createdby',
        'assigned_at',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_name', 'username');
    }
    public function permissions()
    {
        return $this->belongsTo('App\Models\permissionModel', 'permissions_name', 'permissions_name');
    }
    public function userCreatedby()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_createdby', 'username');
    }
    protected function casts(): array
    {
        return [
            'assigned_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
