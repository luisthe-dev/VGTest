<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Traits\Responses;
use Illuminate\Http\Request;

class InteractionController extends Controller
{

    use Responses;

    public function updateLikeInteraction(Post $post, User $user)
    {

        $like = Like::where([
            "post_id" => $post->id,
            "user_id" => $user->id,
        ])->first();

        $like ? $like->delete() : Like::create([
            "post_id" => $post->id,
            "user_id" => $user->id,
        ]);

        return $this->sendSuccess("Like Updated Successfully");
    }

    public function updateCommentInteraction(Post $post, User $user, Request $request)
    {

        $request->validate([
            "action" => "required|string|in:create,delete",
            "comment" => "required_if:action,create"
        ]);

        $comment = Comment::where([
            "post_id" => $post->id,
            "user_id" => $user->id,
        ])->first();

        if ($request->action == "create") {
            $comment ? $comment->update(['comment' => $request->comment]) : Comment::create([
                "post_id" => $post->id,
                "user_id" => $user->id,
                "comment" => $request->comment
            ]);
        }

        if ($request->action == "delete") {
            $comment->delete();
        }

        return $this->sendSuccess("Comment Updated Successfully");
    }

}
