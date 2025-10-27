<?php

namespace App\Http\Controllers\Admin\Employee\Draft\Crud\UpdateBasic\Form\Update;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Employee\Draft\Crud\UpdateBasic\Form\Update\IEmployeeUpdateRepository;
use App\Traits\BaseTrait;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeUpdateController extends Controller {

    use BaseTrait;
    public function __construct(private IEmployeeUpdateRepository $iEmployeeUpdateRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.employee.draft.crud.update-basic.form.update';
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
        $data = $this->iEmployeeUpdateRepo->index($request);
        $data['lang'] = $this->lang;
        $data['employee'] = Employee::where([['uuid','=',$request->uuid]])->first();
        return view('admin.pages.employee.draft.crud.update-basic.form.update.index')->with('data',$data);
    }

    /**
     * Update employee form
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
       return $this->iEmployeeUpdateRepo->update($request);
    }
}
