<?php

namespace App\Http\Controllers\__Api\States;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $postCount = Post::count();
        $usersWithNoPosts = User::doesntHave('posts')->count();

        return response()->json([
            'number_of_users' => $userCount,
            'number_of_posts' => $postCount,
            'number_of_users_with_no_posts' => $usersWithNoPosts,
        ]);
    }
}
