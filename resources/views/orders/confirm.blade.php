@extends("layouts.app")
@section("content")
	{{-- <div class="row">
		
	</div> --}}

	<div class="row">

		<div class="col-lg-8 offset-lg-2">
			<h3 class="text-center">Equipment Order Summary</h3>
			<table class="table table-striped">
				<thead>
					<th>Name</th>
					<th>Desription</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					
				</thead>
				<tbody>
					{{-- Use a foreach loop to display the items in their corresponding cells --}}
					@if(!empty($details_of_items_in_cart))
						@foreach($details_of_items_in_cart as $indiv_product)
							 <tr>
							 	<td>{{$indiv_product->name}}</td>
							 	<td>{{$indiv_product->description}}</td>
							 	<td>{{$indiv_product->cost}}</td>
							 	<td>{{$indiv_product->quantity}}</td>
							 	<td>{{$indiv_product->subtotal}}</td>
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
							<td colspan="5">No items to display</td>
						</tr>

					@endif	
				</tbody>
			</table>
			<form action="/orders" method="POST">
				@csrf
				<button type="submit" class="btn btn-success">Confirm Order</button>
			</form>
		</div>
	</div>

@endsection