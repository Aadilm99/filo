<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Requests;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApproveMail;
use App\Mail\RefuseMail;

class RequestsController extends Controller
{
    public function request($id){

        $requests = Requests::all();

        return view('adminDashboard')->with('requests', $requests);
    }

    public function addRequest(Request $request){
        $this->validate($request, [
            'reason' => 'required|max:200'
        ]);

        /*
        * Create a new Request
        */
        // Create an instance of Category Model
        $requests = new Requests;
        //Access category from database and read the stored input (take in as a request) from category field
        $requests->reason = $request->input('reason');
        $requests->user_id = Auth::user()->id;
        $requests->post_id = $request->input('post_id');
        // Save item category
        $requests->save();
        // redirect user to category route with a corresponding message
        return redirect('/home')->with('success', 'Request sent to Admin Successfully');
    }

    public function makeRequest($id){
        $posts = Post::find($id);
        return view('admin.create', ['posts' => $posts]);
    }

    public function approveRequest($id){
        $requests = Requests::find($id);
        $requests->status = 'Approved';
        $requests->save();

        return redirect('/request/{id}')->with('success', 'Status Approved');;
    }

    public function refuseRequest($id){
        $requests = Requests::find($id);
        $requests->status = 'Revoked';
        $requests->save();

        return redirect('/request/{id}')->with('success', 'Status Refused');;
    }

    public function emailApprovedRequest($id){


        $user = User::find($id);

        Mail::to($user->email)->send(new ApproveMail());

        return redirect('/request/{id}')->with('success', 'Email sent to user successfully');
    }

    public function emailRefuseRequest($id){
        $user = User::find($id);

        /* $user = auth()->user()->request->user_id; */
        Mail::to($user->email)->send(new refuseMail());

        return redirect('/request/{id}')->with('success', 'Email sent to user successfully');
    }
}
