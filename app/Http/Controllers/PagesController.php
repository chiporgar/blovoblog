<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class PagesController extends Controller
{
    //


    public function home(){

    	 //published es un scopePublishe que esta en  el Modelo POST	
	  	$posts = Post::published()->paginate(3);



        return view('welcome',compact('posts'));
    }
}
