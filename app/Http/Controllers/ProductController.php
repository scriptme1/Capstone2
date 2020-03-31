<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;
use App\Product;
use App\Category;
use App\Manufacturer;
use App\Supplier;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    //a normal user can view all products and view single product

    public function __construct() {
       // $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
       // $this->middleware('isAdmin')->except(['index', 'show', 'productsCat', 'logout']);
       $this->middleware('isAdmin')->except(['index', 'show', 'productsCat']);
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all(); //use the model to pull all products
        // dd($products);
        $products = Product::withTrashed()->get();

        return view("products.catalog", compact("products"));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); 
        $manufacturers = Manufacturer::all();
        $suppliers = Supplier::all();
        return view('products/create', compact('categories','manufacturers','suppliers'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->cost = $request->cost;
        $product->acquired_at = $request->dateAcq;
        $product->condition = $request->condition;
        $product->serial_no = $request->serial_no;
        $product->category_id = $request->category;
        $product->quantity = $request->quantity;
        $product->acquired_at = $request->acquired_at;
        $product->manufacturer_id = $request->manufacturer;
        $product->supplier_id = $request->supplier;
        $image = $request->file('image'); 
        $image_name = time().".".$image->getClientOriginalExtension();
        $destination = "images/";
        $image->move($destination, $image_name);
        $product->img_path = $destination.$image_name;
        //save this product in the database
        $product->save();
        return redirect("/products/create");


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //dd($product);
        $products = Product::withTrashed()->get();
        return view("products.product", compact("product"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        return view("products.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
    
        $product->name = $request->name;
        $product->description = $request->description;
        $product->cost = $request->cost;
        $product->acquired_at = $request->dateAcq;
        $product->condition = $request->condition;
        $product->serial_no = $request->serial_no;
        $product->category_id = $request->category;
        $product->quantity = $request->quantity;
        $product->acquired_at = $request->acquired_at;
        $product->manufacturer_id = $request->manufacturer;
        $product->supplier_id = $request->supplier;
         
        if($request->file("image") != null){
            $image = $request->file("image");
            $image_name = time().".".$image->getClientOriginalExtension();
            $destination = "images/";
            $image->move($destination, $image_name);
            $product->img_path = $destination.$image_name;
        }

        $product->save();
        //hint 3: where to go back after editing the product
        return redirect("/products/".$product->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect("/products");
    }

    public function restore($id){
       // dd($id);
        //$product->id = $request->id;
        $product = Product::withTrashed()->where("id", $id)->first();
        $product->restore();
        //dd($product);
        
        return redirect("/products");
    }

    public function search(Request $request){
        $query = $request->post('search');

        if ($query != null){

            $products = Product:: where('name', 'like', '%' .$query. '%')->get();
            // dd($product);
        }
        return view("products.catalog", compact("products"));
    }

    public function productsCat(Request $request){
    
        if($request->ajax()){
        $cat_id = $request->cat_id;
        $man_id = $request->man_id;
        // dd($cat_id, $man_id);
        $products = DB::table('products')
                  ->where('products.category_id',$cat_id)
                  ->where('products.manufacturer_id',$man_id)
                  ->get();
        if ($products != null){

          return view("products.filterProd", compact("products"));
        }
         
       }

    }
}

