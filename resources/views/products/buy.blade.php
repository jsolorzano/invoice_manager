@extends('..layouts.app')

@section('content')
<div class="container" style="margin-top:30px">
  <div class="row bg-gray justify-center text-center">
	<div class="col-md-8">
	  <h1 class="">Buy Product</h1>
    </div>
  </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Buy') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('purchase.store') }}">
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
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="product_id" type="hidden" name="product_id" value="{{ $product->id }}">
                                <input id="name" class="form-control" type="text" name="name" value="{{ $product->name }}" placeholder="Write the name of the product" readonly="true">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" type="text" id="quantity" name="quantity" value="{{ old('quantity') }}" placeholder="Write the quantity of the product" autocomplete="quantity" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('BUY') }}
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
