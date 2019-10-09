<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = ['name', 'address', 'phone', 'skype_name', 'date_of_birth', 'session_type', 'session_type_additional', 'diagnosis', 'therapy' ];

    public function sessions() {
        return $this->hasMany('App\Models\Session', 'patient_id');
    }

 

    public function addPatient() {

    }
}
