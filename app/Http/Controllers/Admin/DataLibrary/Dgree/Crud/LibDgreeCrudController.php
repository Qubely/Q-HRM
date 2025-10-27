<?php

namespace App\Http\Controllers\Admin\DataLibrary\Dgree\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Dgree\Crud\ValidateStoreLibDgree;
use App\Repositories\Admin\DataLibrary\Dgree\Crud\ILibDgreeCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibDgreeCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibDgreeCrudRepository $iLibDgreeCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.dgree.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libdgree crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibDgreeCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.dgree.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libdgree crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibDgreeCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibDgree $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibDgree $request): JsonResponse
    {
        return $this->iLibDgreeCrudRepo->store($request);
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
        $data = $this->iLibDgreeCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.dgree.crud.index', compact('data'));
    }

    /**
     * Update procedure for libdgree
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibDgreeCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibDgreeCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibDgreeCrudRepo->updateList($request);
    }

}