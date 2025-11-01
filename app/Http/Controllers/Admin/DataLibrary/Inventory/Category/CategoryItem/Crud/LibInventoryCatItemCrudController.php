<?php

namespace App\Http\Controllers\Admin\DataLibrary\Inventory\Category\CategoryItem\Crud;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Inventory\Category\CategoryItem\Crud\ValidateStoreLibInventoryCatItem;
use App\Models\LibInventoryCat;
use App\Repositories\Admin\DataLibrary\Inventory\Category\CategoryItem\Crud\ILibInventoryCatItemCrudRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class LibInventoryCatItemCrudController  extends Controller {

    use BaseTrait;
    public function __construct(private ILibInventoryCatItemCrudRepository $iLibInventoryCatItemCrudRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.inventory.category.category-item.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for libinventorycatitem crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iLibInventoryCatItemCrudRepo->index($request);
        $data['lang'] = $this->lang;
        $data['category'] = LibInventoryCat::find($request->cat_item_id);
        return view('admin.pages.data-library.inventory.category.category-item.crud.index',compact('data'));
    }

    /**
     * List items for yajra datatable for libinventorycatitem crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iLibInventoryCatItemCrudRepo->list($request);
    }

    /**
     * Store procedure for comapany crud
     *
     * @param ValidateStoreLibInventoryCatItem $request
     * @return JsonResponse
     */
    public function store(ValidateStoreLibInventoryCatItem $request): JsonResponse
    {
        return $this->iLibInventoryCatItemCrudRepo->store($request);
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
        $data = $this->iLibInventoryCatItemCrudRepo->index($request,$id);
        $data['lang'] = $this->lang;
        $data['category'] = LibInventoryCat::find($data['item']?->id);
        return view('admin.pages.data-library.inventory.category.category-item.crud.index', compact('data'));
    }

    /**
     * Update procedure for libinventorycatitem
     *
     * @param Request $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update(Request $request, $id) : JsonResponse
    {
        return $this->iLibInventoryCatItemCrudRepo->update($request,$id);
    }

    /**
     * Bulk delete list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function deleteList(Request $request) : JsonResponse
    {
       return $this->iLibInventoryCatItemCrudRepo->deleteList($request);
    }


    /**
     * Bulk update list resources
     *
     * @param Request $request
     * @return JsonResponse
     */
     public function updateList(Request $request) : JsonResponse
    {
       return $this->iLibInventoryCatItemCrudRepo->updateList($request);
    }

}
