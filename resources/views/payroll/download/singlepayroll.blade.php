<@php
	use Carbon\Carbon;
	$current_date_time = Carbon::now()->toDateString(); 
@endphp
<html>
<head>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
	.right-section{
		/* display:flex;
		justify-content:flex-end; */
		float:right;
	}
		.top-section{
			/* display:flex; */
			justify-content:space-between;
		}
		.table-line{
			border-bottom: 1px solid black;
			height: 1px;
		}
		.below-section{
			display:flex;
		}
		.signature{
			float:left;
		}
		.sub-foot{
			float:right;
		}
		.emptybox{
			padding:50px 0px;
		}
		.footer{
			bottom:10px;
			text-align:center;
			border-top: 1px solid black;
		}
</style>
</head>
<body style="background-color:#ffffff">
	<div class="container" style="background-color:#ffffff">
		<div class="box" style="background-color:#ffffff">
			<h1 class="page-header"><img width="120" src="D:\xampp\htdocs\Employee-Payroll-with-laravel-framework\resources\views\payroll\download\logo.png" alt="logo"></h1>

			<div class="right-section">
				<p><b>Pay period: </b>{{$payroll->from}}<b> to </b>{{$payroll->to }}</p>
				<p><b>Date of payment</b> : {{$current_date_time}} </span></p>
			</div>

		<div class="top-section">
		<address id="address-header">
				<p><b>Employee ID</b> : {{$payroll->employee_id}}</p>
				<p><b>Employee's name</b> : {{ $payroll->employee->name }}</p>
				<p><b>Employee's status</b> : Full time</p>

			</address>

		</div>

			<hr>
			<p><b>Department: </b> {{ $payroll->employee->role->department->name }}</p>
			<p><b>Role: </b> HR/Software developer </p>
			<!-- <p>{{ $payroll->employee->role->name }}</p> -->

			@if($payroll->employee->full_time)
				<p><b>Full-Time</b> :  Yes</p>
				<p><b>Base Salary</b>: {{ $payroll->employee->role->salary }}</p>
			@else
				<p><b>Part-Time</b> : Yes</p>
				<p><b>Base Salary</b>: 0</p>
			@endif
			<hr>




			<table style= "width:100%">
				<thead>
					<tr>
            <th></th>
						<th>Hours</th>
						<th>Rate</th>
						<th>Gross</th>
					</tr>

					<tr>
						<th>Income Description</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>

				</thead>

				<tbody>

					<tr>

						<td>Basic Salary </td>
						<td>{{ $payroll->hours }}hrs</td>
						<td>Rs. {{ $payroll->rate }}</td>
						<td>Rs. {{ $payroll->gross }}</td>
						
					</tr>

					<tr>
						<th>Bonus</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<?php for($i = 0; $i < count($bonus); $i++){ ?>
						<tr>
							<td>{{$bonus[$i]->label}} </td>
							<td>-</td>
							<td>-</td>
							<td>Rs. {{ $bonus[$i]->value}} </td>
						</tr>
					<?php } ?>
					
					<tr>
						<th>Deduction</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<?php for($i = 0; $i < count($deductions); $i++){ ?>
					<tr>
						<td>{{$deductions[$i]->label}}</td>
						<td>-</td>
						<td>-</td>
						<td>Rs. {{ $deductions[$i]->value}}</td>
					</tr>
					<?php } ?>
          <tr>
            <td style="color:#ffffff;">.</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td style="color:#ffffff;">.</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            
				</tbody>
			</table>

      <hr>
      <div><b>Total</b></div>
      <div class="sub-foot" style="margin-right:70px;margin-top:-20px"><b>Rs. </b> {{ $payroll->net }}</div>
      <br>
		</div>
		<br><br>
		<div class="below-sec">
		<div class="signature">
			<p>Employee's signature</p>
			<p style="margin-top:45px">____________________</p>
		</div>
		<div class="sub-foot">
			<p><b>Date</b> : {{$current_date_time}}</p>
			<p><b>Place</b> : Bangalore</p>
		</div>
		</div>
	</div>
	<script>
		n = new Date();
		y = n.getFullYear();
		m = n.getMonth() + 1;
		d = n.getDate();
		document.getElementById("dop").innerHTML = y + "-" + m + "-" + d;
	</script>
	<script src="{{ asset('js/app.js')}}"></script>
</body>
</html>
