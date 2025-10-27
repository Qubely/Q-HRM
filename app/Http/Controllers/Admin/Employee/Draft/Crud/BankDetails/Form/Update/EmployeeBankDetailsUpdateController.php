<?php

namespace App\Http\Controllers\Admin\Employee\Draft\Crud\BankDetails\Form\Update;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Employee\Draft\Crud\BankDetails\Form\Update\IEmployeeBankDetailsUpdateRepository;
use App\Traits\BaseTrait;
use App\Models\Employee;
use App\Models\LibBank;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeBankDetailsUpdateController extends Controller {

    use BaseTrait;
    public function __construct(private IEmployeeBankDetailsUpdateRepository $iEmployeeBankDetailsUpdateRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.employee.draft.crud.bank-details.form.update';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
    }

    /**
     * View employee update form
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iEmployeeBankDetailsUpdateRepo->index($request);
        $data['lang'] = $this->lang;
        $data['employee'] = Employee::where([['uuid','=',$request->uuid]])->first();
        $data['banks'] = LibBank::select(['id','name'])->get();
        return view('admin.pages.employee.draft.crud.bank-details.form.update.index')->with('data',$data);
    }

    /**
     * Update employee form
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
       return $this->iEmployeeBankDetailsUpdateRepo->update($request);
    }
}
