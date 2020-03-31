@extends("layouts.app")
@section("content")
	<div class="row">
		<div class="col-lg-8 offset-lg-2">
			<h2 class="text-center">My Requested Items</h2>
			<table class="table table-striped">
				<thead>
					<th>Name</th>
					<th class="col-sm-5">Desription</th>
					<th>Equipment Cost</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					<th>Action</th>
					
				</thead>
				<tbody>
					{{-- Use a foreach loop to display the items in their corresponding cells --}}
					@if(!empty($details_of_items_in_cart))
						@foreach($details_of_items_in_cart as $indiv_product)
							 <tr>
							 	<td>{{$indiv_product->name}}</td>
							 	<td>{{$indiv_product->description}}</td>
							 	<td>{{$indiv_product->cost}}</td>
							 	<td>
							 		<form action="cart/{{$indiv_product->id}}" method="POST">
							 		@csrf
							 		{{method_field("PATCH")}}
							 			<input type="number" name="newqty" class="form-control"
							 			value={{$indiv_product->quantity}} min=1>
							 		<button type="submit" class="btn btn-info">Update Qty</button>
							 			
							 		</form>
							 	</td>
							 	
							 	<td>{{$indiv_product->subtotal}}</td>
							 	<td>
								 <form action="cart/{{$indiv_product->id}}" method="POST">
								 			@csrf
								 			{{method_field("DELETE")}}
								 <button type="submit" class="btn btn-danger">Remove Item</button>
								 			
								 	</form>
							 	</td>
							 </tr>
						@endforeach
						<tr>
						 	<td></td>	
						 	<td></td>	
						 	<td></td>	
						 	<td>Total:</td>	
						 	<td>{{$total}}</td>	
						</tr>

					@else
						<tr>
							<td colspan="8">No items to display</td>
						</tr>

					@endif	
				</tbody>
			</table>			
			<a href="/cart/confirm" class="btn btn-success">Checkout</a>
			<a href="/products" class="btn btn-info">Add more products</a>
			<form action="/cart/empty" method="POST">
				@csrf
				{{ method_field("DELETE") }}
				<button type="submit" class="btn btn-danger">Empty Cart</button>
			</form>
		</div>
	</div>

@endsection
