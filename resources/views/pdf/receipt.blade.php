<div>
    <div style="float: left; width: 50%;">
        <h1 class="heading" style="font-size: 50px;">Receipt</h1>
		<p class="mb-1"><b>Operation Baveheart,</b></p>
		<p class="mt-0">HQ Support Shop,
        <br>22 Fore Street,
        <br>Culompton, Devon,
        <br>EX15 1JH</p>
    </div>

    <div style="float: right; width: 50%;">
        <img src="{{ asset('images/email-header.jpg') }}" style="width:50mm;float:right"/>
    </div>

    <div style="clear: both; margin: 10pt; padding: 0pt; "></div>

    <div style="float: left; width: 60%;">
    	<p class="heading h4 mb-1">Bill To</p>
		<p class="mt-0">{{$data->contact}}
		<br>{{$data->address1}}
		@if($data->address2)
		<br>{{$data->address2}}
		@endif
		@if($data->address3)
		<br>{{$data->address3}}
		@endif
        <br>{{$data->town}}, {{$data->county}}
        <br>{{$data->postcode}}</p>
    </div>

    <div style="float: right; width: 20%;">
        <p class="mt-10 mb-3 mr-2 text-right">{{$data->order->orderid}}</p>
		<p class="mt-2 mb-3 mr-2 text-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->order->created_at)->format('dS M Y')  }}</p>
		<p class="mt-2 mb-3 mr-2 text-right">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->order->created_at)->format('dS M Y')  }}</p>
    </div>

    <div style="float: right; width: 20%;">
        <p class="heading h4 mb-2">Receipt #</p>
		<p class="heading h4 mb-2 mt-0">Receipt Date</p>
		<p class="heading h4 mb-2 mt-0">Paid Date</p>
    </div>

    <div style="clear: both; margin: 0pt; padding: 0pt; "></div>

    <table>
		<thead class="thead-light">
			<tr>
				<th class="heading h4 text-center qty">QTY</th>
				<th class="heading h4 text-center description">DESCRIPTION</th>
				<th class="heading h4 text-right unit">UNIT PRICE</th>
				<th class="heading h4 text-right amount">AMOUNT</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-center qty">1</td>
				<td class="description">Operation Braveheart Memorial Garden Plaque</td>
				<td class="text-right unit">15.50</td>
				<td class="text-right amount">15.50</td>
			</tr>
			<tr>
				<td colspan="3" class="text-right unit">Subtotal</td>
				<td class="text-right amount">15.50</td>
			</tr>
			<tr>
				<td colspan="3" class="heading h4 text-right unit">TOTAL</td>
				<td class="heading h4 text-right amount">&pound;15.50</td>
			</tr>
			           
		</tbody>
	</table>
</div>

<!-- <div class="container-fluid">
	<div class="row">
		<div class="col-6">
			<h1>Receipt</h1>
			<p><b>Operation Baveheart</b></p>
			<p>HQ Support Shop
            <br>22 Fore Street
            <br>Culompton, Devon
            <br>EX15 1JH</p>
		</div>
		<div class="col-6">
			<img src="">
		</div>
	</div>
	<div>
		<div style="">

		</div>
	</div> -->
	<!-- <table class="table">
		<tbody class="tbody-light">
			<tr>
				<td class="col-6">
					<p class="heading">BILL TO</p>
					<p>fffffhfh</p>
					<p>fffffhfh</p>
					<p>fffffhfh</p>
					<p>fffffhfh</p>
					<p>fffffhfh</p>
				</td>
				<td class="col-3">
					<p style="marin-bottom: 30px;">RECEIPT #</p>
					<p>RECEIPT date</p>
				</td>

				<td class="col-3">
				</td>
			</tr>      
		</tbody>
	</table>
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th class="heading text-center col-2">QTY</th>
				<th class="heading text-center col-6">DESCRIPTION</th>
				<th class="heading text-right col-2">UNIT PRICE</th>
				<th class="heading text-right col-2">AMOUNT</th>
			</tr>
		</thead>
		<tbody class="tbody-light">
			<tr>
				<td class="text-center">1</td>
				<td>Operation Braveheart Memorial Garden Plaque</td>
				<td class="text-right">15.50</td>
				<td class="text-right">15.50</td>
			</tr>
			<tr>
				<td colspan="3" class="text-right">Subtotal</td>
				<td class="text-right">15.50</td>
			</tr>
			<tr>
				<td colspan="3" class="heading text-right">TOTAL</td>
				<td class="heading text-right">&pound;15.50</td>
			</tr>
			           
		</tbody>
	</table> -->
</div>