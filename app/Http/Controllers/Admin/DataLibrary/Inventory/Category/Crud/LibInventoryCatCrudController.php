<?php

namespace App\Http\Controllers\Admin\DataLibrary\Inventory\Category\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Inventory\Category\Crud\ValidateStoreLibInventoryCat;
use App\Repositories\Admin\DataLibrary\Inventory\Category\Crud\ILibInventoryCatCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibInventoryCatCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibInventoryCatCrudRepository $iLibInventoryCatCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.inventory.category.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libinventorycat crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibInventoryCatCrudRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.inventory.category.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libinventorycat crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibInventoryCatCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibInventoryCat $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibInventoryCat $request): JsonResponse
    {
        return $this->iLibInventoryCatCrudRepo->store($request);
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
        $data = $this->iLibInventoryCatCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        return view('admin.pages.data-library.inventory.category.crud.index', compact('data'));
    }

    /**
     * Update procedure for libinventorycat
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibInventoryCatCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibInventoryCatCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibInventoryCatCrudRepo->updateList($request);
    }

}