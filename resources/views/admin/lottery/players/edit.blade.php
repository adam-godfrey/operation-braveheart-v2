@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Update Lottery Player</h1>
<hr>

<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
    	<lottery-player v-bind:result="{{ $player }}" action="edit"></lottery-player>
	</div>
</div>
@endsection