<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
class Post extends Model
{
    //

    protected $fillable=[
        'title', 'body', 'category_id', 'excerpt', 'published_at', 'iframe',
    ];

     protected $dates= ['published_at'];



    protected static function boot()
    {
        //  Esta funcion es para que se elimine automaticamente nuestro sistema
        //osea sea más rápido

        parent::boot();

        // Cada vez que se  elimine una foto vaya al disco public y en la carpeta dentro de Post. Elimine la foto
        
        static::deleting(function($post){

             $post->tags()->detach();//quita todas etiquetas asignadas a este post.


            $post->photos->each->delete(); /// en el modelo photos preparamos para elimiminar una foto, de hecho lo que hace esto es por cada fotos que pasemos se va eliminando una foto, una por una. 

        });//cuando estemos eliminando una imagen

    }




     public function getRouteKeyName()
     {

        return 'url';

     }


     public function category()
     {
     	// $post->category->name

     	return $this->belongsTo(Category::class);

     }

     public function tags()
     {
     		//un post Pertenece a muchas etiquetas
     	return $this->belongsToMany(Tag::class);

     }



     ///se ocupa en el controlador.
    public function scopePublished($query)
     {    
           $query   ->whereNotNull('published_at')
                     ->where('published_at','<=',Carbon::now())
                     ->latest('published_at');

            
     }

   //Relaciones de posts  afotos

     public function photos()
     {
            //es decir un post  podrá tender varias fotos
        return $this->hasMany(Photo::class);
     }




    public function setTitleAttribute($title)
    {

        /*
            lo que hce es que remplaza cualquier espacio o signo no permitido
            Entonces guarda el nombre bien, pero automaticamente genera una Url
        */

        $this->attributes['title']  = $title;
        $this->attributes['url']   = str_slug($title);

    }

    // mutador
    public function setPublishedAtAttribute($published_at)
    {


        if(is_null($published_at)){

             $this->attributes['published_at'] = null;
        }else{

           $this->attributes['published_at']  = Carbon::parse($published_at);
        }


    }

    // mutador
    public function setCategoryIdAttribute($category)
    {

        
       $this->attributes['category_id']=Category::find($category)
                              ? $category
                              : Category::create(['name' => $category ])->id;

    }

    // vamos agregar relacion a la tabal pivot.

    public function synTags($tags)
    {

          // se van  a convertir las etiquetas en una coleccion



        $tagsIds = collect($tags)->map(function($tag){

            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });



        /*
      
        seccion de Etiquetas
        sync es para sincronizar la relacion de etiquetas y Post
        es mejor uitilizar Sync. 

        Hay otro que se llama  Attach pero  es mejor  utilizar Sync Segun(Rimorsoft- Ingeniero de bastante Experiencia)
            
            º Este Ejemplo es para guardar todo un array de Opciones dentro de las etiquetas de un post

            ------------------------- LEER --------------------------

            º cuando se envie desde la vista estos datos en la seccion dónde dice name, se debe de poner  " Ejemplo[] " los corchetes, para indicar que es un Arrray.
            
            º En Dónde Dice $post->tags()->sync($request->get('tags'))
              Se esta guardando de un "Jalon" Por así decirlo un array en la BD
            */
        


          return $this->tags()->sync($tagsIds);
    }








}









