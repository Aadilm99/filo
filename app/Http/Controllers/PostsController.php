<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Requests;
use Auth;


class PostsController extends Controller
{
    public function post(){
        $categories = Category::all();
        return view('posts.post', ['categories' => $categories]);
    }

    public function addPost(Request $request){
        $this->validate($request, [
            'post_title' => 'required',
            'post_description' => 'required',
            'post_image' => 'image|nullable|max:1999',
            'category_id' => 'required',
            'colour' => 'nullable|max:15',
            'found_location' => 'nullable|max:35'
        ]);

        if($request->hasFile('post_image')){

			$file = $request->file('post_image');
			$extension = $file->getClientOriginalExtension();
    		$file->move(public_path(). '/posts', $file->getClientOriginalName());
    		$url = URL::to("/").'/posts'. '/' . $file->getClientOriginalName();
        }
        else{
            $url = 'noimage.jpg';
        }

         /*
        * Create new post
        */
        $posts = new Post;
        $posts->post_title = $request->input('post_title');
        $posts->user_id = Auth::user()->id;
        $posts->post_description =$request->input('post_description');
        $posts->category_id = $request->input('category_id');
        $posts->post_image = $url;
        $posts->colour = $request->input('colour');
        $posts->found_location = $request->input('found_location');
        $posts->save();

    	return redirect('/home')->with('success','Post Created Successfully');
    }

    public function viewPost($id){
        $posts = Post::where('id', '=', $id)->get();
        #$categories = Category::all();
        return view('posts.view')->with('posts', $posts);
    }

    public function edit($id){
        $categories = Category::all();
        $posts = Post::find($id);
        $category = Category::find($posts->category_id);
        return view('posts.edit')->with('posts', $posts)->with('categories', $categories)->with('category', $category);
    }

    public function editPost(Request $request, $id){

        $this->validate($request, [
            'post_title' => 'required',
            'post_description' => 'required',
            'post_image' => 'image|nullable|max:1999',
            'category_id' => 'required',
            'colour' => 'nullable|max:15',
            'found_location' => 'nullable|max:35'

        ]);
        if($request->hasFile('post_image')){

            $file = $request->file('post_image');
            $extension = $file->getClientOriginalExtension();
            $file->move(public_path(). '/posts', $file->getClientOriginalName());
            $url = URL::to("/").'/posts'. '/' . $file->getClientOriginalName();
        }
        else{
            $url = 'noimage.jpg';
        }

            /*
            * Edit post
            */
            $epost = Post::find($id);
            $epost->post_title = $request->input('post_title');
            $epost->post_description =$request->input('post_description');
            $epost->category_id = $request->input('category_id');
            $epost->colour = $request->input('colour');
            $epost->found_location = $request->input('found_location');
            if($request->hasFile('post_image')){
            $epost->post_image = $url;
            }
            $epost->save();



        /*
        * Edit post
        */
        /* $posts = new Post;
        $posts->post_title = $request->input('post_title');
        $posts->user_id = Auth::user()->id;
        $posts->post_description =$request->input('post_description');
        $posts->category_id = $request->input('category_id');

        if($request->hasFile('post_image')){

			$file = $request->file('post_image');
			$extension = $file->getClientOriginalExtension();
    		$file->move(public_path(). '/posts', $file->getClientOriginalName());
    		$url = URL::to("/").'/posts'. '/' . $file->getClientOriginalName();
        }
        else{
            $url = 'noimage.jpg';
        }

        $posts->post_image = $url;

        $data = array(
            'post_title' => $posts->post_title,
            'user_id' => $posts->user_id,
            'post_description' => $posts->post_description,
            'category_id' => $posts->category_id,
            'post_image' => $posts->post_image
        );
        Post::where('id', $id)->update($data);

        $posts->update(); */
    	return redirect('/home')->with('success','Post Updated Successfully');
    }

    public function deletePost($id){

        Post::where('id', '=', $id)->delete();
        return redirect('/home')->with('success', 'Post Deleted Successfully');
    }

    public function category($id){
        $categories = Category::all();


        /* $posts = DB::table('posts')
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->select('posts.*', 'categories.*')
                ->where(['categories.id' => $id])
                ->get(); */


        #$posts = DB::table('posts')
        #->latest()
        #->get();
        $posts = Post::all();

        $posts = $posts->filter(function ($value, $key) use ($id) {
            return $value->category_id == $id;
        });


        /* $user_id = Auth::user()->id;
        $user = Category::find($user_id); */


        return view('categories.filterCategory')->with('categories', $categories)->with('posts', $posts)/* ->with('category', $user->category) */;
    }

}
