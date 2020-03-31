@extends("layouts.app1")
@section("content")
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<form method="POST" action="/products/{{$product->id}}" enctype="multipart/form-data">
			@csrf
			{{ method_field("PATCH") }}
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" name="name" id="name" class="form-control" value="{{$product->name}}">
			</div>
			<div class="form-group">
				<label for="description">Description:</label>
				<textarea name="description" id="description" class="form-control">{{$product->description}}</textarea>
			</div>
			<div class="form-group">
				<label for="price"> Equipment Cost:</label>
				<input type="number" name="cost" id="cost" step=0.01 min=0 class="form-control" value="{{$product->cost}}">
			</div>

			<div class="form-group">
				<label for="date">Date Acquired:</label>
				<input type="date" name="acquired_at" id="acquired_at" class=" form-control" value="{{$product->acquired_at}}">
			</div>
				
			<div class="form-group">
				<label for="condition">Condition:</label>
				<input type="text" name="condition" id="condition"  
				class="form-control" value="{{$product->condition}}">
			</div>
				
			<div class="form-group">
				<label for="serialno">Serial No:</label>
				<input type="text" name="serial_no" id="serial_no" 
				class="form-control" value="{{$product->serial_no}}">
			</div>
				
			<div class="form-group">
				<label for="quantity">Quantity:</label>
				<input type="number" name="quantity" id="quantity" step=1 min=1 
				class="form-control" value="{{$product->quantity}}">
			</div>


			<div class="form-group">
				<img src="{{asset($product->img_path)}}" alt="" style="height:50px; width: 50px">
				<label for="image">Upload Image:</label>
				<input type="file" name="image" id="image" class="form-control">
			</div>
			<div class="form-group">
				<select name="category">
					@foreach(App\Category::all() as $category)
						<option value="{{$category->id}}" 
							{{$product->category_id == $category->id ? "selected" 
							: "" }}>
							{{$category->name}}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<select name="manufacturer">
					@foreach(App\Manufacturer::all() as $manufacturer)
					<option value="{{$manufacturer->id}}" 
							{{$product->manufacturer_id == $manufacturer->id ? "selected" : "" }}>
							
							{{$manufacturer->name}}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<select name="supplier">
					@foreach(App\Supplier::all() as $supplier)
						<option value="{{$supplier->id}}" 
							{{$product->supplier_id == $supplier->id ? "selected" 
							: "" }}>
							
							{{$supplier->name}}
						</option>
					@endforeach
				</select>
			</div>

			<button type="submit" class="btn btn-outline-success">Edit product</button>
		</form>
	</div>
</div>
@endsection