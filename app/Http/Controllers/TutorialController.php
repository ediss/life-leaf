<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function singleTutorial($tutorial_id) {

        $tutorial = new Course();
        $comments = new Comment();  

        return view('courses.tutorial.tutorial',[
            'comments' => $comments->getTutorialComments($tutorial_id),
            'tutorial' => $tutorial->find($tutorial_id)
        ]);
    }
}
