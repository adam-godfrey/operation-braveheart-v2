@extends('layouts.default')

@push('scripts')
<script src="{{ asset('js/lottery.js') }}" async></script>
<script>
    function init() {
    var imgDefer = document.getElementsByTagName('img');
    for (var i=0; i<imgDefer.length; i++) {
    if(imgDefer[i].getAttribute('data-src')) {
    imgDefer[i].setAttribute('src',imgDefer[i].getAttribute('data-src'));
    } } }
    window.onload = init;
</script>
@endpush

@section('content')

@if($page->description)
    <header class="masthead lottery-banner">
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
            <p>Welcome to Operation Braveheart social club lottery page, here is where you can sign up and join in the fun of our fundraising lottery to help to fund the Memorial Garden's future and ongoing upkeep and our other forces projects that we need to keep funded.</p>

            <p>We have two lotteries run under the same rules for both. One is a local Cullompton area draw and the other is for our UK Braveheart family.</p>

            <p>They are monthly draws and they are drawn as close as possible to the end of the month.</p>
            <h3 class="h3 text-uppercase text-center mb-3">This month's UK winning numbers are...</h3>

            <div class="row">
                @foreach($lottery->UK as $draw)
                    <div class="col-6 col-sm-4">
                        <div class="card lottery">
                            <img class="card-img-top" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{{ asset('images/ball-blue-' . $draw->image . '.jpg') }}" alt="Lottery prize winner">
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

            <h3 class="h3 text-uppercase text-center mb-3">This month's Local winning numbers are...</h3>
            <div class="row">
                @foreach($lottery->Local as $draw)
                    <div class="col-6 col-sm-{{ count($lottery->Local) == 3 ? '4' : '3' }}">
                        <div class="card lottery">
                            <img class="card-img-top" src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="{{ asset('images/ball-green-' . $draw->image . '.jpg') }}" alt="Lottery prize winner">
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
            <p>The draws are videoed from the <a href="{{ route('shop.index') }}">shop</a> and they are then uploaded to FACEBOOK for you to see and who the winners are.</p>

            <p>A random number generator is used to select the winning numbers which are then entered into our system to find the name of the winner.</p> 

            <p>Local winners are also notified by posters placed in the <a href="{{ route('shop.index') }}">Braveheart HQ shop</a> windows.</p>

        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <call-to-action 
                url="{{ route('lottery.join') }}" 
                class="cta cta-lottery"
                html="<span>JOIN TODAY</span>">
            </call-to-action>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
             <p>You can join in either of our lotteries by clicking the link to the registration form above, <a href="{{ route('contact.index') }}">sending us a message</a>, contact us on Facebook or <a href="mailto:david&#64;operation-braveheart.org.uk">email us!</a></p>
        </div>
    </div>
</div>
<div class="container-fluid fun">
    <div class="row">
        <div class="col mx-auto text-center">
            <img srcset="{{ asset('images/600/fun.png') }} 320w, 
                         {{ asset('images/600/fun.png') }} 480w, 
                         {{ asset('images/1440/fun.png') }} 800w"
                 sizes="(max-width: 320px) 300px, (max-width: 480px) 440px, 800px"
                 src="{{ asset('images/1980/png.jpg') }}" alt="When the fun stops, STOP">
        </div>
    </div>
</div>
@endsection