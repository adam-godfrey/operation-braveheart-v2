@extends('layouts.default')

@section('content')

@if($page->description)
    <header class="masthead" style="background-image: url('{{ asset('img/lottery.webp') }}'), radial-gradient(#fff,#fff);">
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
            <div id="fb-root"></div>
            <!-- Your embedded video player code -->
            <div class="fb-video" data-href="https://www.facebook.com/facebook/videos/{{ $video_id }}/" data-width="1000" data-show-text="false"></div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quisquam ut perspiciatis, repudiandae nulla animi iste vel, praesentium repellendus molestias aliquid consequatur, earum rem qui error voluptates eius enim consequuntur!</p>
            <h2 class="text-center">This month's winning numbers are...</h2>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('img/ball.png') }}" alt="Card image cap">
                        <div class="lottery-number">{{ $lottery->prize->first->number }}</div>
                        <div class="card-body text-center">
                            <h5 class="card-title">&pound;{{ $lottery->prize->first->prize }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $lottery->prize->first->winner }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('img/ball.png') }}" alt="Card image cap">
                        <div class="lottery-number">{{ $lottery->prize->second->number }}</div>
                        <div class="card-body text-center">
                            <h5 class="card-title">&pound;{{ $lottery->prize->second->prize }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $lottery->prize->second->winner }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('img/ball.png') }}" alt="Card image cap">
                        <div class="lottery-number">{{ $lottery->prize->third->number }}</div>
                        <div class="card-body text-center">
                            <h5 class="card-title">&pound;{{ $lottery->prize->third->prize }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $lottery->prize->third->winner }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quisquam ut perspiciatis, repudiandae nulla animi iste vel, praesentium repellendus molestias aliquid consequatur, earum rem qui error voluptates eius enim consequuntur!</p>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex alias, earum consectetur quia natus ducimus voluptate explicabo, hic porro reprehenderit, quasi? Tenetur ipsum distinctio laboriosam perspiciatis officiis dolore, architecto id.</p>

            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam inventore aspernatur repellendus incidunt adipisci modi voluptates recusandae iste eligendi, repudiandae corporis quod aut, optio! Explicabo quaerat unde voluptatem! Itaque, eum!</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <call-to-action 
                url="{{ route('lottery.index') }}" 
                class="cta cta-lottery">
            </call-to-action>
        </div>
    </div>
</div>
<div class="container-fluid fun">
    <div class="row">
        <div class="col mx-auto text-center">
            <img src="{{ asset('img/fun.webp') }}">
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
@endpush