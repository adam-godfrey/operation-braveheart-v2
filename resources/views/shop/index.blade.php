@extends('layouts.default')

@push('scripts')
<script src="{{ asset('js/shop.js') }}" defer></script>
@endpush

@section('content')

@if($page->description)
    <header class="masthead shop-banner">
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
            <p>Welcome to Braveheart HQ Support shop for our Forces. Our shop is the artery that supplies much of the blood that flows through the veins of Operation Braveheart. We depend on the shop to help to provide much of the funds that are needed to support our Forces support work, especially for our Bereaved <a href="{{ route('memorial-garden.index') }}">Families Memorial Garden</a>.

            <p>We depend entirely on the generosity and kindness of the public, family and friends of Operation Braveheart to give us donations which we can sell in our shop and of course we also need customers and visitors to the shop too to come in and say hello and hopefully buy our items to raise those funds to keep Operation Braveheartheading's work alive.</p>

            <p>We can accept most things which are in good condition like householdware, CDs, DVDs, computer games, game consoles and small electrical items but must be in good working order.</p>

            <p>Our shop is....how can I put it? SMALL and compact and I don't like to turn things away but for me here, size is as they say a problem but having said that we do our best to accept most things including clothes and shoes if they are in good condition.</p>

            <p>To help with our shop space problem, I have now taken on a storage unit where we will be able to keep some of our donated stock items in but it's an additional cost to what we have to bear before we can get into a position to be able to say we are making a profit.</p> 

            <p>But my friends, I am thankful for those small mercies that come our way to support our forces and my bereaved forces <a href="{{ route('memorial-garden.index') }}">Families Memorial Garden</a>.</p>

            <p class="mb-5">I thank you in advance if you can support the shop and become a beloved member of our forces Braveheart Family.</p>

        </div>
    </div>
</div>
@endsection