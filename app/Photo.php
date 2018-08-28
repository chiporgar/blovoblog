<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    //


    //desactivar asignacion Masiva porque estamso siendo especificos con los campos

    protected $guarded=[];



    protected static function boot()
    {
    	//  Esta funcion es para que se elimine automaticamente nuestro sistema
    	//osea sea más rápido

    	parent::boot();

    	// Cada vez que se  elimine una foto vaya al disco public y en la carpeta dentro de Post. Elimine la foto
    	static::deleting(function($photo){

    		Storage::disk('public')->delete($photo->url);

    	});//cuando estemos eliminando una imagen

    }


}
