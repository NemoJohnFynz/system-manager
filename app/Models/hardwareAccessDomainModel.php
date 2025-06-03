<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hardwareAccessDomainModel extends Model
{
    protected $table = 'hardware_access_domain';
    protected $fillable = [
        'hardware_ip',
        'domain_id',
    ];
    public function hardware()
    {
        return $this->belongsTo('App\Models\hardwareModel', 'hardware_ip', 'ip');
    }
}
