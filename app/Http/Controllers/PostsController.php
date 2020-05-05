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

/* The posts controller consists of the main functions that are passed for a CRUD application */
class PostsController extends Controller
{
    //Function post will relatively return the view for the create post form
    public function post(){
        //The model categories is used here as for being able to retrieve all the types of categories in the select dropdown
        $categories = Category::all();
        return view('posts.post', ['categories' => $categories]);
    }

    /* Function addPost which is used to relatively enable a user to enter details in the form, in which the request stores the input into the Database */
    public function addPost(Request $request){
        // it will check for fields that are required/specified to validate when submitting the form
        $this->validate($request, [
            'post_title' => 'required',
            'post_description' => 'required',
            'post_image' => 'image|nullable|max:1999',
            'category_id' => 'required',
            'colour' => 'nullable|max:15',
            'found_location' => 'nullable|max:35'
        ]);
        // This if statement is used to check if there is a post image
        if($request->hasFile('post_image')){
            //it will read the file that is uploaded
			$file = $request->file('post_image');
            $extension = $file->getClientOriginalExtension();
            //This is a path specified for where the images will essentially be stored
    		$file->move(public_path(). '/posts', $file->getClientOriginalName());
    		$url = URL::to("/").'/posts'. '/' . $file->getClientOriginalName();
        }
        else{
            //If image not uploaded it will return no image
            $url = 'noimage.jpg';
        }

         /*
        * Create new post
        */
        $posts = new Post;
        //Request the input for post title
        $posts->post_title = $request->input('post_title');
        //gets the correct user id
        $posts->user_id = Auth::user()->id;
        //Request the input for post description
        $posts->post_description =$request->input('post_description');
        //Request the input for category_id so this is where it gets the id of the enum item type
        $posts->category_id = $request->input('category_id');
        //store the url/image in post_image
        $posts->post_image = $url;
        //Request the input for colour
        $posts->colour = $request->input('colour');
        //Request the input for post found location
        $posts->found_location = $request->input('found_location');
        //saves the post
        $posts->save();
        //Redirects user back to home with success message
    	return redirect('/home')->with('success','Post Created Successfully');
    }
    /* ViewPost function where it gets the ID of the post that will be viewed in detail */
    public function viewPost($id){
        $posts = Post::where('id', '=', $id)->get();
        return view('posts.view')->with('posts', $posts);
    }
    /* edit function where it gets the ID of the post that will be selected to edit in detail */
    public function edit($id){
        $categories = Category::all();
        $posts = Post::find($id);
        $category = Category::find($posts->category_id);
        return view('posts.edit')->with('posts', $posts)->with('categories', $categories)->with('category', $category);
    }

    /* Function editPost is used to relatively enable a user to edit the details in the form, in which the request stores the input into the Database */
    public function editPost(Request $request, $id){
        // it will check for fields that are required/specified to validate when submitting the form
        $this->validate($request, [
            'post_title' => 'required',
            'post_description' => 'required',
            'post_image' => 'image|nullable|max:1999',
            'category_id' => 'required',
            'colour' => 'nullable|max:15',
            'found_location' => 'nullable|max:35'

        ]);
        // This if statement is used to check if there is a post image
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
            * Edit a post through accessing the correct id of the post and request the input details which will esssentially be stored/updated in the DB
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

    	return redirect('/home')->with('success','Post Updated Successfully');
    }
    //Function delete will find the correct id of the post and delete it/remove from the DB
    public function deletePost($id){

        Post::where('id', '=', $id)->delete();
        return redirect('/home')->with('success', 'Post Deleted Successfully');
    }
    //Function category will be used to filter posts relevant to their category_id such as; pet, phone, jewellery
    public function category($id){
        $categories = Category::all();

        $posts = Post::all();

        $posts = $posts->filter(function ($value, $key) use ($id) {
            return $value->category_id == $id;
        });

        return view('categories.filterCategory')->with('categories', $categories)->with('posts', $posts)/* ->with('category', $user->category) */;
    }

}
