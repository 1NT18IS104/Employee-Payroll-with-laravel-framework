<?php

namespace App\Http\Controllers;

use App\Payroll;
use App\Employee;
use App\Role;
use App\Addon;
use Session;
use Paginate;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id){
        $employee = Employee::findOrFail($id);
		return view('payroll.create')->with('employee',$employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id){

	   $this->validate($request,[
			'hours'=> 'required',
			'rate'=>'required',
			'over_time' => 'required|bool'
		]);
		
	    $payroll = Payroll::create([
      'from' => $request->from,
      'to' => $request->to,
			'hours' => $request->hours,
			'rate' => $request->rate,
			'over_time' => $request->over_time,
			'employee_id' => $id,
		]);
		

		$gross = $payroll->grossPay();
		$payroll->save();
    
    $bonus_label = $request->bonus_label;
    $bonus_value = $request->bonus_value;
    $deduction_label = $request->deduction_label;
    $deduction_value = $request->deduction_value;
    $bonus=0;
    $deduction=0;

    for($i = 0; $i < count($bonus_label); $i++) {
      $addon = Addon::create([
          'label' => $bonus_label[$i],
          'value' => $bonus_value[$i],
          'type' => 'b',
          'payroll_id' => $payroll->id,
      ]);
      $bonus+=$bonus_value[$i];
    }

    for($i = 0; $i < count($deduction_label); $i++) {

      $addon = Addon::create([
          'label' => $deduction_label[$i],
          'value' => $deduction_value[$i],
          'type' => 'd',
          'payroll_id' => $payroll->id,
      ]);
      $deduction+=$deduction_value[$i];
    }
    $addon->save();
    
    $payroll->netPay($bonus, $deduction);
    $payroll->save();

		Session::flash('success', 'Payroll Created');
		return redirect()->route('payrolls.show',['id'=>$id]);	
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payrollIndex($id){
		$employee = Employee::findOrFail($id);
        return view('payroll.payroll')->with('employee',$employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $payroll = Payroll::findOrFail($id);
		return view('payroll.edit')->with('payroll',$payroll);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
			'hours'=> 'required',
			'rate'=>'required',
			'over_time' => 'required|bool'
		]);
		
		$payroll = Payroll::findOrFail($id);
		$payroll->hours = $request->hours;
		$payroll->rate= $request->rate;
		$payroll->over_time = $request->over_time;
		$payroll->save();		
		
		$payroll->grossPay();
		$payroll->save();
    
		
		Session::flash('success', 'Payroll Updated ready for download');
		return redirect()->route('payrolls.show',['id'=>$payroll->employee_id]);			
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payroll=Payroll::findOrFail($id);
		$payroll->delete();
		
		Session::flash('success','Payroll Deleted');
		return redirect()->back();
    }
	public function bin(){
		$payrolls=Payroll::onlyTrashed()->get();
		return view('payroll.bin')->with('payrolls', $payrolls);
	}
	
	public function restore($id){
		$payroll=Payroll::withTrashed()->where('id', $id)->first();
		$payroll->restore();
		
		Session::flash('success', 'payroll row is restored.');
		return redirect()->route('employees.index');
	}
	
	public function kill($id){
		$payroll=Payroll::withTrashed()->where('id', $id)->first();		
		$payroll->forceDelete();
		
		Session::flash('success', 'payroll permanently destroyed.');
		return redirect()->route('employees.index');
	}
}
