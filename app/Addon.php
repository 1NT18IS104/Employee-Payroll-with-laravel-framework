<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable=['payroll_id','label', 'value', 'type'];

    public function payrolls(){
		return $this->belongsTo('App\Payroll');
	}
    // public function netPay($gross){

    //     if($this->type == 'b'){
	// 	    $bonus+= $this->value;
    //     }
	// 	if($this->type == 'd'){
	// 	    $deduction+= $this->value;
    //     }
	// 	$final=$gross+$bonus-$deduction;
	// 	return $this->gross = $final;
	// }
}
