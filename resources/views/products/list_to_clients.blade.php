@extends('..layouts.app')

@section('content')
<div class="container" style="margin-top:30px">
  <div class="row bg-gray justify-center text-center">
	<h1 class="">List Products</h1>
  </div>
</div>

<div class="container" style="margin-top:30px">
	
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

						<td>

							<a class="btn btn-primary btn-sm" href="{{ route('products.buy', $product) }}" title="Buy">Buy</a>

						</td>

					</tr>

					@endforeach

				</tbody>

			</table>

		</div>

	</div>
</div>
@endsection
