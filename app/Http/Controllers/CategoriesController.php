<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
class CategoriesController extends Controller
{
    //

    public function show(Category $category)
    {

    	// pasamos el metodo ->load(pasandole la relacion ) /que queremos cargar
    	// pero no se ocupa

    	// return $category->load('posts');

    		// Sgeunda forma 
    	// $posts = $category->posts;

    	// return view('welcome',compact('posts'));

    	// La forma buena solo regresamos los posts que pertencer a esa categoria.

    	return view ('welcome',[

    		'title' 	=> "Publicaciones de la categoría {$category->name}",

    		'posts'		=>	$category->posts()->paginate(10)
    	]);


    }
}
