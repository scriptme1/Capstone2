@extends("layouts.app")

@section("content")
<div class="container">	{{-- Filtering --}}
	
	<div class="filter">
		<a href="/products" class="btn btn-outline-success mb-3">ALL</a>
		<label for="Category">Select Category:</label>
		<div>
		    <select class="form-control" id="catId">
			<option value="" disabled selected>Category</option>
				@foreach(App\Category::all() as $indiv_category)
				  <option value="{{$indiv_category->id}}">{{$indiv_category->name}}</option>	
				@endforeach
		    </select>
		</div>
	    <label for="Manufacturer">Select Manufacturer:</label>
    	
    	<div>	
		    <select class="form-control" id="manId">
			<option value="" disabled selected>Manufacturer</option>
				@foreach(App\Manufacturer::all() as $indiv_manufacturer)
				  <option value="{{$indiv_manufacturer->id}}">{{$indiv_manufacturer->name}}</option>	
				@endforeach
		    </select>
	    </div>
	    <button class="btn btn-outline-success"id="findBtn">Filter</button>
    </div>
 
		{{-- <div>
		 @foreach(App\Category::all() as $indiv_category)

			<a href="/categories/{{$indiv_category->id}}" class="btn btn-outline-warning mb-3">{{$indiv_category->name}}</a>
			  {{- This uses the categories route (/categories) and needs the show() method of the CategoryController --}}
		 {{-- @endforeach --}}
	{{-- 	{{-- </div> --}} 
	{{-- <div>
		<h5>Manufacturer</h5>
		@foreach(App\Manufacturer::all() as $indiv_manufacturer)
			<a href="/manufacturers/{{$indiv_manufacturer->id}}" class="btn btn-outline-warning mb-3">{{$indiv_manufacturer->name}}</a>
			{{-- This uses the MANUFACTURERS route (/manufacturers) and needs the show() method of the ManufacturerController --}}
	{{-- 	@endforeach --}}
	{{-- </div> --}}

	 

	{{-- <div class="row">
		@if(Session::has("message"))
			<h4>{{Session::get("message")}}</h4>
		@endif
	</div> --}}
	{{-- <div class="container"> --}}
	<div id="filteredProd" class="col-lg-12">
	<div class="row">
	
		@foreach($products as $indiv_product)
			{{-- Use cards to output the products --}}
		
			<div class="col-lg-4">
				<div class="card bg-dark mb-3" id="prodCard">
					{{-- <img src="./{{$indiv_product->img_path}}" alt="" class="card-img-top"> --}}
					<img src="{{asset($indiv_product->img_path)}}" alt=""  class="card-img-top" style="height: 200px">
					<div class="card-body" id="cardContent">
						<h5 class="card-title">{{$indiv_product->name}}</h5>
						<p class="card-text" id="pdesc">{{$indiv_product->description}}</p>
						<p class="card-text">Cost: {{$indiv_product->cost}}</p>
					<p class="card-text">Year Acquired: {{$indiv_product->acquired_at}}</p>
						
						{{-- <p class="card-text">Serial No.: {{$indiv_product->serial_no}}</p> --}}
						<p class="card-text">Quantity: {{$indiv_product->quantity}}</p>
						
					@if($indiv_product->quantity == 0 || !is_null($indiv_product->deleted_at))
						
						<p class="text-danger">  Equipment Not Available</p>
						@else 
						  <p class="card-text">Condition:{{$indiv_product->condition}}</p>
						@endif
					@if(Auth::check())
					<div class ="buttons">
						@if(Auth::user()->isAdmin && !is_null($indiv_product->deleted_at))
						
							 
				<a href="/products/{{$indiv_product->id}}/restore" class="btn btn-outline-success">Restore</a>
							
						 
 						
 						@elseif (($indiv_product->quantity > 0) || is_null($indiv_product->deleted_at))
						<a href="/products/{{$indiv_product->id}}" class="btn btn-outline-info">View Details</a>
						@endif
					</div>
				@endif
					</div>
				
					<div class="card-footer">
						@if(!Auth::check() || !Auth::user()->isAdmin && ($indiv_product->quantity >0 && is_null($indiv_product->deleted_at)))
						<form action="/cart" method="POST">
							@csrf
							<input type="hidden" name="item_id" value={{$indiv_product->id}}>
							<input type="number" class="form-control" name="quantity" min=1 value=1 max="{{$indiv_product->quantity}}">
						
							<button type="submit" class="btn btn-outline-success"style="margin-top: 5px">Add To Cart</button>
							
						</form>
						@endif	
					</div>
					 
				</div>
			</div>
		
		@endforeach
	</div>
	</div>
	</div>


@endsection



