<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\permission;

class role_has_permission extends Model
{
    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function permission(){
        return $this->belongsTo(Permission::class);
    }
}
