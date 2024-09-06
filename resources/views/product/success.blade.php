@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">                
                <div class="card-body">
                    <div class="text-center">
                        <h3 class="mt-3">Your payment done successfully.</h3>
                        <p><a href={{ route('home') }}>Continue Shopping</a></p>
                    </div>                                               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
