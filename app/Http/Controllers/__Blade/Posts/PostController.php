<?php

namespace App\Http\Controllers\__Blade\Posts;

use App\Helpers\HandelFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\__Admin\Posts\CreatePostRequest;
use App\Http\Requests\__Admin\Posts\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(10);


        return view('website.posts.index', compact('posts'));
    }

    public function store(CreatePostRequest $request)
    {
        $validatedData = $request->validated();

        $userId = Auth::id();
        $directory = 'posts/images/';
        if ($request->hasFile('image')) {
            $validatedData['image'] = HandelFile::uploadFile($request->file('image'), null, $directory);
        }
        $post = Post::create([
            'user_id' => $userId,
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'image' => $validatedData['image'],
        ]);

        return response()->json(['success' => true]);
    }

    public function editPost($id)
    {
        $editPost = Post::findOrFail($id);
        return response()->json(['editPost' => $editPost]);
    }


    public function update(UpdatePostRequest $request)
    {
        $validatedData = $request->validated();
        $id = $request->input('id');
        $post = Post::findOrFail($id);

        $directory = 'posts/images/';

        if ($request->hasFile('image')) {
            $validatedData['image'] = HandelFile::uploadFile($request->file('image'), $post->image, $directory);
        } else {
            $validatedData['image'] = $post->image;
        }

        $post->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'image' => $validatedData['image'],
        ]);

        return response()->json(['success' => true, 'message' => 'Post updated successfully.'], 200);
    }


    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        $imagePath = $post->image;
        HandelFile::deleteFile($imagePath);
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
