<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected $guarded = [];




    // una categoria tiene muchos posts
	Public function posts()
	{
		return $this->hasMany(Post::class);

	}

    // Este Ejemplo, es para que cuando obtenemos  un proudcto atraves de un ID
    // en vez  de mostrarlo por numero, que muestres el String

    public function getRouteKeyName()
    {
    	return 'url';
    }


    public function setNameAttribute($name)
    {

    	/*
		 	lo que hce es que remplaza cualquier espacio o signo no permitido
		 	Entonces guarda el nombre bien, pero automaticamente genera una Url
    	*/

		$this->attributes['name']  = $name;
    	$this->attributes['url']   = str_slug($name);

    }






}











