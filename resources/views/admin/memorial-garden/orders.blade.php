@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Memorial Garden - Plaque Orders</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quisquam ut perspiciatis, repudiandae nulla animi iste vel, praesentium repellendus molestias aliquid consequatur, earum rem qui error voluptates eius enim consequuntur!</p>
<plaque-orders v-bind:result="{{ $orders }}" />
@endsection