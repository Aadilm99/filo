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

/* RequestsController essentially consitss of functions used to make requests, approve Requests, refuse Requests and also be able send an email to the specified user  */
class RequestsController extends Controller
{
    //Function will return the acquired request through getting the ID and displaying all requests on the admin dashboard
    public function request($id){

        $requests = Requests::all();

        return view('adminDashboard')->with('requests', $requests);
    }
    /* Add a request */
    public function addRequest(Request $request){
        $this->validate($request, [
            'reason' => 'required|max:200'
        ]);

        /*
        * Create a new Request
        */
        // Create an instance of Requests Model
        $requests = new Requests;
        //Access requests from database and read the stored input (take in as a request) from reason field
        $requests->reason = $request->input('reason');
        $requests->user_id = Auth::user()->id;
        $requests->post_id = $request->input('post_id');
        // Save request item
        $requests->save();
        // redirect user to home route with a corresponding message
        return redirect('/home')->with('success', 'Request sent to Admin Successfully');
    }
    /* Function will return the view from the form when creating a request through accessing the correct ID */
    public function makeRequest($id){
        $posts = Post::find($id);
        return view('admin.create', ['posts' => $posts]);
    }
    //Approve request which changes the status/enum to Approved when approveRequest is made
    public function approveRequest($id){
        $requests = Requests::find($id);
        $requests->status = 'Approved';
        $requests->save();

        return redirect('/request/{id}')->with('success', 'Status Approved');;
    }
    //Refuse request which changes the status/enum to Approved when refuseRequest is made
    public function refuseRequest($id){
        $requests = Requests::find($id);
        $requests->status = 'Revoked';
        $requests->save();

        return redirect('/request/{id}')->with('success', 'Status Refused');;
    }
    // Function will send a user an email if request has been approved
    public function emailApprovedRequest($id){
        $user = User::find($id);

        Mail::to($user->email)->send(new ApproveMail());

        return redirect('/request/{id}')->with('success', 'Email sent to user successfully');
    }
    //Function will send a user an email if the request has been declined
    public function emailRefuseRequest($id){
        $user = User::find($id);
        Mail::to($user->email)->send(new refuseMail());
        return redirect('/request/{id}')->with('success', 'Email sent to user successfully');
    }
}
