@extends("layouts.app")
@section("content")
<div class="row">
	<div class="col-lg-6 offset-lg-3">
		<h4>Transaction History</h4>
	</div>
</div>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<table class="table table-striped">
			<thead>
				<th>Reference No.</th>
				<th>User</th>
				<th>Total</th>
				<th>Status</th>
				<th>Details</th>
				@if(Auth::user()->isAdmin)
				<th>Actions</th>
				@endif
			</thead>
			<tbody>
				@foreach($orders as $order)
				{{-- Stretch goal, use the relationship to get the user's name and status name  --}}
				<tr>
					<td>{{$order->refNo}}</td>
					<td>{{$order->user->name}}</td>
					<td>{{$order->total}}</td>
					<td>{{$order->status->name}}</td>
					<td>
						@foreach($order->products as $product)
						{{-- $order->products used the pivot table products_orders to look at the details of ALL the products linked to the order --}}
							<p>Name: {{$product->name}}, Qty:{{$product->pivot->quantity}} </p>
							{{-- pivot refers to the columns associated to the product in the pivot table --}}
						@endforeach
					</td>
				@if(Auth::user()->isAdmin && $order->status_id == 1)
						<td>
							<form action="/orders/{{$order->id}}" method="POST">
								@csrf
								{{ method_field("PATCH") }}
								<button type="submit" class="btn btn-outline-success">Approve Request</button>
							</form>
							{{-- Do the cancel action --}}
							<form action="/orders/{{$order->id}}" method="POST">
								@csrf
								{{ method_field("DELETE") }}
								<button type="submit" class="btn btn-outline-danger">Cancel Order</button>
							</form>
						</td>
				@elseif(Auth::user()->isAdmin && $order->status_id == 2)
						<td>
							
 						{{-- Do the return action by the user --}}
							<form action="/orders/{{$order->id}}" method="POST">
							@csrf
								{{ method_field("PATCH") }}
							<button type="submit" class="btn btn-outline-info">Accept Returned Item</button>
							</form>
						</td>

					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection