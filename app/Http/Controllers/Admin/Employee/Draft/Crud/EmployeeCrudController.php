<?php

namespace App\Http\Controllers\Admin\Employee\Draft\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\Draft\Crud\ValidateStoreEmployee;
use App\Models\LibDepartment;
use App\Models\LibDesignation;
use App\Repositories\Admin\Employee\Draft\Crud\IEmployeeCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class EmployeeCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private IEmployeeCrudRepository $iEmployeeCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.employee.draft.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
        $this->departments =  LibDepartment::select(['id','name'])->orderBy('name')->get();
        $this->designations =  LibDesignation::select(['id','name'])->orderBy('name')->get();

    }

    /**
     * Index page for employee crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iEmployeeCrudRepo->index($request);
        $data['lang'] = $this->lang;
        $data['departments'] = $this->departments;
        $data['designations'] = $this->designations;
        return view('admin.pages.employee.draft.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for employee crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iEmployeeCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreEmployee $request
     * @return JsonResponse
     */
    public function store(ValidateStoreEmployee $request): JsonResponse
    {
        return $this->iEmployeeCrudRepo->store($request);
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
        $data = $this->iEmployeeCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        $data['departments'] = $this->departments;
        $data['designations'] = $this->designations;
        return view('admin.pages.employee.draft.crud.index', compact('data'));
    }

    /**
     * Update procedure for employee
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iEmployeeCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iEmployeeCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iEmployeeCrudRepo->updateList($request);
    }

}
