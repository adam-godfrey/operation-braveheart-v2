@extends('layouts.default')

@section('content')

@if($page->description)
    <header class="masthead news-banner">
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
            @if($news->count() > 0)
                @foreach($news as $article)
                    <article class="post-preview">
                        <a href="{{ route('news.show', $article->hashid) }}">
                            <h2 class="post-title">{{ $article->title }}</h2>
                            @if($article->subtitle)
                            <h3 class="post-subtitle">{{ $article->subtitle }}</h3>
                            @else
                            <h3 class="post-subtitle">{{ $article->excerpt }}</h3>
                            @endif
                        </a>
                        <p class="post-meta">Posted by
                            @if($article->author)
                            {{ $article->author }}
                            @else
                            David
                            @endif
                            on {{ $article->created_at->format('Y-m-d') }} &middot;
                        </p>
                    </article>
                    <hr>
                @endforeach

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
            @else
                <p>Now that's a first!! We have no news to show you.</p>
                <p>Never mind, come back later and hopefully we'll have something interesting for you.</p>
            @endif
        </div>
    </div>
</div>
@endsection