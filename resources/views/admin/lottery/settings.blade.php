@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Lottery Settings</h1>
<hr>
<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
    	<h2 class="h3 mb-3 text-gray-800">Settings</h2>
    	<lottery-settings :settings="{{ json_encode($settings) }}"></lottery-settings>
	</div>
</div>

<div class="row">
	<div class="col-lg-8 col-md-10 mx-auto">
		<h2 class="h3 mb-3 text-gray-800">Lottery Video</h2>
		<file-upload />
	</div>
</div>
@endsection