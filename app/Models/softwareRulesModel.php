<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class softwareRulesModel extends Model
{
    protected $table = 'software_rules';
    protected $fillable = [
        'software_id',
        'user_name',
        'assigned_at',
    ];
    public function software()
    {
        return $this->belongsTo('App\Models\softwareModel', 'software_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_name', 'username');
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
