<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;

class CategoriesController extends Controller
{
    /* Function category which essentially returns the view of the category blade file */
    public function category(){

        return view('categories.category');
    }

    /* Function addCategory which is used to relatively enable a user to input items which through the request stores the input into the Database */
    public function addCategory(Request $request){

        //Validation used to ensure that only items such as pet, phone and jewellery are to be entered to match the enum type in the database
        $this->validate($request, [
            'category' => 'in:pet,phone,jewellery',
        ]);

        /*
        * Create a new Item Category
        */
        // Create an instance of Category Model
        $itemCategory = new Category;
        //Access Item category from database and read the stored input (take in as a request) from category field
        $itemCategory->category = $request->input('category');
        // If statement used to check whether or not a specified item already exists in the database, and if it is then it won't be added
        if(Category::where("category" , "=" ,$itemCategory->category)->first() == null){
            // Save item category
            $itemCategory->save();
            //Redirects to the category back with a success message to alert admin that item is added
            return redirect('/category')->with('success', 'Item Category Added Successfully');
        }
        else{
            // redirects user to category route with a corresponding message that Item entered already exists
            return redirect('/category')->with('error', 'Item Category already exists');
        }

    }
}
