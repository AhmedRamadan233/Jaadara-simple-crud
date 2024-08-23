<?php

namespace App\Http\Controllers\__Blade\Posts;

use App\Helpers\HandelFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\__Admin\Posts\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
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
            'user_id' => 4,
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'image' => $validatedData['image'],
        ]);

        return response()->json(['success' => true]);
    }
}
