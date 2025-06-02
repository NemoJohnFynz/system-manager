<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class logModel extends Model
{
    protected $table = 'log';
    protected $fillable = [
        'username',
        'software_id',
        'hardware_ip',
        'rule_id',
        'message',
        'software_file_id',
        'is_delete',
    ];
    public function software()
    {
        return $this->belongsTo('App\Models\softwareModel', 'software_id', 'id');
    }
    public function hardware()
    {
        return $this->belongsTo('App\Models\hardwareModel', 'hardware_ip', 'ip');
    }
    public function rule()
    {
        return $this->belongsTo('App\Models\rulesModel', 'rule_id', 'id');
    }
    public function softwareFile()
    {
        return $this->belongsTo('App\Models\softwareFileModel', 'software_file_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'username', 'username');
    }
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'is_delete' => 'boolean',
            'assigned_at' => 'datetime',
        ];
    }
}
