<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Post;
use App\Category;
use App\Tag;
class PostsController extends Controller
{
    //

    protected $guarded = [];

    public function index()
    {	

    	$posts = Post::all();

    	return view('admin.posts.index',compact('posts'));
    }

    // public function create()
    // {
    // 	$categories = Category::all();
    // 	$tags = Tag::all();

    // 	return view('admin.posts.create',compact('categories','tags'));
    // }



    public function store (Request  $request)
    {

        $this->validate($request,['title' => 'required']);


        $post = new Post;
        $post->title         = $request->title;
        $post->save();


        //dd($post);
        return redirect()->route('admin.posts.edit',$post);

    }


    public function edit(Post $post)
    {

    
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit',compact('categories','tags','post'));

    }



    public function update(Post $post, StorePostRequest $request)
    {   
        //validación


        $post->update($request->all());


        $post->synTags($request->get('tags')); // metodo que se encuentra en el modelo Post

      
        return redirect()->route('admin.posts.edit',$post)->with('flash','La Publicación ha sido guardada');
    }
       

    public function destroy(Post $post)
    {


        $post->delete();


        return redirect()->route('admin.posts.index')->with('flash','La publicación ha sido eliminada');

    }


}











