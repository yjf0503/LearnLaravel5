<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;

class PaperController extends Controller
{
    public function show($id){
    	return view('paper/show')->withPaper(Paper::with('hasManyComments')->find($id));
    }
}
