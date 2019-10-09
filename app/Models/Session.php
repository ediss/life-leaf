<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $timestamps = false;
    protected $fillable = ['patient_id', 'session_resime', 'session_paid', 'session_date'];
    protected $dates = ['created_at', 'updated_at', 'session_date'];
    

    public function patient() {
        return $this->belongsTo('App\Models\Patient');
    }
}
