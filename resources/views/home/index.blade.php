@extends('layouts.default')

@section('content')

@if($page->description)
    <header class="masthead" style="background-image: url({{ asset('img/rifles.jpg') }})">
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
            <h1>Welcome to {{ Config::get('app.name') }}</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quisquam ut perspiciatis, repudiandae nulla animi iste vel, praesentium repellendus molestias aliquid consequatur, earum rem qui error voluptates eius enim consequuntur!</p>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex alias, earum consectetur quia natus ducimus voluptate explicabo, hic porro reprehenderit, quasi? Tenetur ipsum distinctio laboriosam perspiciatis officiis dolore, architecto id.</p>

            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam inventore aspernatur repellendus incidunt adipisci modi voluptates recusandae iste eligendi, repudiandae corporis quod aut, optio! Explicabo quaerat unde voluptatem! Itaque, eum!</p>

            <p class="text-center"><a href="{{ route('about.index') }}" class="btn btn-outline-primary">About Us</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <article class="post-preview">
                <a href="/startbootstrap-clean-blog-jekyll/2017/10/31/man-must-explore.html">
                    <h2 class="post-title">Man must explore, and this is exploration at its greatest</h2>

                    <h3 class="post-subtitle">Problems look mighty small from 150 miles up</h3>

                </a>
                <p class="post-meta">Posted by

                    Start Bootstrap

                    on
                    October 31, 2017 · <span class="reading-time" title="Estimated read time">

   4 mins  read </span>

                </p>
            </article>
        </div>
    </div>
</div>
<newsletter-form></newsletter-form>

@endsection