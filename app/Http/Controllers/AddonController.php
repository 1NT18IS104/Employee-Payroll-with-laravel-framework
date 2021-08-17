<!-- public function store(Request $request, $id){

    $bonus_label = $request->bonus_label;
    $bonus_value = $request->bonus_value;
    $deduction_label = $request->deduction_label;
    $deduction_value = $request->deduction_value;

 for($i = 0; $i < count($bonus_label); $i++) {
    $addon = Addon::create([
        'label' => $bonus_label[i],
        'value' => $bonus_value[i],
        'type' => 'b',
        'payroll_id' => $id,
    ]);
 }

 for($i = 0; $i < count($deduction_label); $i++) {
    $addon = Addon::create([
        'label' => $deduction_label[i],
        'value' => $deduction_value[i],
        'type' => 'd',
        'payroll_id' => $id,
    ]);
 } -->