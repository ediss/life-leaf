<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Comment extends Model
{
    use SoftDeletes;
   
    protected $dates = ['deleted_at'];
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'tutorial_id', 'parent_id', 'body'];
   
    
    //RELATIONSHIPS
    
    /**
     * The belongs to Relationship
     *
     * @var array
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
   
    /**
     * The has Many Relationship
     *
     * @var array
     */
    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    //END OF RELATIONSHIPS

    public function getTutorialComments($tutorial_id) {
       return Comment::where('tutorial_id', $tutorial_id)->get();
    }

}
