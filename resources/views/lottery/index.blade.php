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
    <!-- <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <video width="100%" controls ref="video">
                <source src="/api/stream-video" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
        </div>
    </div> -->
    <div class="row mt-3">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Welcome to Operation Braveheart social club lottery page, here is where you can sign up and join in the fun of our fundraising lottery to help to fund the Memorial Gardens future and ongoing upkeep and our other forces projects that we need to keep funded.</p>

            <p>We have two lotteries run under the same rules for both. One is a local Cullompton area draw and the other is for our UK Braveheart family.</p>

            <p>They are monthly draws and they are drawn as close as possible to the end of the month.</p>
            <h3 class="text-uppercase text-center mb-3">This month's UK winning numbers are...</h3>
            <div class="row">
                @foreach($lottery->UK as $draw)
                    <div class="col">
                        <div class="card lottery">
                            <img class="card-img-top" src="{{ asset('images/ball-blue.png') }}" alt="Card image cap">
                            <div class="lottery-number balls-{{ count($lottery->UK) }}">{{ $draw->number }}</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">&pound;{{ $draw->prize }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $draw->winner }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Each number costs &pound2.00 per month. There are no restrictions as to how many numbers you can hold in your name, the more numbers you have, the greater the chance of winning prizes.

            <h3 class="text-uppercase text-center mb-3">This month's Local winning numbers are...</h3>
            <div class="row">
                @foreach($lottery->Local as $draw)
                    <div class="col">
                        <div class="card lottery">
                            <img class="card-img-top" src="{{ asset('images/ball-green.png') }}" alt="Card image cap">
                            <div class="lottery-number balls-{{ count($lottery->Local) }}">{{ $draw->number }}</div>
                            <div class="card-body text-center">
                                <h5 class="card-title">&pound;{{ $draw->prize }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $draw->winner }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>The draws are videoed from the <a href="{{ route('shop.index') }}">shop</a> and they are then uploaded to FACEBOOK for you to see the draws are done and who the winners are.</p>

            <p>A random number generator is used to select the winning numbers which are then entered into our system to find the winning number and name of the winner.</p> 

            <p>Local winners are also notified by posters placed in the <a href="{{ route('shop.index') }}">Braveheart HQ shop</a> windows.</p>

        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <call-to-action 
                url="{{ route('lottery.payment') }}" 
                class="cta cta-lottery"
                html="<span>JOIN TODAY</span>">
            </call-to-action>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
             <p>You can join in either of our lotteries by clicking the link to the registration form here or <a href="{{ route('contact.index') }}">contact us</a> on Facebook or email to <a href="mailto:david&#64;operation-braveheart.org.uk">Email Us!</a></p>
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

@push('scripts')
<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
@endpush