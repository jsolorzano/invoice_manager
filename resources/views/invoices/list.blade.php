@extends('..layouts.app')

@section('content')
<div class="container" style="margin-top:30px">
  <div class="row bg-gray justify-center text-center">
	<h1 class="">Invoices list</h1>
  </div>
</div>

<div class="container" style="margin-top:30px">
	
	<div class="row bg-gray justify-content-left text-left">
		<div class="col-md-12">
			<a type="button" class="btn btn-primary" href="{{ route('invoices.store') }}" title="Generate" target="_blank" onclick="event.preventDefault();document.getElementById('store-form').submit();">
				Issue invoices
			</a>
			<form id="store-form" action="{{ route('invoices.store') }}" method="POST" class="d-none">
				{{ csrf_field() }}
			</form>
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

						<th>N°</th>

						<th>Created by</th>

						<th>Created at</th>

						<th>Actions</th>

					</tr>

				</thead>

				<tbody>

					@foreach($invoices as $invoice)

					<tr>

						<td>{{ $invoice->id }}</td>

						<td>{{ $invoice->user->name }}</td>

						<td>{{ $invoice->created_at->format('j F, Y') }}</td>

						<td>

							<a class="btn btn-primary btn-sm" href="{{ route('invoices.detail', $invoice) }}" title="Detail" target="_blank">Detail</a>

						</td>

					</tr>

					@endforeach

				</tbody>

			</table>

		</div>

	</div>
</div>
@endsection
