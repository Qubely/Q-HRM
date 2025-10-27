<?php

namespace App\Http\Controllers\Admin\DataLibrary\Banks\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Banks\Crud\ValidateStoreLibBank;
use App\Repositories\Admin\DataLibrary\Banks\Crud\ILibBankCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibBankCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibBankCrudRepository $iLibBankCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.banks.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libbank crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibBankCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.banks.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libbank crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibBankCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibBank $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibBank $request): JsonResponse
    {
        return $this->iLibBankCrudRepo->store($request);
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
        $data = $this->iLibBankCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.banks.crud.index', compact('data'));
    }

    /**
     * Update procedure for libbank
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibBankCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibBankCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibBankCrudRepo->updateList($request);
    }

}