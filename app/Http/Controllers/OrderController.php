<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Auth; //for user
use App\Product; //use the product model
use App\Status; //use the status model
use Session; //to get the cart

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){ //only shows orders for those who are logged in
            $orders = [];
            if(Auth::user()->isAdmin){
                $orders = Order::all(); //gets the list of ALL orders
            } else {
                //get the orders belong to the user
                //select * from orders WHERE user_id = ?
                $orders = Order::where("user_id", Auth::user()->id)->get();
                //Note: ::find() was not used because it is only used for primary keys
            }
            // dd($orders);
            return view("orders.orderlist", compact("orders"));
        } else {
            return redirect("/login");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd("hello");
        //Create a new order with total = 0
        $refNo = "Req".time();
        $new_order = new Order;
        $new_order->refNo = $refNo;
        $new_order->user_id = Auth::user()->id;
        $new_order->status_id = 1; //always pending (default)
        $new_order->total = 0;
         //dd($new_order);
        $new_order->save(); //created a new order
        //Attach the products to the new order -> write to the products_orders table
        $total = 0;
        foreach(Session::get("cart") as $item_id => $quantity){
            $product = Product::find($item_id); //to get the price property
            //dd($product);
            $subtotal = $product->cost * $quantity;
            //checklist to attach: order_id ($new_order), item_id ($item_id), quantity ($quantity), subtotal ($subtotal)
            //to populate the products_orders table
            $new_order->products()->attach($item_id, ["quantity" => $quantity,
                 "subtotal" => $subtotal]);
            //"For this order, get the pivot table (products_orders) and create a new row with its order_id, item_id and the quantity and subtotal fields"
            //The 2nd parameter of attach (associative array) contains all the pivot columns
            //update the total
            $total += $subtotal;
        }
        //Update the new order's total
        $new_order->total = $total;
                
        $new_order->save();
        Session::forget("cart");
        // return "Order successfully created";
        return view("orders.result", compact("refNo"));
        //Create a view that contains a line saying "Your order <refNo> has been successfully created" and a button that bring it back to the catalog
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if(Auth::user()->isAdmin && $order->status_id == 1){

        foreach ($order->products as $item) {
            $stock = $item->quantity;
            $quantity = $item->pivot->quantity;
            $new_stock = $stock - $quantity;

            $stock_update = $item->update(['quantity'=> $new_stock]);
        }

            $order->status_id = 2;
            $order->save();
        
     } else if(Auth::user()->isAdmin && $order->status_id == 2) {

        foreach ($order->products as $item) {
            $stock = $item->quantity;
            $quantity = $item->pivot->quantity;
            $new_stock = $stock + $quantity;

            $stock_update = $item->update(['quantity'=> $new_stock]);


     }

        $order->status_id = 4;
        $order->save();
    }
        return redirect("/orders");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {

        $order->status_id = 3;
        $order->save();
        return redirect("/orders");
    }
}
