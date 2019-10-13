@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Lottery</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quisquam ut perspiciatis, repudiandae nulla animi iste vel, praesentium repellendus molestias aliquid consequatur, earum rem qui error voluptates eius enim consequuntur!</p>

<lottery-results colour="{{ $color }}" draw_type="{{ $draw_type }}" draw_date="{{ $draw_date }}" v-bind:settings="{{ json_encode($settings) }}" v-bind:winners="{{ json_encode($winners) }}">></lottery-results>
@endsection