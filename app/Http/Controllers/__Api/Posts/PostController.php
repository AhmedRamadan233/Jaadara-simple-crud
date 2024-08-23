<?php

namespace App\Http\Controllers\__Api\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\__Admin\Posts\CreatePostRequest;
use App\Http\Requests\__Admin\Posts\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(10);

        return PostResource::collection($posts);
    }

    public function getByID($id)
    {
        $post = Post::with('user')->findOrFail($id);
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
            $validatedData['image'] = $this->uploadFile($request->file('image'), null, $directory);
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
        $user = Auth::user();
        $post = Post::findOrFail($id);
    
        if ($post->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $directory = 'posts/images/';
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->uploadFile($request->file('image'), $post->image, $directory);
        } else {
            $validatedData['image'] = $post->image;
        }
    
        $post->update($validatedData);
    
        return new PostResource($post);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $post = Post::findOrFail($id);
        if ($post->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $post->delete();
        $imagePath = $post->image;
        $this->deleteFile($imagePath);
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }



    protected function uploadFile(UploadedFile $file, $oldFilename = null, $directory): string
    {
        $directoryPath = public_path($directory);

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($directoryPath, $filename);
        if ($oldFilename) {
            $oldFilePath = public_path($oldFilename);
            if (file_exists($oldFilePath)) {
                @unlink($oldFilePath);
            }
        }
        return $directory . $filename;
    }
    protected function deleteFile($filepath): bool
    {
        $fullPath = public_path($filepath);
        if (file_exists($fullPath)) {
            return @unlink($fullPath);
        }
        return false;
    }
}
