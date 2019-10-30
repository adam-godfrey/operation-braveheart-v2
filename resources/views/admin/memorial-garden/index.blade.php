@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Memorial Garden Dashboard</h1>
<hr>
<!-- Content Row -->
<div class="row">

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Plaque Orders</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $new }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-bell fa-2x text-gray-400"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-secondary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Awaiting Engraving</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $awaiting }}</div>
					</div>
					<div class="col-auto">
						<i class="far fa-handshake fa-2x text-gray-400"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">With Engraver</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $engraver }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-hammer fa-2x text-gray-400"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Completed Plaque Orders</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $complete }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-check fa-2x text-gray-400"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="card">
  			<div class="card-body">
	    		<h5 class="font-weight-bold text-greay-800">Plaque Orders</h5>
	    		<chart 
	    			type="doughnut"
	    			v-bind:width="500"
					v-bind:height="500"
					v-bind:labels="{{ json_encode($labels) }}"
					v-bind:datasets="{{ json_encode($datasets) }}"
					v-bind:options="{{ json_encode($options) }}">
	    		</chart>
	  		</div>
		</div>
	</div>
</div>
@endsection