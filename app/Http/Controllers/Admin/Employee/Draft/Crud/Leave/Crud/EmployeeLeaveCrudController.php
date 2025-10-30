<?php

namespace App\Http\Controllers\Admin\Employee\Draft\Crud\Leave\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\Draft\Crud\Leave\Crud\ValidateStoreEmployeeLeave;
use App\Models\Employee;
use App\Models\LibLeave;
use App\Repositories\Admin\Employee\Draft\Crud\Leave\Crud\IEmployeeLeaveCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class EmployeeLeaveCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private IEmployeeLeaveCrudRepository $iEmployeeLeaveCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.employee.draft.crud.leave.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
        $this->leaves = LibLeave::select(['id','name','count'])->get();

    }

    /**
     * Index page for employeeleave crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $employee =  Employee::where([['uuid','=',$request->uuid]])->first();
        $request->merge(['employee_id' => $employee?->id]);
        $data = $this->iEmployeeLeaveCrudRepo->index($request);
        $data['lang'] = $this->lang;
        $data['employee'] = $employee;
        $data['leaves'] = $this->leaves;
        return view('admin.pages.employee.draft.crud.leave.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for employeeleave crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iEmployeeLeaveCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreEmployeeLeave $request
     * @return JsonResponse
     */
    public function store(ValidateStoreEmployeeLeave $request): JsonResponse
    {
        return $this->iEmployeeLeaveCrudRepo->store($request);
    }

    /**
     * Index page for view
     *
     * @param integer|string $id
     * @param Request $request
     * @return view
     */
    public function edit($id,Request $request) : view
    {
        $data = $this->iEmployeeLeaveCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        $data['employee'] = Employee::where([['id','=',$data['item']?->employee_id]])->first();
        $data['leaves'] = $this->leaves;
        return view('admin.pages.employee.draft.crud.leave.crud.index', compact('data'));
    }

    /**
     * Update procedure for employeeleave
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iEmployeeLeaveCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iEmployeeLeaveCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iEmployeeLeaveCrudRepo->updateList($request);
    }

}
