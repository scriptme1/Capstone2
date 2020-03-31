<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Product; // allows us to use the Product Model
use Auth; // allows us to call the user Session

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //localhost:8000/cart
    {
        //Session::forget("cart");
       // dd(Session::get("cart"));
        // use the session cart to get the details for the items.
        $details_of_items_in_cart =[];
        $total = 0;
        if(Session::exists("cart") || Session::get("cart") != null){
            foreach (Session::get("cart") as $item_id => $quantity) {
        
            // Because session cart has keys(item_id) and values (quantity)
            //Find the item
            $product = Product::find($item_id);
            //Get the details needed (add properties not in the original item)
            $product->quantity = $quantity;
            $product->subtotal = $product->cost * $quantity;
            // Note : these properties (quantity and subtoptal Are Not part of the Product Stored in the database, they are only for $product)
            //Push to array containing the details
            //google how to push data in an array
            //Syntax: array_push(target array, data to be pushed)
            array_push($details_of_items_in_cart, $product);
            $total += $product->subtotal;
            //total = total + subtotal
            }
        //send the array to the view
        //dd($details_of_items_in_cart);
        }
        return view("products.cart", compact("details_of_items_in_cart",
            "total"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //dd($request);
        //$cart[$request->item_id] = $request->quantity;
        //ways to create an array
            //$cart = array(values);
            //$cart = [value1, value2, etc];
            //$cart[key/index] = value;
        //What happens when an item is added to cart, it will assign the quantity
        // to index number equal to the item_id.
        //Session::put("cart", $cart); // adds a session variable called cart with the content from $cart
        //dd(Session::get("cart"));
        // This is only halfway done, why? Because the Session::put overwrites the original content. Fina a way to prevent it from overwriting. (Ie. revamp the entire logic)
        
        // Check if there is already a cart
        //1a. If there is no cart, create a new one
        //1b. If there is already a cart, call the cart and update the content.
        //2b. Save the updated cart in the session.

        $cart = []; //empty cart
        if(Session::exists("cart")){ // if there is a cart in our session, pull it.
            $cart = Session::get("cart");
        }
        $cart[$request->item_id]= $request->quantity;// update the cart
        Session::put("cart", $cart); 
        //dd(Session::get("cart"));
        Session::flash("message", $request->quantity . "items added to cart");
        // dd(Session::get("cart"));
        // push it back to the session cart
        
        //Syntax: put into $cart into a session variable called "cart".
        
        return redirect("/products"); //return to the catalog page.
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        
            $cart = Session::get("cart");
            $cart[$id] = $request->newqty;
            Session::put("cart", $cart);   
            return redirect("/cart");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
        
        Session::forget("cart.$id");//unset ($_session)['cart']['id']         
         return redirect("/cart");
        
         // if(Session::exists("id")){
            // Session::forget("id");
     
        }
       // return "item with id: $id to be removed from cart";
        //Question is it possible to forget specific keys in a Session variable?
    

    public function emptyCart(){
        if(Session::exists("cart")){
            //Remove all cart entries
            Session::forget("cart");
        }
        return redirect("/cart");
    }

    // public function emptyCart(){
    //     if(Session::exists("cart")){
    //         Session::forget("cart");
     
    //     }
    //     return redirect("/cart");

    // }

    public function confirmOrder(){
        //check if the user is logged in
        // if the user is logged in, get the cart again, recalculate the subtotal and total, and send it to a view called orders.confrim
        // if the user is not logged in, redirect the user to the login page.
        if (Auth::check()){
            $details =
            $details_of_items_in_cart=[];
            $total = 0;

            if(Session::exists("cart") || Session::get("cart") !=null){
                foreach (Session::get("cart") as $item_id => $quantity) {
                    $product = Product::find($item_id);
                    //add quantities and subtotals, compute the toals and push the product into details_of_items_in_cart
                    $product->quantity = $quantity;
                    $product->subtotal = $product->cost * $quantity;
                    array_push($details_of_items_in_cart, $product);
                    $total += $product->subtotal;
                    //dd($details_of_items_in_cart);
                }
            }//dd($total);
            return view("orders.confirm", compact("details_of_items_in_cart", "total"));
        } else {
            return redirect("/login");
        }
    }
 }
