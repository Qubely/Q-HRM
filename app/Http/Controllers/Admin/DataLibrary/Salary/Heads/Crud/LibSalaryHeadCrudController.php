<?php

namespace App\Http\Controllers\Admin\DataLibrary\Salary\Heads\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Salary\Heads\Crud\ValidateStoreLibSalaryHead;
use App\Repositories\Admin\DataLibrary\Salary\Heads\Crud\ILibSalaryHeadCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibSalaryHeadCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibSalaryHeadCrudRepository $iLibSalaryHeadCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.salary.heads.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libsalaryhead crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibSalaryHeadCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.salary.heads.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libsalaryhead crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibSalaryHeadCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStorelibsalaryhead $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibSalaryHead $request): JsonResponse
    {
        return $this->iLibSalaryHeadCrudRepo->store($request);
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
        $data = $this->iLibSalaryHeadCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.salary.heads.crud.index', compact('data'));
    }

    /**
     * Update procedure for libsalaryhead
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibSalaryHeadCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibSalaryHeadCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibSalaryHeadCrudRepo->updateList($request);
    }

}