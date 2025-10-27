<?php

namespace App\Http\Controllers\Admin\DataLibrary\Designation\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Designation\Crud\ValidateStoreLibDesignation;
use App\Repositories\Admin\DataLibrary\Designation\Crud\ILibDesignationCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibDesignationCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibDesignationCrudRepository $iLibDesignationCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.designation.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libdesignation crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibDesignationCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.designation.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libdesignation crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibDesignationCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibDesignation $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibDesignation $request): JsonResponse
    {
        return $this->iLibDesignationCrudRepo->store($request);
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
        $data = $this->iLibDesignationCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.designation.crud.index', compact('data'));
    }

    /**
     * Update procedure for libdesignation
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibDesignationCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibDesignationCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibDesignationCrudRepo->updateList($request);
    }

}