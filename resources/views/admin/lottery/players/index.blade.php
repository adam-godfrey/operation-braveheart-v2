@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Lottery</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quisquam ut perspiciatis, repudiandae nulla animi iste vel, praesentium repellendus molestias aliquid consequatur, earum rem qui error voluptates eius enim consequuntur!</p>
<lottery-players v-bind:result="{{ $players }}"></lottery-players>
@endsection