<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\User;
use App\Post;
use Auth;

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
        $id = Auth::user()->id;

        /* $profile = DB::table('users')
                ->join('profiles', 'users.id', '=', 'profiles.user_id')
                ->select('users.*', 'profiles.*')
                ->where(['profiles.user_id' => $id])
                ->first();
 */
        $posts = Post::all();
        $posts = $posts->filter(function ($value, $key) use ($id) {
            return $value->user_id == $id;
        });




         return view('home'/* , ['profile' => $profile, Auth::user()] */)->with('posts', $posts);
    }
}
