<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $dates = ['created_at', 'updated_at'];


    public function admins() {
        return $this->belongsTo('App\Admin');
    }
}
