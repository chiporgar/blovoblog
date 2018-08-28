<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

	protected $guarded = [];

	// es para que cuando una Url se busque un tag así
	//  ejemplo.com/tags/1
	// en vez de hacer haga esto ejemplo.com/tags/coches
    public function getRouteKeyName()
    {

    	return 'url'; 
    }


    public function posts()
    {
    	return $this->belongsToMany(Post::class);
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
