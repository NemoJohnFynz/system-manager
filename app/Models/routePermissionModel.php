<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class routePermissionModel extends Model
{
    protected $table = "route_permission";
    protected $fillable = [
        'route_name',
        'permissions_name'
    ];
    public function permission()
    {
        return $this->belongsTo('App\Models\permissionModel', 'permissions_name', 'permissions_name');
    }
}
