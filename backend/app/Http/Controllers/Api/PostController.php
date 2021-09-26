<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Post::with(['user'])->get(['title', 'content', 'slug']));
    }


    public function create(){}

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'user_id' => 1
        ]);
        if(!$post){
            return response()->json(['type' => "error", 'message' => "Não foi possível criar o post"]);
        }
        return response()->json($post);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(!$post){
            return response()->json(['type' => 'error', 'message' => 'Não foi possível encontrar o post']);
        }
        return response()->json($post);
    }

    /**
     * @param string $slug
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function findBySlug(string $slug, int $id){
        $post = Post::where(['slug' => $slug, 'status' => 1, 'id' => $id])->first();
        if(!$post){
            return response()->json(['type' => 'error', 'message' => 'Não foi possível encontrar o post']);
        }
        return response()->json($post);
    }

    public function edit($id){}

    /**
     * @param PostRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
        ]);
        if(!$post){
            return response()->json(['type' => "error", 'message' => "Não foi possível atualizar o post"]);
        }
        return response()->json($post);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(!$post){
            return response()->json(['type' => 'error', 'message' => 'Não foi possível encontrar o post']);
        }
        $post->delete();
        return response()->json(['type' => 'success', 'message' => 'Post Removido com sucesso']);
    }
}
