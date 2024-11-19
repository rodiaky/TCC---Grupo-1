<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeProfessorController extends Controller
{
    public function index() {
    
        return view('site.professor.homeProfessor');
    }
}
