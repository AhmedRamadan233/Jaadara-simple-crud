<?php

namespace App\Http\Controllers\__Api\Posts;

use App\Helpers\HandelFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\__Admin\Posts\CreatePostRequest;
use App\Http\Requests\__Admin\Posts\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\GlobalPosts;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = GlobalPosts::with('user')->paginate(10);

        return PostResource::collection($posts);
    }

    public function getByID($id)
    {
        $post = GlobalPosts::with('user')->findOrFail($id);
        return new PostResource($post);
    }
    public function viewMyPosts()
    {
        $userId = Auth::id();
        $posts = Post::where('user_id', $userId)->paginate(10);

        return PostResource::collection($posts);
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

        return new PostResource($post);
    }


    public function update(UpdatePostRequest $request, $id)
    {
        $validatedData = $request->validated();
        $post = Post::findOrFail($id);

        $directory = 'posts/images/';
        if ($request->hasFile('image')) {
            $validatedData['image'] = HandelFile::uploadFile($request->file('image'), $post->image, $directory);
        } else {
            $validatedData['image'] = $post->image;
        }

        $post->update($validatedData);

        return new PostResource($post);
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
