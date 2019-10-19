@extends('layouts.default')

@section('content')

@if($page->description)
    <header class="masthead about-banner">
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
            <p>Operation Braveheart came into being following the death of my grandson Daniel Lee Coffey who was killed in action in Basra, Iraq on 27th February 2007, he was just 21 years old and he gave the ultimate sacrifice for his Country that he loved and for his army Brothers and Sisters who were also his own forces family.</p>

            <p>We are here to support and give love and comfort to our bereaved Forces families and our Forces Braveheart’s who have been injured in someway but it is an ongoing fight to be able to do this through the sheer scale of deaths of family loved ones and the amount of injuries so many have suffered in recent wars and conflicts since the end of Word War 2.</p>

            <p>Operation Braveheart also cares for and supports not only our bereaved families but also families in need of some help with loved ones who have been injured, in the great scheme of things I try to be all things to all people but sadly as much as I would like to Miracles are out of my range.</p>

            <p>What a time span has taken place between 2007 and now today {{ Carbon\Carbon::now()->format('Y') }} when on the day of Daniels Funeral I made that solemn vow and promise that, I his Granddad would keep, that as long as I am alive both he and his brothers and sisters of his Regiment the Rifles and all comrades throughout HM forces would be remembered, loved and cared for, and to the best of my abilities, age notwithstanding I have so far kept that promise.</p>

            <p class="mb-5">Today I have only two means of fundraising to support the very necessary work of this forces organisation which are our <a href="{{ route('shop.index') }}">Forces Support Shop</a> and our <a href="{{ route('lottery.index') }}">lottery social club</a>, these are the life blood that keeps our Forces Memorial Garden known as <a href="{{ route('memorial-garden.index') }}">THE SUNSET MEMORIAL GARDEN</a> going on into the future and the other work involving our injured Bravehearts.</p>
        </div>
    </div>
    <div id="fb-root"></div>
    <!-- Your embedded video player code -->
    <div class="fb-video" data-href="https://www.facebook.com/facebook/videos/10153231379946729/" data-width="500" data-show-text="false"></div>
</div>
@endsection