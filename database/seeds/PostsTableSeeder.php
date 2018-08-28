<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use Carbon\Carbon;
Use App\Tag;
use App\Category;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //para borrar Fotos

        Storage::disk('public')->deleteDirectory('posts');

        //Crear Posts

        $valor =0;

    	Post::truncate(); //para limpiar la tabla la deje en blanco.

    	Category::truncate();

        Tag::truncate();

            //no es la recomendable pero bueno . .

        $cat = array ("Paletas Jxe","Ducles Mexican","Servicios","Caramelos","kars","Nieves","Estrategia","Noticias");



        for ($Valor =0 ; $valor<5;$valor++){

            $category = new Category;
   
            $category->name =$cat[$valor];

            $category->save();

        }


        for ($valor =0 ; $valor <10;$valor ++){

         

            $post = new Post;

            $post->title =" Mi ".$valor."Valor";

            $post->url =str_slug($post->title);

            $post->excerpt = " Extracto de mi ".$valor." post";

            $post->body =" <p> Contenido de mi  ".$valor." post </p>";

            $post->published_at = Carbon::now()->subDays(rand(1,15)); 

            $post->category_id = rand(1,5);

            $post->save();

            

            unset($category);
            unset($post);///destrye variable
        }





    }
}
