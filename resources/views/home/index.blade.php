@extends('layouts.default')

@push('scripts')
<script src="{{ asset('js/index.js') }}" async></script>
@endpush

@section('content')

@if($page->description)
    <header class="masthead rifles-banner">
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
            <h1 class="h1">Welcome to {{ Config::get('app.name') }}</h1>

            <p>This website is the online voice of forces support organisation Operation Braveheart of Cullompton, Devon.</p>

            <p>It is now quite hard to remember the many things that took place all those early years ago as I set out on the long journey of fundraising to where I and we are today, with a beautiful dedicated Armed Forces Memorial Garden to all of our forces who have given the ultimate sacrifice in wars and conflicts since the end of Word War 2.</p>

            <p>A steep learning curve ensued from doing those little things that mean a lot like organising Prize draws, holding discos and even a dinner dance to start this huge project going.</p>

            <p>Among the things that will always be remembered as fundraising events got under our belts, and you may wonder why I just wrote under OUR belts because this was something I was to learn was that with all of my own good intentions I just could not complete such a mammoth task of forces support just on my own.</p>

            <p>One of the events I will just highlight here which grew from just a few wild thoughts was the formation of Operation Braveheart’s very own charity football team. From fundraising matches back in the early years of 2008 to 2010 this football team quickly became an official football club which is known now as BRAVEHEARTS FC and is run under its own steam headed up by Niki Lush and his team. No longer a charity team but now league clubs that play in Devon and Somerset leagues.</p>

            <p class="text-center"><a href="{{ route('about.index') }}" class="btn btn-outline-primary">About Us</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <article class="post-preview">
                <a href="{{ route('news.show', $news->hashid) }}">
                    <h2 class="h2 post-title">{{ $news->title }}</h2>
                    <h3 class="h3 post-subtitle">{{ $news->subtitle }}</h3>
                </a>
                <p class="post-meta">Posted by David on {{ $news->created_at->format('d M Y') }} · <span class="reading-time" title="Estimated read time">4 mins read </span></p>
            </article>
            <p class="text-center">
                <a href="{{ route('news.show', $news->hashid) }}" class="btn btn-outline-primary">Read More</a>
                <a href="{{ route('news.index') }}" class="btn btn-outline-primary">Latest News</a>
            </p>
        </div>
    </div>
</div>
<newsletter-form></newsletter-form>

@endsection