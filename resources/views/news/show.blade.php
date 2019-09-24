@extends('layouts.default')

@section('content')

@if($page->description)
    <header class="masthead" style="background-image: url('{{ asset('img/news.webp') }}')">
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
            
            {!! $item->content !!}    

            <!-- Pager -->
            @if($news->total() > 0)
                <div class="clearfix">

                    @if($news->previousPageUrl() != null)
                        <a class="btn btn-primary float-left" href="{{ $news->previousPageUrl() }}">&larr; Newer<span class="d-none d-md-inline"> Posts</span></a>
                    @endif

                    @if($news->nextPageUrl() != null)
                        <a class="btn btn-primary float-right" href="{{ $news->nextPageUrl() }}">Older<span class="d-none d-md-inline"> Posts</span> &rarr;</a>
                    @endif

                </div>
            @endif

            </div>
            
        </div>
    </div>
</div>
@endsection