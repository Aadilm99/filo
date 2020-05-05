<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Profile;
use Auth;

class ProfileController extends Controller
{
    //Will return the view for the profile.
    public function profile()
    {
    	return view('profiles.profile');
    }

    //Function addProfile where the user can edit their name and about me and upload a profile pic
    public function addProfile(Request $request)
    {
    	$this->validate($request,[
    		'name'=>'required',
    		'profile_about'=>'required',
    		'profile_image'=>'image|nullable|max:1999'
        ]);

        /*
        * Create a new Profile
        */
    	$profiles = new Profile;
    	$profiles->name = $request->input('name');
    	$profiles->user_id = Auth::user()->id;
        $profiles->profile_about = $request->input('profile_about');

    	if($request->hasFile('profile_image')){

			$file = $request->file('profile_image');
			$extension = $file->getClientOriginalExtension();
    		$file->move(public_path(). '/uploads', $file->getClientOriginalName());
    		$url = URL::to("/").'/uploads'. '/' . $file->getClientOriginalName();
		}
		else{
			$url = 'noimage.jpg';
		}

    	$profiles->profile_image = $url;
        $profiles->save();

    	return redirect('/home')->with('success','Profile Added Successfully');
    }
}
