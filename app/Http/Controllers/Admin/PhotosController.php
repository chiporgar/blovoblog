<?php

namespace App\Http\Controllers\Admin;

use  App\Post;
use  App\Photo;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage; //no olvidar importarlo
class PhotosController extends Controller
{
    //

    public function store(Post $post)
    {	
    	//validación

    	$this->validate(request(),[
    		'photo' => 'required|image|max:3048' //debe de ser una imagen y tambien el tamaño en Kbs
    	]);



        $post->photos()->create([
            'url'    =>request()->file('photo')->store('posts','public'),

        ]);


    	/*
    	  ya hemos recibido la imagen, Gracias  A Dropzone
    	   laravel la convierte en un instancia 

    	*/
           // Se quito este 
    	// Photo::create([

    	// 	'url' 		=>request()->file('photo')->store('posts','public'),
    	// 	'post_id' 	=> $post->id

    	// ]);

    }


    public function destroy(Photo $photo)

    {	

        //en photo Delete-> en el modelo photo se agregaron más cosas.
    	$photo->delete();
          // Aqui se borro el registro de la BD

    	// para  Eliminar un archivo de la BD es así.

    	/*
			 Aqui estamos Remplzando el Storage por el public, Para que Laravel pueda encontrar  la foto a eliminar en la carpeta correspondiente
    	*/

             // se rempleazo
    	// $photoPath  = str_replace('storage','public',$photo->url);





    	return back()->with('flash','Foto eliminada');

    }


}











