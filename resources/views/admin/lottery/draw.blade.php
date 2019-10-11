@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Lottery</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed quisquam ut perspiciatis, repudiandae nulla animi iste vel, praesentium repellendus molestias aliquid consequatur, earum rem qui error voluptates eius enim consequuntur!</p>

<div class="row">
	<div class="col-md-6 mx-auto">
		<lottery-results colour="blue" draw_type="UK"></lottery-results>
	</div>
</div>
<div class="row">
	<div class="col-md-6 mx-auto">
		<lottery-results colour="green" draw_type="Local"></lottery-results>
	</div>
</div>

@endsection