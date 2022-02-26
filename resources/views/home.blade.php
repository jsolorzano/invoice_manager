@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} - {{ Auth::user()->name }}
                    <br>
                    <strong>{{ __('Your data:') }}</strong>
                    <br>
                    Email: {{ Auth::user()->email }}
                    <br>
                    Is admin?: 
                    @if (Auth::user()->is_admin)
						Yes
					@else
						No
					@endif
                    <br>
                    Is client?:
                    @if (Auth::user()->is_client)
						Yes
					@else
						No
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
