<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\User;
use App\Post;
use Auth;

/* HomeController class which is used to manage the main dashboard page where the user can view their own posts etc. */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get the users id
        $id = Auth::user()->id;

        /* $profile = DB::table('users')
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->select('users.*', 'profiles.*')
                ->where(['profiles.user_id' => $id])
                ->first(); */

        // Access post model where I am returning all the posts in Post
        $posts = Post::all();

        //This is a posts filter which relatively ensures to compare the value which acts as a key to ensure the user_id refers/matches to its own id
        $posts = $posts->filter(function ($value, $key) use ($id) {
            return $value->user_id == $id;
        });
        // Returns the view of the home page with passing in the filter '$posts' to the view
         return view('home', /* ['profile' => $profile] */)->with('posts', $posts);
    }
}
