{{--  @extends("layouts.app1")

@section("content") --}}

<div class="row">
 {{-- <div id="filteredProd">	 --}}
		@foreach($products as $indiv_product)
		{{-- dd($products); --}}
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
						{{--  <form action="/products/{{$indiv_product->id}}/restore" method="POST">
							@csrf 
							 {{ method_field('PUT') }}
							<input type="hidden" name="id" value="{{$indiv_product->id}}"> --}}
							 
							<a href="/products/{{$indiv_product->id}}/restore" class="btn btn-outline-success">Restore</a>
							
						 {{-- </form> --}}
 						
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
		 {{-- </div> --}}
	</div>