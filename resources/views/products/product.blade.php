@extends("layouts.app1")
@section("content")

{{-- Put all the details of the item including the image --}}

{{-- Show the category NAME of the product --}}
{{-- Hint 1: Make sure there is a relationship FROM Product to Category --}}
{{-- Hint 2: treat the category of the product as its property --}}

{{-- $product->category pulls ALL of the properties of the category --}}
 <div class="containerProd"style="text-align:center">
	<h2> Equipment Name: {{$product->name}}</h2>
	<h3>Category: {{$product->category->name}}</h3>
	 <h4>Manufacturer: {{$product->manufacturer()->first()->name}}</h4>

	
<div class="prod"> 
	{{-- //blog-post  --}} 

	<div class="prodCard">
		{{-- blog-post__img --}}
		<img class="prodImage" src="{{asset($product->img_path)}}" alt="" style="height: 300px">
	</div>
	<div class="prodInfo">
		{{-- blog-post__info --}}
		<div class="prodInformation">
			
			<span> <label>Equipment Condition :</label>{{$product->condition}}</span>
					
			<span><label>Date Acquired :</label>{{$product->acquired_at}}</span>
		</div>
		<h1 class="EquipName">{{$product->name}}</h1>
		
		<p class="EquipDesc">Description: {{$product->description}}</p>
		<p>Serial No: {{$product->serial_no}}</p>
	
		@if(Auth::user()->isAdmin)
		 <div class="buttons">
		  <a href="/products/{{$product->id}}/edit" class="btn btn-primary">Edit Item Details</a>

			<form action="/products/{{$product->id}}" method="POST">
				@csrf
				{{ method_field("DELETE") }} 
				{{-- {{  POST and GET are the HTTP verbs that are supported by method, we override it to become DELETE --}}
			 	<button type="submit" class="btn btn-danger">Delete</button>
			</form>
		 @endif
		 </div>
	</div>
</div>
</div>
@endsection