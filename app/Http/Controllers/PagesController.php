<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests;

/* The pages controller class essentially refers to two views for the user to view */
class PagesController extends Controller
{
    //Function home will relatively return the main index pages e.g. the login etc.
    public function home(){
        return view('pages.index');
    }
    // Function userRequests is essentially a view for the users where they can view their requests made for an item
    public function userRequests(){
        $requests = Requests::all();
        return view('pages.requestView')->with('requests', $requests);
    }

}
