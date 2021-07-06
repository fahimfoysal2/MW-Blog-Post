<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $posts = Post::with('user')->get();

        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $post_data = $request->validate([
            'title'   => 'required',
            'details' => 'required',
        ]);

        $post_data['user_id'] = $request->user()->id;
        $post                 = Post::create($post_data);

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param $postId
     * @return JsonResponse
     */
    public function show($postId)
    {
        // TODO: get comments with posts too
        $post = Post::with('user')->where('id', '=', $postId)->get();
        return (count($post))
            ? response()->json(["post" => $post])
            : response()->json(["error" => "Post Not Found"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $postId
     * @return JsonResponse
     */
    public function update(Request $request, $postId)
    {
        $post = Post::find($postId);

        if (!$post) return response()->json(["error" => "Post Not Found"]);

        if ($request->user()->id != $post->user->id) {
            return response()->json(["error" => "Not Authorized to Update this post"]);
        }

        $post->title   = $request->title;
        $post->details = $request->details;
        $post->save();

        return response()->json(["Post Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post_id
     * @return JsonResponse
     */
    public function destroy(Request $request, $postId)
    {
        $post = Post::find($postId);

        if (!$post) return response()->json(["error" => "Post Not Found"]);

        if ($request->user()->id != $post->user->id) {
            return response()->json(["error" => "Not Authorized to Update this post"]);
        }

        $post->delete();

        return response()->json(["Post Deleted"]);
    }
}
