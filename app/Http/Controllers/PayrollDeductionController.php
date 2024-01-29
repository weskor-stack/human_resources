<?php

namespace App\Http\Controllers;

use App\Models\Payroll_deduction;
use App\Models\Payroll_perception;
use App\Models\Employee;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Contract;
use App\Models\ContractJob;
use App\Models\Position;
use App\Models\Department;
use App\Models\Unit;
use App\Models\Payroll;
use App\Models\Personal_data;
use App\Models\Deduction;
use App\Models\Management;
use App\Models\Undersecretary;
use App\Models\Secretary;
use App\Models\TypePayment;
use App\Models\TypePosition;
use App\Models\PayrollEmploye;
use App\Models\BudgetCode;
use App\Http\Requests\StorePayroll_deductionRequest;
use App\Http\Requests\UpdatePayroll_deductionRequest;
use DB;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PayrollDeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Payroll $payroll_deduction)
    {
        //
        $datas = $_GET['list'];
        // return response()->json($datas);
        $payrolls = Payroll_deduction::all();
        $employees = Employee::where('status_employee_id','=','1')->select('employee_id','name','last_name1','last_name2')->whereIn('employee_id', Payroll_perception::select('employee_id')->where('status_employee_id', '=', 1))->get();
        $employees = Employee::where('status_employee_id','=','1')->select('employee_id','name','last_name1','last_name2')->whereIn('employee_id', Payroll_perception::select('employee_id')->where('payroll_id', '=', $datas))->paginate(10);

        // $employees = Employee::all();
        // return response()->json($employees);
        return view('payrolls.payrollDeductions.index', compact('payrolls','employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $payrolls = Payroll::all();
        $datas = $_GET['list'];
        // // $payrolls = Payroll::all();
        $payrolls = Payroll::select('payroll_id','description','key')->where('payroll_id','=',$datas)->get();
        // $employees2 = Employee::select('employee_id','name','last_name1','last_name2')->where('status_id','=','1')->get();
        $employees = Employee::where('status_employee_id','=','1')->select('employee_id','name','last_name1','last_name2')->whereNotIn('employee_id', Payroll_perception::select('employee_id')->where('status_employee_id', '=', 1))->get();

        // $employees_contract_job = Contract::select('contract_id','employee_id')
        //     ->join('contract_job', 'contract.contract_id', '=', 'contract_job.contract_id')
        //     ->join('employee', 'contract.employee_id', '=', 'employee.employee_id')
        //     ->select('employee.name', 'employee.last_name1','employee.last_name2')
        //     ->get();

        $contracts = Contract::all();
        $contract_jobs = ContractJob::all();
        // return response()->json($employees_contract_job);
        $deductions = Deduction::select('deduction_id','name')->where('status_id','=','1')->get();  
        return view('payrolls.payrollDeductions.create', compact('payrolls','employees','deductions','contracts','contract_jobs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayroll_deductionRequest $request)
    {
        //
        $payrolls = $request->except('_token','modalidad','contrato','ubicacion','total');
        $payrolls2 = $request->except('_token');
        $perceptions = $request->except('_token','employee_id','modalidad','contrato','ubicacion','payroll_id','total','user_id');
        $percepcion_count = 0;
        $deduccion_count = 0;
        $payrolls_perceptions;
        $payrolls_deductions;

        $payroll_employee['employee_id'] = $request->employee_id;
        $payroll_employee['payroll_id'] = $request->payroll_id;
        $payroll_employee['user_id'] = $request->user_id;

        // return response()->json($payrolls);
        PayrollEmploye::insert($payroll_employee);
        
        foreach ($payrolls as $key => $value) {
            # code...
            $perception_name = explode("_",$key);
            if($perception_name[0] == "percepcion"){
                $percepcion_count = $percepcion_count + 1;
                $payrolls_perceptions['employee_id'] = $payrolls['employee_id'];
                $payrolls_perceptions['perception_id'] = $perception_name[1];
                $payrolls_perceptions['payroll_id'] = $payrolls['payroll_id'];
                $payrolls_perceptions['sum'] = $value;
                $payrolls_perceptions['user_id'] = $payrolls['user_id'];

                // return response()->json($payrolls_perceptions);
                Payroll_perception::insert($payrolls_perceptions);
                
            }elseif ($perception_name[0] == "deduccion") {
                # code...
                $deduccion_count = $deduccion_count + 1;
                $percepcion_count = $percepcion_count + 1;
                $payrolls_deductions['employee_id'] = $payrolls['employee_id'];
                $payrolls_deductions['deduction_id'] = $perception_name[1];
                $payrolls_deductions['payroll_id'] = $payrolls['payroll_id'];
                $payrolls_deductions['sum'] = $value;
                $payrolls_deductions['user_id'] = $payrolls['user_id'];

                // return response()->json($perception_name);
                Payroll_deduction::insert($payrolls_deductions);
            }
        }
        // return response()->json($deduccion_count);
        // return response()->json($percepcion_count);
        // return response()->json($payrolls);
        // Payroll_deduction::insert($payrolls);
        // return response()->json($payrolls);
        return redirect()->route('payrolls.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)//Payroll_deduction $payroll_deduction)
    {
        //
        $payrolls = $_GET['nom'];
        
        // $payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$payroll_deduction->payroll_id)->get();
        // $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$payroll_deduction->employee_id)->get();
        // $deductions = Deduction::select('deduction_id','name')->where('deduction_id','=',$payroll_deduction->deduction_id)->get();  

        $payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$payrolls)->get();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$id)->get();
        $payrollDeductions = Payroll_deduction::select('deduction_id')->where('payroll_id','=',$payrolls[0])->get();
        // $deductions = Deduction::select('deduction_id','name')->where('deduction_id','=',$payrollDeductions)->get();

        $payrolls = $payrolls[0];
        $employees = $employees[0];
        // $deductions = $deductions[0];
        // return response()->json($payrollDeductions);
        return view('payrolls.payrollDeductions.show', compact('payrolls','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)//Payroll_deduction $payroll_deduction)
    {
        //
        $payroll_deduction = $id;
        $payrolls = Payroll::all();
        // $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$payroll_deduction->employee_id)->get();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$id)->get();
        $deductions = Deduction::select('deduction_id','name')->where('status_id','=','1')->get();

        // $p_payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$payroll_deduction->payroll_id)->get();
        // $p_employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$payroll_deduction->employee_id)->get();
        // $p_deductions = Deduction::select('deduction_id','name')->where('deduction_id','=',$payroll_deduction->deduction_id)->get();
        
        // $payroll_employee = Payroll_deduction::select('payroll_deduction_id','employee_id','deduction_id','payroll_id','sum')->where('employee_id','=',$payroll_deduction->employee_id)->get();
        
        $deduction = Payroll_deduction::select('payroll_id')->where('employee_id','=',$employees[0]->employee_id)->get();
        $p_payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$deduction[0]->payroll_id)->get();
        $p_employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$id)->get();
        // return response()->json($p_payrolls);
        return view('payrolls.payrollDeductions.edit', compact('payrolls','employees','p_employees','payroll_deduction','p_payrolls'));
        // return view('payrolls.payrollDeductions.edit', compact('payrolls','employees','deductions','payroll_deduction','p_payrolls','p_employees','p_deductions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayroll_deductionRequest $request, Payroll_deduction $payroll_deduction)
    {
        //
        $payrolls = $request->except('_token','_method','modalidad','contrato','ubicacion','total');
        $percepcion_count = 0;
        $deduccion_count = 0;
        $payrolls_perceptions;
        $payrolls_deductions;

        return response()->json($request);
        foreach ($payrolls as $key => $value) {
            # code...
            $perception_name = explode("_",$key);
            if($perception_name[0] == "percepcion"){
                $percepcion_count = $percepcion_count + 1;
                $payrolls_perceptions['employee_id'] = $payrolls['employee_id'];
                $payrolls_perceptions['perception_id'] = $perception_name[1];
                $payrolls_perceptions['payroll_id'] = $payrolls['payroll_id'];
                $payrolls_perceptions['sum'] = $value;
                $payrolls_perceptions['user_id'] = $payrolls['user_id'];

                // return response()->json(Payroll_perception::select('perception_id')->where('employee_id','=',$payrolls_perceptions['employee_id']) ->where('perception_id','=',$perception_name[1]) ->get());
                // Payroll_perception::insert($payrolls_perceptions);
                return response()->json($payrolls_perceptions);
                Payroll_perception::where('perception_id','=',$perception_name[1]) -> where('employee_id','=',$payrolls['employee_id'])->update($payrolls_perceptions);
                
            }elseif ($perception_name[0] == "deduccion") {
                # code...
                $deduccion_count = $deduccion_count + 1;
                $percepcion_count = $percepcion_count + 1;
                $payrolls_deductions['employee_id'] = $payrolls['employee_id'];
                $payrolls_deductions['deduction_id'] = $perception_name[1];
                $payrolls_deductions['payroll_id'] = $payrolls['payroll_id'];
                $payrolls_deductions['sum'] = $value;
                $payrolls_deductions['user_id'] = $payrolls['user_id'];

                // return response()->json($payrolls_deductions);
                // Payroll_deduction::insert($payrolls_deductions);
                Payroll_deduction::where('deduction_id','=',$perception_name[1]) ->where('employee_id','=',$payrolls['employee_id'])->update($payrolls_deductions);
            }
        }
        // return response()->json($payrolls_deductions);
        // return response()->json($payrolls);
        // $payrolls = $request->except('_token','_method');
        // Payroll_deduction::where('payroll_deduction_id','=',$payroll_deduction->payroll_deduction_id) -> update($payrolls);
        return redirect()->route('payrolls.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll_deduction $payroll_deduction)
    {
        //
        return response()->json($payroll_deduction);
        $payroll_deduction->delete();
        return redirect()->route('payroll_deductions.index');
    }

    public function report()
    {
        $datas = $_GET['list'];
        $employees = Employee::where('status_employee_id','=','1')->select('employee_id','name','last_name1','last_name2','create_time')->whereIn('employee_id', Payroll_perception::select('employee_id')->where('payroll_id', '=', $datas))->get();
        $payrolls = Payroll::select('description','start_date')->where('payroll_id','=',$datas)->where('status_payroll_id','=',1)->get();
        $num = 1;
        $row = 8;
        $percepcion = 0;
        $deduccion = 0;
        $resultado = 0;
        // return response()->json($employees);
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->getColumnDimension('A')->setWidth(6);
        $activeWorksheet->getColumnDimension('B')->setWidth(20);
        $activeWorksheet->getColumnDimension('C')->setWidth(50);
        $activeWorksheet->getColumnDimension('D')->setWidth(50);
        $activeWorksheet->getColumnDimension('E')->setWidth(60);
        $activeWorksheet->getColumnDimension('F')->setWidth(20);
        $activeWorksheet->getColumnDimension('G')->setWidth(20);
        $activeWorksheet->getColumnDimension('H')->setWidth(20);
        $activeWorksheet->getColumnDimension('I')->setWidth(20);
        $activeWorksheet->getColumnDimension('J')->setWidth(30);
        $activeWorksheet->getColumnDimension('K')->setWidth(30);
        $activeWorksheet->getColumnDimension('L')->setWidth(30);
        $activeWorksheet->getColumnDimension('M')->setWidth(35);
        $activeWorksheet->getColumnDimension('N')->setWidth(35);
        $activeWorksheet->getColumnDimension('O')->setWidth(35);
        $activeWorksheet->getColumnDimension('P')->setWidth(35);
        $activeWorksheet->getColumnDimension('Q')->setWidth(20);
        $activeWorksheet->getColumnDimension('R')->setWidth(20);
        $activeWorksheet->getColumnDimension('S')->setWidth(20);
        $activeWorksheet->getColumnDimension('T')->setWidth(30);
        $activeWorksheet->getColumnDimension('U')->setWidth(20);
        $activeWorksheet->getColumnDimension('V')->setWidth(30);
        $activeWorksheet->getColumnDimension('W')->setWidth(30);
        $activeWorksheet->getStyle('A7:W7')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => '000000'],]);

        $activeWorksheet->getStyle('A7:W7')->getFont()->setSize(14)->setBold(true)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);   
    
        $activeWorksheet->getStyle('A7:W7')->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle('A7:W7')->getAlignment()->setVertical('center');

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();

        $drawing->setName('Logo');
        $drawing->setPath('./img/finanzas.png');
        $drawing->setCoordinates('A1');
        $drawing->setWorksheet($activeWorksheet);

        $activeWorksheet->mergeCells('A1:J1');
        $activeWorksheet->mergeCells('A2:J2');
        $activeWorksheet->mergeCells('A3:J3');
        $activeWorksheet->mergeCells('A5:J5');

        $activeWorksheet->getRowDimension(7)->setRowHeight(30);

        $activeWorksheet->setCellValue('A1', 'SECRETARIA DE FINANZAS');
        $activeWorksheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle('A1')->getAlignment()->setVertical('center');
        $activeWorksheet->getStyle('A1')->getFont()->setSize(14)->setBold(true)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $activeWorksheet->setCellValue('A2', 'DIRECCIÓN ADMINISTRATIVA');
        $activeWorksheet->getStyle('A2')->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle('A2')->getAlignment()->setVertical('center');
        $activeWorksheet->getStyle('A2')->getFont()->setSize(14)->setBold(true)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $activeWorksheet->setCellValue('A3', 'DEPARTAMENTO DE RECURSOS HUMANOS');
        $activeWorksheet->getStyle('A3')->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle('A3')->getAlignment()->setVertical('center');
        $activeWorksheet->getStyle('A3')->getFont()->setSize(14)->setBold(true)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $activeWorksheet->setCellValue('A5', 'PLANTILLA DE HONORARIO ASIMILABLES A SALARIOS CORRESPONDIENTE A LA NÓMINA '.$payrolls[0]['description'].' '.$payrolls[0]['start_date']);
        $activeWorksheet->getStyle('A5')->getAlignment()->setHorizontal('center');
        $activeWorksheet->getStyle('A5')->getAlignment()->setVertical('center');
        $activeWorksheet->getStyle('A5')->getFont()->setSize(14)->setBold(true)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $activeWorksheet->setCellValue('A7', 'ID');
        $activeWorksheet->setCellValue('B7', 'RFC');
        $activeWorksheet->setCellValue('C7', 'NOMBRE');
        $activeWorksheet->setCellValue('D7', 'DEPARTAMENTO');
        $activeWorksheet->setCellValue('E7', 'DIRECCIÓN O SUBSECRETARIA');
        $activeWorksheet->setCellValue('F7', 'BRUTO');
        $activeWorksheet->setCellValue('G7', 'ISSS');
        $activeWorksheet->setCellValue('H7', 'PENSIÓN');
        $activeWorksheet->setCellValue('I7', 'INASIS');
        $activeWorksheet->setCellValue('J7', 'NETO');
        $activeWorksheet->setCellValue('K7', 'MENSUAL');
        $activeWorksheet->setCellValue('L7', 'FORMA DE PAGO');
        $activeWorksheet->setCellValue('M7', 'CATEGORIA');
        $activeWorksheet->setCellValue('N7', 'PARTIDA');
        $activeWorksheet->setCellValue('O7', 'CURP');
        $activeWorksheet->setCellValue('P7', 'FECHA DE NACIMIENTO');
        $activeWorksheet->setCellValue('Q7', 'SEXO');
        $activeWorksheet->setCellValue('R7', 'FECHA DE ALTA');
        $activeWorksheet->setCellValue('S7', 'TIPO_PAGO');
        $activeWorksheet->setCellValue('T7', 'BANCO dispersión');
        $activeWorksheet->setCellValue('U7', 'BANCO');
        $activeWorksheet->setCellValue('V7', 'FOLNORTE');
        $activeWorksheet->setCellValue('W7', 'CUENTA');
        
        foreach ($employees as $employee =>$value) {
            // return response()->json($value);
            $datosPersonales = Personal_data::select('date_birth','rfc','gender','curp')->where('employee_id','=',$value['employee_id'])->get();
            $contrato = Contract::select('contract_id','position_id','type_contract_id','start_date','end_date','check_attendance','status_contract_id')
            ->where('employee_id','=',$value['employee_id'])
            ->where('status_contract_id','=','1')->get();
            
            $puesto = Position::select('key','name','department_id','status_id','location_id','address','type_position_id')->where('position_id','=',$contrato[0]['position_id'])
            ->where('status_id','=','1')->get();

            $typePosotion = TypePosition::select('type_position_id','name','status_id')->where('type_position_id','=',$puesto[0]['type_position_id'])
            ->where('status_id','=','1')->get();
            // return response()->json($puesto);

            $department = Department::select('key','name','unit_id','status_id')->where('department_id','=',$puesto[0]['department_id'])
            ->where('status_id','=','1')->get();

            $unidad = Unit::select('key','name','management_id','status_id')->where('unit_id','=',$department[0]['unit_id'])
            ->where('status_id','=','1')->get();

            $direccion = Management::select('key','name','undersecretary_id','status_id')->where('management_id','=',$unidad[0]['management_id'])
            ->where('status_id','=','1')->get();
            
            $subSecretaria = Undersecretary::select('key','name','secretary_id','status_id')->where('undersecretary_id','=',$direccion[0]['undersecretary_id'])
            ->where('status_id','=','1')->get();

            $secretaria = Secretary::select('key','name','status_id')->where('secretary_id','=',$subSecretaria[0]['secretary_id'])
            ->where('status_id','=','1')->get();

            $salario = ContractJob::select('salary','contract_id','type_payment_id')->where('contract_id','=',$contrato[0]['contract_id'])->get();

            $tipoPago = TypePayment::select('type_payment_id','key','name')->where('type_payment_id','=',$salario[0]['type_payment_id'])->get();
            // return response()->json($tipoPago);

            $isr = Payroll_deduction::select('deduction_id','sum')->where('employee_id','=',$value['employee_id'])->where('deduction_id','=',2)->get();
            $isr = $isr[0]['sum'];

            $percepciones = Payroll_perception::select('perception_id','sum')->where('employee_id','=',$value['employee_id'])->get();
            $deducciones = Payroll_deduction::select('deduction_id','sum')->where('employee_id','=',$value['employee_id'])->get();

            $activeWorksheet->setCellValue('A'.$row, $value['employee_id']);
            $activeWorksheet->setCellValue('B'.$row, $datosPersonales[0]['rfc']);
            $activeWorksheet->setCellValue('C'.$row, $value['name'].' '.$value['last_name1'].' '.$value['last_name2']);
            $activeWorksheet->setCellValue('D'.$row, $department[0]['name']);
            $activeWorksheet->setCellValue('E'.$row, $direccion[0]['name']);
            // $activeWorksheet->setCellValue('F'.$row, $salario[0]['salary']);
            $activeWorksheet->setCellValue('G'.$row, number_format(floatval($isr),2));//ISR
            $activeWorksheet->setCellValue('H'.$row, '-');
            $activeWorksheet->setCellValue('I'.$row, '-');

            if ($contrato[0]['check_attendance']==2) {
                $percepcion = 0;
                $deduccion = 0;
                $resultado = 0;
                foreach ($percepciones as $key) {
                    $percepcion = $percepcion + $key['sum'];
                }
    
                foreach ($deducciones as $key) {
                    # code...
                    $deduccion = $deduccion + $key['sum'];
                }
                $resultado = $percepcion - $deduccion;
            }elseif($contrato[0]['check_attendance']==1){
                $percepcion = 0;
                $deduccion = 0;
                $resultado = 0;
                foreach ($percepciones as $key) {
                    // return response()->json($percepcion);
                    $percepcion = $percepcion + $key['sum'];
                }
    
                // return response()->json($percepcion);
                foreach ($deducciones as $key) {
                    # code...
                    $deduccion = $deduccion + $key['sum'];
                }
                $resultado = $percepcion - $deduccion;
                // return response()->json($resultado);
            }
            

            $budgetCode = BudgetCode::select('key','name','description','status_id')->where('status_id','=','1')->get();
            $activeWorksheet->setCellValue('J'.$row, number_format(floatval($resultado),2));//NETO
            $activeWorksheet->setCellValue('F'.$row, number_format(floatval($percepciones[0]['sum']),2));
            $activeWorksheet->setCellValue('K'.$row, number_format(floatval($salario[0]['salary']),2));//MENSUAL
            $activeWorksheet->setCellValue('L'.$row, $tipoPago[0]['name']);
            $activeWorksheet->setCellValue('M'.$row, $typePosotion[0]['name']);
            $activeWorksheet->setCellValue('N'.$row, $budgetCode[0]['key'].'-'.$budgetCode[0]['name'].'-'.$budgetCode[0]['description']);//PARTIDA tabla: budget_code
            $activeWorksheet->setCellValue('O'.$row, $datosPersonales[0]['curp']);
            $activeWorksheet->setCellValue('P'.$row, $datosPersonales[0]['date_birth']);

            if($datosPersonales[0]['gender'] == 1){
                $genero = 'Masculino';
            }else{
                $genero = 'Femenino';
            }
            // $genero = $datosPersonales[0]['gender']=1 ? 'Masculino' : 'Femenino';
            // return response()->json($genero);
            $activeWorksheet->setCellValue('Q'.$row, $genero);
            $activeWorksheet->setCellValue('R'.$row, $contrato[0]['start_date']);
            $activeWorksheet->setCellValue('S'.$row, $tipoPago[0]['name']);

            if ($salario[0]['type_payment_id'] == 2) {
                $activeWorksheet->setCellValue('T'.$row, 'EFECTIVO');
                $activeWorksheet->setCellValue('U'.$row, 'EFECTIVO');
                $activeWorksheet->setCellValue('V'.$row, 'EFECTIVO');
                $activeWorksheet->setCellValue('W'.$row, 'EFECTIVO');
            }else{
                $cuenta = BankAccount::select('bank_id','account','clabe','card','observation')->where('employee_id','=',$value['employee_id'])->get();
                $banco = Bank::select('name','description')->where('bank_id','=',$cuenta[0]['bank_id'])->get();
                if($banco[0]['name']=='BANORTE'){
                    $activeWorksheet->setCellValue('T'.$row, $banco[0]['name']);
                    $activeWorksheet->setCellValue('W'.$row, $cuenta[0]['account']);
                }else {
                    $banco_transferencia = 'TRANSFERENCIAS BANORTE';
                    $activeWorksheet->setCellValue('T'.$row, $banco_transferencia);
                    $activeWorksheet->setCellValue('W'.$row, $cuenta[0]['clabe']);
                }
                
                $activeWorksheet->setCellValue('U'.$row, $banco[0]['name']);
                $activeWorksheet->setCellValue('V'.$row, $cuenta[0]['observation']);
                
            }
            // return response()->json($datosPersonales[0]);
            $row = $row + 1;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Reporte_nomina.xlsx"');
        header('Cache-Control: max-age=0');
        

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');   
        //return response()->json($employees);
    }
}
