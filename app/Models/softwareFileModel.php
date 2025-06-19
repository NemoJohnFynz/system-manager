<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class softwareFileModel extends Model
{
    protected $table = 'software_file';
    protected $fillable = [
        'software_id',
        'username',
        'file_name',
        'file_path',
        'description',
    ];
    public function software()
    {
        return $this->belongsTo('App\Models\softwareModel', 'software_id', 'id');
    }
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
