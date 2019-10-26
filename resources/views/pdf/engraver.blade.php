<div>
 	<div style="float: left; width: 70%;">
        <h1 class="heading" style="font-size: 24px;">FAMILY MEMORIAL PLAQUE DETAILS.</h1>
        <h2 style="font-size: 16px;">Reference: {{$data->order->orderid}}</h2>
        <h2 style="font-size: 16px;">Date: {{\Carbon\Carbon::now()->format('dS M Y')}}</h2>
    </div>

    <div style="float: right; width: 30%;">
        <img src="{{ asset('images/email-header.jpg') }}" style="width:50mm;float:right"/>
    </div>
    <hr>
</div>
<h3>Engraving Details</h3>
<div>
	<div style="float: left; width: 25%;">
		<p>Rank</p>
    </div>
    <div style="float: left; width: 50%;">
       	<p class="bordered">{{$data->rank}}</p>
    </div>
</div>
<div>
	<div style="float: left; width: 25%;">
		<p>Loved One's Name</p>
    </div>
    <div style="float: left; width: 50%;">
       	<p class="bordered">{{$data->name}}</p>
    </div>
</div>
<div>
	<div style="float: left; width: 25%;">
		<p>Date of Bith</p>
    </div>
    <div style="float: left; width: 50%;">
       	<p class="bordered">{{$data->dob}}</p>
    </div>
</div>
<div>
	<div style="float: left; width: 25%;">
		<p>Date of Death</p>
    </div>
    <div style="float: left; width: 50%;">
       	<p class="bordered">{{$data->dod}}</p>
    </div>
</div>
<div>
	<div style="float: left; width: 25%;">
		<p>Regiment</p>
    </div>
    <div style="float: left; width: 50%;">
       	<p class="bordered">{{$data->regiment}}</p>
    </div>
</div>
<div>
	<div style="float: left; width: 25%;">
		<p>Where it took place</p>
    </div>
    <div style="float: left; width: 50%;">
       	<p class="bordered">{{$data->location}}</p>
    </div>
</div>
<div>
	<div style="float: left; width: 25%;">
		<p>Message</p>
    </div>
    <div style="float: left; width: 50%;">
       	<p class="bordered">{{$data->message}}</p>
    </div>
</div>
<h3>Instructions</h3>
<div id="instructions">
	<div>
		<div style="float: left; width: 25%;">
			<p>Line 1</p>
	    </div>
	    <div style="float: left; width: 50%;">
	       	<p>Rank and Name</p>
	    </div>
	</div>
	<div>
		<div style="float: left; width: 25%;">
			<p>Line 2</p>
	    </div>
	    <div style="float: left; width: 50%;">
	       	<p>Date of Birth and Date of Death</p>
	    </div>
	</div>
	<div>
		<div style="float: left; width: 25%;">
			<p>Line 3</p>
	    </div>
	    <div style="float: left; width: 50%;">
	       	<p>Regimemt</p>
	    </div>
	</div>
	<div>
		<div style="float: left; width: 25%;">
			<p>Line 4</p>
	    </div>
	    <div style="float: left; width: 50%;">
	       	<p>Location of Death</p>
	    </div>
	</div>
	<div>
		<div style="float: left; width: 25%;">
			<p>LIne 5</p>
	    </div>
	    <div style="float: left; width: 50%;">
	       	<p>Personal Message</p>
	    </div>
	</div>
</div>
<h3>Preview</h3>
<div id="plaque">
	<div style="float: left; width: 49%;">
		<p class="text-right">{{$data->rank}}</p>
		<p class="text-right">DOB {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->dob)->format('d/m/Y')  }}</p> 
    </div>
    <div style="float: right; width: 49%;">
       	<p>{{$data->name}}</p>
		<p>DOD {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->dod)->format('d/m/Y')  }}</p> 
    </div>
    <div style="clear: both;"></div>
    <p class="text-center">{{$data->regiment}}</p>
	<p class="text-center">{{$data->location}}</p>
	<p class="text-center">{{$data->message}}</p>
</div>
<div id="footer">
	<p class="text-center">
		Operation Baveheart, HQ Support Shop, 22 Fore Street, Culompton, Devon, EX15 1JH
	</p>
</div>