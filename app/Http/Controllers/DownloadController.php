<?php

namespace App\Http\Controllers;

use App\Payroll;
use App\Employee;
use PDF;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
	
   public function pdfDownload($id){
	   $pdf = PDF::loadview('payroll.download.allpayroll',['employee'=>Employee::find($id)]);
	   return $pdf->stream('employee.pdf');
   }
   
   
   public function singlePayroll($id){
        $payroll = Payroll::find($id);
        $bonus = $payroll->addons()->where('type', 'b')->get();
        $deductions = $payroll->addons()->where('type', 'd')->get();
        
	    $pdf = PDF::loadview('payroll.download.singlepayroll',['payroll'=>$payroll,'bonus'=>$bonus,'deductions'=>$deductions]);
	    return $pdf->stream('employee.pdf');
   }

   
}
