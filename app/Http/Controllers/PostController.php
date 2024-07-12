<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string',
                'body' => 'required|string'
            ]);

            $post = Post::create($request->all());

            return response()->json([
                'message' => 'Post created successfully',
                'data' => $post
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
                "title" => 'required|string',
                "body" => 'required|string'
            ]);

            $post = Post::where('id', $id)->first();
            if(!$post) {
                return response()->json([
                    'message' => 'Post not found'
                ], 404);
            }

            $updatedPost = $post->update($request->all());

            return response()->json([
                'message' => 'Post successfully updated',
                'data' => $updatedPost
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete($id) {
        try {
            $post = Post::where('id', $id)->first();
            if(!$post) {
                return response()->json([
                    'message' => 'Post not found'
                ], 404);
            }

            $post->delete();

            return response()->json([
                'message' => 'Post deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
