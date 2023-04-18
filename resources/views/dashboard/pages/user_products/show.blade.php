@extends('dashboard.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-1">
                    <div class="card" style="width: 18rem;">
                        <img style="width: 100px;height: 100px" src="{{asset('assets/website/images/product-8.jpg')}}" class="card-img-top" alt="...">
                        <div class="card-header">
                            <h5 class="card-title ">{{$product->name}}</h5>
                        </div>
                        <div class="card-body ">
                            <p class="card-text">Qty: {{$product->quantity}}</p>
                            <p class="card-text">${{number_format($product->price,2,',')}}</p>

                            <p class="card-text">Total: ${{number_format($product->quantity *$product->price,2,',') }}</p>

                        </div>
                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </section>
@endsection
