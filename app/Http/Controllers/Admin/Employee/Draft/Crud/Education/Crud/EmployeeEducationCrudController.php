<?php

namespace App\Http\Controllers\Admin\Employee\Draft\Crud\Education\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\Draft\Crud\Education\Crud\ValidateStoreEmployeeEducation;
use App\Models\Employee;
use App\Models\LibBoard;
use App\Models\LibDgree;
use App\Repositories\Admin\Employee\Draft\Crud\Education\Crud\IEmployeeEducationCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class EmployeeEducationCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private IEmployeeEducationCrudRepository $iEmployeeEducationCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.employee.draft.crud.education.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
        $this->dgrees = LibDgree::select(['id','name'])->get();
        $this->boards = LibBoard::select(['id','name'])->get();

    }

    /**
     * Index page for employeeeducation crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $employee = Employee::where([['uuid','=',$request->uuid]])->first();
        $request->merge(['employee_id' => $employee?->id]);
        $data = $this->iEmployeeEducationCrudRepo->index($request);
        $data['lang'] = $this->lang;
        $data['employee'] = $employee;
        $data['boards'] = $this->boards;
        $data['dgrees'] = $this->dgrees;
        return view('admin.pages.employee.draft.crud.education.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for employeeeducation crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iEmployeeEducationCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreEmployeeEducation $request
     * @return JsonResponse
     */
    public function store(ValidateStoreEmployeeEducation $request): JsonResponse
    {
        return $this->iEmployeeEducationCrudRepo->store($request);
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
        $data = $this->iEmployeeEducationCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        $data['employee'] = Employee::where([['id','=',$data['item']?->employee_id]])->first();
        $data['boards'] = $this->boards;
        $data['dgrees'] = $this->dgrees;
        return view('admin.pages.employee.draft.crud.education.crud.index', compact('data'));
    }

    /**
     * Update procedure for employeeeducation
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iEmployeeEducationCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iEmployeeEducationCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iEmployeeEducationCrudRepo->updateList($request);
    }

}
