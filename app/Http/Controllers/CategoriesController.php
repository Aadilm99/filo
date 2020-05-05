<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;

class CategoriesController extends Controller
{
    public function category(){

        return view('categories.category');
    }

    public function addCategory(Request $request){
        $this->validate($request, [
            'category' => 'in:pet,phone,jewellery',
        ]);

        /*
        * Create a new Item Category
        */
        // Create an instance of Category Model
        $itemCategory = new Category;
        //Access category from database and read the stored input (take in as a request) from category field
        $itemCategory->category = $request->input('category');
        if(Category::where("category" , "=" ,$itemCategory->category)->first() == null){
             // Save item category
            $itemCategory->save();
            return redirect('/category')->with('success', 'Item Category Added Successfully');
        }
        else{
                    // redirect user to category route with a corresponding message
                    return redirect('/category')->with('error', 'Item Category already exists');
        }

    }
}
