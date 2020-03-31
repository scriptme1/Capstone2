@extends('layouts.app')

@section('content')
<div class="row">
	
</div>


	<div class="row">
		<div class="col-lg-8 offset-lg-2" >
			{{-- @if(Session::has("newcategory"))
				<h4>{{Session::get("newcategory")}}</h4>
			@endif --}}
			<form method="POST" action="/categories">
				@csrf
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" name="name" id="name"
					class="form-control">
				</div>
				<button type="submit" class="btn btn-success">
					Add new category</button>
			</form>
			<div class="pt-3">
				<button type="button" class="btn btn-primary
				" data-toggle="modal" data-target="#modalManufacturer">
 				 Add Manufacturer
				</button>
			</div>

			<div class="pt-3">
				<button type="button" class="btn btn-primary
				" data-toggle="modal" data-target="#modalSupplier">
 				 Add Supplier
				</button>
			</div>
			
				<!-- Modal -->
			<div class="modal fade" id="modalManufacturer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  				<div class="modal-dialog" role="document">
    			
	    			<div class="modal-content">
		      			<form method="POST" action="/manufacturers">
		      				@csrf
		      				<div class="modal-header">
		        				<h5 class="modal-title" id="exampleModalLabel">Add Manufacturer</h5>
		        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          				<span aria-hidden="true">&times;</span>
		        				</button>
		      				</div>
		      			<div class="modal-body">
		        			<label for="name">Manufacturer:</label>
							<input type="text" name="name" id="name"class="form-control">
					
							<label for="name">Address:</label>
							<input type="text" name="address" id="address" class="form-control">

							<label for="name">Contact Person:</label>
							<input type="text" name="contact_person" id="contact_person"class="form-control">

							<label for="name">Contact Number:</label>
							<input type="text" name="contact_number" id="contact_number"class="form-control">

							<label for="name">Email:</label>
							<input type="email" name="email" id="email"class="form-control">
		      			</div>
		      			
		      			<div class="modal-footer">
		        				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        				<button type="Submit" class="btn btn-primary">Save changes</button>
		      			</div>
	    				</form>
	    			</div>
	  			</div>
			</div>
		</div>

			<div class="modal fade" id="modalSupplier" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  				<div class="modal-dialog" role="document">
    			
	    			<div class="modal-content">
	    			<form method="POST" action="/suppliers">
	    			@csrf
		      				<div class="modal-header">
		        				<h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
		        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          				<span aria-hidden="true">&times;</span>
		        				</button>
		      				</div>
		      			<div class="modal-body">
		        			<label for="name">Supplier:</label>
							<input type="text" name="name" id="name"class="form-control">
					
							<label for="name">Address:</label>
							<input type="text" name="address" id="address" class="form-control">

							<label for="name">Contact Person:</label>
							<input type="text" name="contact_person" id="contact_person"class="form-control">

							<label for="name">Contact Number:</label>
							<input type="text" name="contact_number" id="contact_number"class="form-control">

							<label for="name">Email:</label>
							<input type="email" name="email" id="email"class="form-control">
		      			</div>
		      			
		      			<div class="modal-footer">
		        				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        				<button type="submit" class="btn btn-primary">Save changes</button>
		      			</div>
		      			</form>
	    			</div>
	  			</div>
			</div>
		</div>


	</div>

	 <div class="row">
		<div class="col-lg-8 offset-lg-2">
			<form method="POST" action="/products" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" name="name" id="name" class="form-control">
				</div>
				<div class="form-group">
					<label for="description">Description:</label>
					<textarea name="description" id="description" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for="price">Equipment Cost:</label>
					<input type="number" name="cost" id="cost" step=0.01 min=0 class=" form-control">
				</div>

				<div class="form-group">
					<label for="date">Date Acquired:</label>
					<input type="date" name="acquired_at" id="acquired_at" class=" form-control">
				</div>
				<div class="form-group">
					<label for="condition">Condition:</label>
					<input type="text" name="condition" id="condition"  class="form-control">
				</div>
				<div class="form-group">
					<label for="serialno">Serial No:</label>
					<input type="text" name="serial_no" id="serial_no" class="form-control">
				</div>
				
				<div class="form-group">
					<label for="quantity">Quantity:</label>
				<input type="number" name="quantity" id="quantity" step=1 min=1 class="form-control">
				</div>

				<div class="form-group">
					<label for="image">Upload Image:</label>
					<input type="file" name="image" id="image" class="form-control">
				</div>



				<div class="form-group">
					<label for="category">Category:</label>
					<select name="category">
						@foreach($categories as $category)
							<option value="{{$category->id}}">
								{{$category->name}}
							</option>
						@endforeach
					</select>
				</div>


				<div class="form-group">
					<label for="manufacturer">Manufacturer:</label>
					<select name="manufacturer">
						@foreach($manufacturers as $manufacturer)
							<option value="{{$manufacturer->id}}">
								{{$manufacturer->name}}
							</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="supplier">Supplier:</label>
					<select name="supplier">
						@foreach($suppliers as $supplier)
							<option value="{{$supplier->id}}">
								{{$supplier->name}}
							</option>
						@endforeach
					</select>
				</div>

				<button type="submit" class="btn btn-success">Add New Product</button>	
			</form>
		</div>
	</div> 
@endsection