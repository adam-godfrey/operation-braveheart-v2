@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Lottery Dashboard</h1>
<hr>
<!-- Content Row -->
<div class="row">

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">UK Players</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $uk }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-user fa-2x text-gray-400"></i>
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
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Local Players</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $local }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-user fa-2x text-gray-400"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-dager text-uppercase mb-1">Inactive Players</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">{{ $inactive }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-user fa-2x text-gray-400"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="card">
		  	<div class="card-body">
				<h5 class="font-weight-bold text-grey-800">Payments</h5>
				<lottery-payments v-bind:result="{{ $players }}" v-bind:dates="{{ $dates }}"></lottery-payments>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="row">
			<div class="col-12">
				<div class="card">
		  			<div class="card-body">
			    		<h5 class="font-weight-bold text-grey-800">Income / Prizes</h5>
			    		<income-chart
			    			v-bind:width="500"
							v-bind:height="300"
							v-bind:labels="{{ json_encode($incomelabels) }}"
							v-bind:datasets="{{ json_encode($incomedatasets) }}"
							v-bind:options="{{ json_encode($incomeoptions) }}">
			    		</income-chart>
			  		</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card">
		  			<div class="card-body">
			    		<h5 class="font-weight-bold text-grey-800">Players</h5>
			    		<chart
			    			type="doughnut"
			    			v-bind:width="500"
							v-bind:height="300"
							v-bind:labels="{{ json_encode($playerlabels) }}"
							v-bind:datasets="{{ json_encode($playerdatasets) }}"
							v-bind:options="{{ json_encode($playeroptions) }}">
			    		</chart>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection