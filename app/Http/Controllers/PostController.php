<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Categorie;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('categorie','users')->latest()->paginate(5);
        return view('post.index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('post.create', compact('categories')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $imageUrl = $request->image->store('posts'); //stoker toutes les images dans notre dossier posts
        $post = Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'image'=>$imageUrl,
        ]);

        return redirect('dashboard')->withSuccess('votre post a ete cree');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', ['posts'=>$post]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Categorie::all(); 
        return view('post.update', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $arrayUpdate = [
            'title'=>$request->title,
            'content'=>$request->content,
        ];

        if($request->image !== null){
            $imagename = $request->image->store('posts');

            $arrayUpdate = array_merge($arrayUpdate, [
                'image'=>$imagename,
            ]);
        }
        
        $post->update($arrayUpdate); 

        return redirect('dashboard')->withSuccess('votre post a ete modifie');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (Gate::denies('delete-post', $post)) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Votre post a été supprimé');
    }
}
