<?php

namespace App\Http\Controllers\Admin\DataLibrary\Salary\Group\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Salary\Group\Crud\ValidateStoreLibSalaryGroup;
use App\Models\LibSalaryHead;
use App\Repositories\Admin\DataLibrary\Salary\Group\Crud\ILibSalaryGroupCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibSalaryGroupCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibSalaryGroupCrudRepository $iLibSalaryGroupCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.salary.group.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libsalarygroup crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibSalaryGroupCrudRepo->index($request);
        $data['lang'] = $this->lang;
        $data['heads'] = LibSalaryHead::select(['id','name'])->get();
        return view('admin.pages.data-library.salary.group.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libsalarygroup crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibSalaryGroupCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibSalaryGroup $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibSalaryGroup $request): JsonResponse
    {
        return $this->iLibSalaryGroupCrudRepo->store($request);
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
        $data = $this->iLibSalaryGroupCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.salary.group.crud.index', compact('data'));
    }

    /**
     * Update procedure for libsalarygroup
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibSalaryGroupCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibSalaryGroupCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibSalaryGroupCrudRepo->updateList($request);
    }

}
