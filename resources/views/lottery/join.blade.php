@extends('layouts.default')

@push('scripts')
<script src="{{ asset('js/lottery-form.js') }}" defer></script>
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
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>If you would like to join the Operation Braveheart Social Club Lottery, please complete the form below. Don't forget to choose which lottery you want to join.</p>
            <p>After you have registered, you will be allocated a lottery number which doesn't change. David will then contact you about setting up your payment subscription. You can also opt out any time by <a href="{{ route('contact.index') }}">contacting us</a></p>
            
        </div>
        <div class="col-lg-8 col-md-10 mx-auto">
            <lottery-form></lottery-form>
        </div>
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>This is a monthly subscription payment, you can pay by direct debit or standing order and payment can also be made by a quarterly or half yearly or a full yearly subscription, whichever suits you best.</p>
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
                 src="{{ asset('images/1980/fun.png') }}" alt="When the fun stops, STOP">
        </div>
    </div>
</div>
@endsection