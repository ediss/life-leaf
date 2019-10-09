<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function getCourses($date) {
        return Course::where('expiration_date', '>', $date)->get();
    }
}
