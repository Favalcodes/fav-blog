<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'post_id' => 'required|exists:post,id',
                'comment' => 'required|string'
            ]);

            $comment = Comment::create($request->all());

            return response()->json([
                'message' => 'Comment created successfully',
                'data' => $comment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'post_id' => 'required|exists:post,id',
                'comment' => 'required|string'
            ]);

            $comment = Comment::where('id', $id)->first();
            if (!$comment) {
                return response()->json([
                    'message' => 'Comment not found'
                ], 404);
            }

            $updatedComment = $comment->update($request->all());

            return response()->json([
                'message' => 'Comment successfully updated',
                'data' => $updatedComment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $comment = Comment::where('id', $id)->first();
            if (!$comment) {
                return response()->json([
                    'message' => 'Comment not found'
                ], 404);
            }

            $comment->delete();

            return response()->json([
                'message' => 'Comment deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getCommentsByPost($postId)
    {
        try {
            $post = Post::where('id', $postId)->first();
            if (!$post) {
                return response()->json([
                    'message' => 'Post not found'
                ], 404);
            }
            $comments = Comment::where('post_id', $postId)->get();

            return response()->json([
                'message' => 'Comments retrieved successfully',
                'data' => $comments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
