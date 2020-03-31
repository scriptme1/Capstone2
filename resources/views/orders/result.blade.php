@extends("layouts.app")
@section("content")
<div class="row">
	<div class="col-lg-6 offset-lg-3 text-center">
		<h4>Your order {{$refNo}} has been created. Thank you for your patronage </h4>
		<a href="/products" class="btn btn-outline btn-success">Shop Again?</a>
	</div>
</div>
@endsection