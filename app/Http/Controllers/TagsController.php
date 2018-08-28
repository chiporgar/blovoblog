<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    //
		// Pasarle el objeto de la etiqueta, es que hace automaticamente la busqueda.
    public function show(Tag $tag) 
    {

    	return view('welcome',[

    		'title' 	=> "Publicaciones de la Etiqueta {$tag->name}",
    		'posts'		=>	$tag->posts()->paginate(3)

    	]);

    }
}
