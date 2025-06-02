<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rulesModel extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'file_url',
        'username',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function category()
    {
        return $this->belongsTo('App\Models\categoryRulesModel', 'category_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'username', 'username');
    }

}
