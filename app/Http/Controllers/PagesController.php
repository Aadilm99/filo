<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $titleHome = "Welcome to FiLo";
        return view('pages.index')->with('titleHome', $titleHome);
    }

    public function about(){
        $dataArr = [
            'title' => 'Welcome to the About Page!',
            'services' => ['Register to Create, Edit and Delete Posts', 'View User found items', 'Request Items']
        ];

        return view('pages.about')->with($dataArr);
    }

}
