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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
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
