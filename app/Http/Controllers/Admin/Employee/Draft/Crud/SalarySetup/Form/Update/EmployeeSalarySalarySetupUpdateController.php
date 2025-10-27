<?php

namespace App\Http\Controllers\Admin\Employee\Draft\Crud\SalarySetup\Form\Update;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Repositories\Admin\Employee\Draft\Crud\SalarySetup\Form\Update\IEmployeeSalarySalarySetupUpdateRepository;
use App\Traits\BaseTrait;
use App\Models\EmployeeSalary;
use App\Models\LibSalaryGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeSalarySalarySetupUpdateController extends Controller {

    use BaseTrait;
    public function __construct(private IEmployeeSalarySalarySetupUpdateRepository $iEmployeeSalarySalarySetupUpdateRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.employee.draft.crud.salary-setup.form.update';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
    }

    /**
     * View employeesalary update form
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iEmployeeSalarySalarySetupUpdateRepo->index($request);
        $data['lang'] = $this->lang;
        $data['employee'] = Employee::where([['uuid','=',$request->uuid]])->first();
        $data['item'] = EmployeeSalary::where([['employee_id','=', $data['employee']?->id],['status','=','Pending']])->take(1)->first();
        $data['groups'] =  LibSalaryGroup::all();
        return view('admin.pages.employee.draft.crud.salary-setup.form.update.index')->with('data',$data);
    }

    /**
     * Update employeesalary form
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
       return $this->iEmployeeSalarySalarySetupUpdateRepo->update($request);
    }
}
