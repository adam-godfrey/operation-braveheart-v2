@extends('layouts.default')

@section('content')

@if($page->description)
    <header class="masthead" style="background-image: url('{{ asset('images/lottery.webp') }}'), radial-gradient(#fff,#fff);">
@else
    <header class="masthead">
@endif
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>{{ $page->title }}</h1>
                    @if($page->description)
                    <span class="subheading">{{ $page->description }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quisquam ut perspiciatis, repudiandae nulla animi iste vel, praesentium repellendus molestias aliquid consequatur, earum rem qui error voluptates eius enim consequuntur!</p>
        </div>
        <div class="col-lg-5 col-md-8 mx-auto">
            <payment-form></payment-form>
        </div>
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quisquam ut perspiciatis, repudiandae nulla animi iste vel, praesentium repellendus molestias aliquid consequatur, earum rem qui error voluptates eius enim consequuntur!</p>
        </div>
    </div>
</div>
<div class="container-fluid fun">
    <div class="row">
        <div class="col mx-auto text-center">
            <img src="{{ asset('images/fun.webp') }}">
        </div>
    </div>
</div>
@endsection