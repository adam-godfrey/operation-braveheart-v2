@extends('layouts.default')

@push('scripts')
<script src="{{ asset('js/require.js 2.3.6.js') }}"></script>
<script src="{{ asset('js/require.config.js') }}"></script>
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
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <p>My heart goes out to you if you are bereaved family member reading this and would like to have your loved one remembered here in this lovely restful Memorial Garden and I know so well how you must be feeling and I will help you with filling in this form.</p>

            <p>If you would like a loved one remembered in our Memorial Garden, you can order a plaque here.</p>

            <p class="mb-5">In this section please fill in your contact details for me, your name, address, post code, email address and a contact telephone number.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            
            <memorial-form></memorial-form>
                    
            <p>Here you will see a representation of the actual plaque. The design size of the plaque is such that there is only a certain amount of characters you can have for your message.</p>
            
            <plaque-form></plaque-form>
            
            <p class="mb-5">IF YOU HAVE ANY PROBLEMS WITH FILLING IN THE FORM PLEASE <a href="{{ route('contact.index') }}">CONTACT ME</a></p>

            <p>This is the final part for you to fill in which is the payment of your donation. The stainless steel plaque itself IS FREE all I ask for is a donation of &pound;16.00 to cover the cost of engraving.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 col-md-8 mx-auto">
            
            <payment-form cost="16.00"></payment-form>

            <p>Thank you for helping to remember the fallen</p>
        </div>
    </div>

</div>
@endsection