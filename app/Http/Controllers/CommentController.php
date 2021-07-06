<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json("NO Operation");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $commentData = $request->validate([
            'post_id' => 'required',
            'comment' => 'required',
        ]);

        $commentData['user_id'] = $request->user()->id;

        $comment = Comment::create($commentData);

        return response()->json(["message" => "Comment Created", "comment" => $comment]);
    }

    /**
     * Display Comments for Specific Post.
     *
     * @param $postId
     * @return JsonResponse
     */
    public function show($postId)
    {
        // get all comment for a post ,
        // TODO: may be add a pagination

        $comments = Comment::with('user')->where('post_id', $postId)->get();
        return response()->json($comments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $commentId
     * @return JsonResponse
     */
    public function update(Request $request, $commentId)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment = Comment::find($commentId);

        if (!$comment) return response()->json(["error" => "Comment Not Found"]);

        if ($request->user()->id != $comment->user->id) {
            return response()->json(["error" => "Not Authorized to Update this Comment"]);
        }

        $comment->comment = $request->comment;
        $comment->save();

        return response()->json(["Comment Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $commentId
     * @return JsonResponse
     */
    public function destroy(Request $request, $commentId)
    {
        $comment = Comment::find($commentId);

        if (!$comment) return response()->json(["error" => "Comment Not Found"]);

        $postOwnerId = $comment->post->user_id;

        if ($request->user()->id == $comment->user->id || $request->user()->id == $postOwnerId) {
            $comment->delete();
            return response()->json(["Comment Deleted"]);
        } else {
            return response()->json(["error" => "Not Authorized to Delete this Comment"]);
        }
    }
}
