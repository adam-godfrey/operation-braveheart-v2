@extends('layouts.default')

@push('scripts')
<script src="{{ asset('js/news.js') }}" async></script>
@endpush

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
            <div class="news-item">
                <h2 class="h2 post-title">{{ $item->title }}</h2>
                <h3 class="h3 post-subtitle">{{ $item->subtitle }}</h3>
                <p class="post-meta">Posted by David on {{ $item->created_at->format('d M Y') }} · <span class="reading-time" title="Estimated read time">4 mins read </span></p>
                <hr>
                <p>{!! nl2br($item->content) !!}</p>
            </div>

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