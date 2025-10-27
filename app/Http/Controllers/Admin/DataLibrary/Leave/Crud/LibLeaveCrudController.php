<?php

namespace App\Http\Controllers\Admin\DataLibrary\Leave\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Leave\Crud\ValidateStoreLibLeave;
use App\Repositories\Admin\DataLibrary\Leave\Crud\ILibLeaveCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibLeaveCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibLeaveCrudRepository $iLibLeaveCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.leave.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libleave crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibLeaveCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.leave.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libleave crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibLeaveCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibLeave $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibLeave $request): JsonResponse
    {
        return $this->iLibLeaveCrudRepo->store($request);
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
        $data = $this->iLibLeaveCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.leave.crud.index', compact('data'));
    }

    /**
     * Update procedure for libleave
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibLeaveCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibLeaveCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibLeaveCrudRepo->updateList($request);
    }

}