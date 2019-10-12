@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Edit Lottery Player</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quisquam ut perspiciatis, repudiandae nulla animi iste vel, praesentium repellendus molestias aliquid consequatur, earum rem qui error voluptates eius enim consequuntur!</p>
<div class="row justify-content-start">
	<div class="col-md-8">
		<lottery-player v-bind:result="{{ $player }}" action="edit"></lottery-player>
	</div>
</div>
@endsection