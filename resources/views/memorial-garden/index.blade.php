@extends('layouts.default')

@push('head')
<link rel="preload" onload="this.rel = 'stylesheet'" as="style" href='https://fonts.googleapis.com/css?family=Satisfy&display=swap'>
@endpush

@push('scripts')
<script src="{{ asset('js/memorial-garden.js') }}" async></script>
@endpush

@section('content')

@if($page->description)
    <header class="masthead memorial-banner">
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
            <p>Welcome to the SUNSET MEMORIAL GARDEN the restful place to come to where you can sit, relax and remember someone you miss and love. Though this is an Armed Forces Memorial Garden the gate is an open invitation to you to come in and rest awhile to if you feel lonely or just want to close your eyes in thought.</p>

            <p>The Memorial Garden is dedicated to the memory of RFN Daniel Lee Coffey a son of this town of Cullompton, dearly missed by his loving family and his Grandad, and we also remember all of his Brothers and Sisters in arms who gave the ultimate sacrifice in Iraq and Afghanistan from his regiment 'The Rifles' and all other Regiments.</p>

            <p>We remember also all our Braveheart's who have given that same sacrifice in wars and conflicts since the end of WW2.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <carousel></carousel>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>We also respectfully remember in these recent years when this country has faced mindless acts of terrorism where many hundreds of innocent members of the public have become victims of these mindless acts of cowardice that have taken place in our major cities around the country. My heart breaks for these families and especially the children and families of Manchester in the Manchester arena, NO ONE can justify this terrible carnage that took place there.</p>

            <p>If you have lost loved ones in such circumstances then please get in touch with me here as I would love to give you this beautiful garden where you can place a plaque so that others may share in your loss and sorrow.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 col-md-7 mx-auto">
            <call-to-action 
                url="{{ route('memorial-garden.add') }}"
                class="cta cta-memorial"
                html="<h3>Want a fallen Hero remembered?</h3><p>If you would like someone remembered in the memorial garden, please click here and complete the form</p>">
            </call-to-action>
        </div>
    </div>
</div>
@endsection