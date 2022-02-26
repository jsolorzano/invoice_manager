@extends('..layouts.app')

@section('content')
<div class="container" style="margin-top:30px">
  <div class="row bg-gray justify-center text-center">
	<div class="col-md-8">
	  <h1 class="">Create Product</h1>
    </div>
  </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}">
                        @csrf
                        
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

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Write the name of the product" autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" type="text" id="price" name="price" value="{{ old('price') }}" placeholder="Write the price of the product" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tax" class="col-md-4 col-form-label text-md-end">{{ __('Tax') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" type="text" id="tax" name="tax" value="{{ old('tax') }}" placeholder="Write the tax of the product" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="stock" class="col-md-4 col-form-label text-md-end">{{ __('Stock') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" type="text" id="stock" name="stock" value="{{ old('stock') }}" placeholder="Write the stock of the product" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('SEND') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
