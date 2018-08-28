<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostsController extends Controller
{
    //


	public function show(Post $post)
	{

		//de esta forma nos Atrae el post segun el ID

		

		return view('posts.show',compact('post'));
	}

}
