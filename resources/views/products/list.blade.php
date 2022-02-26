@extends('..layouts.app')

@section('content')
<div class="container" style="margin-top:30px">
  <div class="row bg-gray justify-center text-center">
	<h1 class="">List Products</h1>
  </div>
</div>

<div class="container" style="margin-top:30px">
	
	<div class="row bg-gray justify-content-left text-left">
		<div class="col-md-12">
			<a type="button" class="btn btn-primary" href="{{ route('products.create') }}" title="New">
				Create new product
			</a>
		</div>
	</div>
	
    <div class="row justify-content-center">
		
		<div class="col-md-12">

			@if (session('status'))

				<div class="alert alert-success" style="margin-top:30px;">x

				  {{ session('status') }}

				</div>

			@endif

			@if($errors->any())

				<div class="alert alert-warning" style="margin-top:30px;">x

				  {{$errors->first()}}

				</div>

			@endif

			<table class="table table-bordered mt-12">

				<thead>

					<tr>

						<th>Name</th>

						<th>Price</th>

						<th>Tax</th>

						<th>Stock</th>

						<th>Creation</th>

						<th>Actions</th>

					</tr>

				</thead>

				<tbody>

					@foreach($products as $product)

					<tr>

						<td>{{ $product->name }}</td>

						<td>{{ $product->price }}</td>

						<td>{{ $product->tax }}</td>

						<td>{{ $product->stock }}</td>

						<td>{{ $product->created_at->format('j F, Y') }}</td>

						<td>

							<a class="btn btn-primary btn-sm" href="{{ route('products.edit', $product) }}" title="Edit">Edit</a>

							<a class="btn btn-danger btn-sm delete-product" href="{{ route('products.destroy', $product) }}" title="Delete" data-id="{{$product->id}}">Delete</a>
							
							<form id="products.destroy-form-{{$product->id}}" action="{{ route('products.destroy', $product) }}" method="POST" class="hidden">
								{{ csrf_field() }}
								@method('DELETE')
							</form>

						</td>

					</tr>

					@endforeach

				</tbody>

			</table>

		</div>

	</div>
</div>
<script>

    var delete_product_action = document.getElementsByClassName("delete-product");

    var deleteAction = function(e) {
        event.preventDefault();
        var id = this.dataset.id;
        if(confirm('Are you sure?')) {
            document.getElementById('products.destroy-form-' + id).submit();
        }
        return false;
    }

    for (var i = 0; i < delete_product_action.length; i++) {
        delete_product_action[i].addEventListener('click', deleteAction, false);
    }
</script>
@endsection
