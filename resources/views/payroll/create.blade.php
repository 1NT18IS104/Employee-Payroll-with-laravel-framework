@extends('layouts.app')
<style>
		button.add {
			font-weight: bold;
			border-radius:50px;
			font: message-box;
		}
		#endDate{
			text-align: left;
			padding: 7px 0px 0px 0px;
			width: 40px;
		}
		div.date{
			width: 178px;
		}
</style>

@section('content')
	<div class="col-lg-12">
		<h1 class="page-header">Payroll : {{ $employee->name }}</h1>
	</div>
	@if($employee->full_time)
		<p><b>Full-Time</b> :  Yes</p>
		<p><b>Base Salary</b>: {{ $employee->role->salary }}</p>
	@else
		<p><b>Part-Time<b> : Yes</p>
		<br>
		<p><b>Base Salary<b>: 0</p>
	@endif
	
	<form action="{{ route('payrolls.store',['id'=>$employee->id])}}" method="POST"
		class="form-horizontal">
			{{ csrf_field() }}

		<div class="form-group">
			<label class="control-label col-xs-12 col-md-1">Start: </label>
			<div class="col-xs-12 col-md-2 date">
				<input type="date" name="from" class="form-control">
			</div>
			<label class="control-label col-xs-12 col-md-1" id='endDate'>End: </label>
			<div class="col-xs-12 col-md-2 date">
				<input type="date" name="to" class="form-control">		
			</div>
			
		</div>
		
		<div class="form-group">
			<label class="control-label col-md-1" for="over_time">Overtime:</label>
			<div class="col-md-4">
				<select name="over_time" id="over_time" class="form-control">
					<option value="1">Yes</option>
					<option value="0">No</option>					
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-md-1" for="hours">Hours: </label>
			<div class="col-md-4">					
				<input type="number" name="hours" class="form-control">		
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-md-1" for="rate">Rate: </label>
			<div class="col-md-4">
				<input type="number" name="rate" class="form-control">	
			</div>
		</div>	
		
		<div class="form-group" id="variant-bonus">
			<div>
				<label class="control-label col-xs-12 col-md-1">Bonus: </label>
				<div class="col-xs-5 col-md-2">
					<input type="text" name="bonus_label[]" class="form-control">
				</div>
				<div class="col-xs-5 col-md-2">
					<input type="number" name="bonus_value[]" class="form-control">		
				</div>
			</div>
			<div class="col-xs-1 col-md-1">
				<button id="bonus_but" class="btn btn-primary add" type="button" onClick="addBonusVariant()" >+</button>		
			</div>
			<div id="empty1" class="col-md-1"></div>
		</div>

		<div class="form-group" id="variant-deduction">
			<div>
				<label class="control-label col-xs-12 col-md-1" for="deduction">Deduction: </label>
				<div class="col-xs-5 col-md-2">
					<input type="text" name="deduction_label[]" class="form-control">		
				</div>
				<div class="col-xs-5 col-md-2">
					<input type="number" name="deduction_value[]" class="form-control">		
				</div>
			</div>
			<div class="col-xs-1 col-md-1 ">
				<button class="btn btn-primary add" type="button" onClick="addDeductionVariant()">+</button>		
			</div>
			<div id="empty2" class="col-md-1"></div>
		</div>
		
		<div class="col-xs-9 col-lg-6 text-center">
			<button class="btn btn-success" type="submit" >Submit</button>
		</div>
	</form> 

@endsection

<script type="text/javascript">
	function addBonusVariant()
	{
		var parent = document.getElementById('variant-bonus');
		var container= document.getElementById('empty1');
		var div= document.createElement('div');
		div.innerHTML +='<br><br><label class="control-label col-xs-12 col-md-1">Bonus: </label><div class="col-xs-5 col-md-2"><input type="text" name="bonus_label[]" class="form-control"></div><div class="col-xs-5 col-md-2"><input type="number" name="bonus_value[]" class="form-control"></div>';
		parent.insertBefore(div,container);

	}
	function addDeductionVariant()
	{
		var parent = document.getElementById('variant-deduction');
		var container= document.getElementById('empty2');
		var div= document.createElement('div');
		div.innerHTML +='<br><br><label class="control-label col-xs-12 col-md-1" for="deduction">Deduction: </label><div class="col-xs-5 col-md-2"><input type="text" name="deduction_label[]" class="form-control"></div><div class="col-xs-5 col-md-2"><input type="number" name="deduction_value[]" class="form-control"></div>';
		parent.insertBefore(div,container);

	}
</script>

