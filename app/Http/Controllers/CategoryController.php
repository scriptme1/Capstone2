<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Session;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                
        // dd ($request->name);

        // instantiate a new object from the Category Model
        $category = new Category ;
        // set the property of the newly instantiated object accordingly
        $category->name = $request->name;
        // save the newly instantiated object, doing so will store it
        // as an entry in its corresponding table in the DB
        $category->save();
        // Session::flash("newcategory", " New category" . $request->name);
        //retrieve all categorues via the all method of the Category model and return to the products creation page
       // return view('products.create');
        return redirect('products/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $products = Product::withTrashed()->get();
        $products = $category->products;
         
        return view("products.catalog", compact("products"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    // public function search(Request $request){
    //     $query = $request->post('search');

    //     if ($query != null){

    //         $products = Category:: where('name', 'like', '%' .$query. '%')->get();
    //         // dd($product);
    //     }
    //     return view("products.catalog", compact("products"));
    // }

}


