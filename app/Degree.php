<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function office(){
        return $this->belongsTo(office::class);
    }
}
