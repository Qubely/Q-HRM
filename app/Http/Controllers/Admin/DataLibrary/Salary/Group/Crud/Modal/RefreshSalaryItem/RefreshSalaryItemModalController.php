<?php

namespace App\Http\Controllers\Admin\DataLibrary\Salary\Group\Crud\Modal\RefreshSalaryItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataLibrary\Salary\Group\Crud\ValidateRefreshLibSalaryGroup;
use App\Traits\BaseTrait;
use Illuminate\Http\JsonResponse;
use View;
use Illuminate\Http\Request;
use App\Repositories\Admin\DataLibrary\Salary\Group\Crud\Modal\RefreshSalaryItem\IRefreshSalaryItemRepository;
//vpx_imports

class RefreshSalaryItemModalController extends Controller {

    use BaseTrait;
    public function __construct(private IRefreshSalaryItemRepository $iRefreshSalaryItemRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.data-library.salary.group.crud.modal.refresh-salary-item';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Loaded page for refreshsalaryitem
     *
     * @param Request $request
     * @return View
     */
    public function display(Request $request) : JsonResponse
    {
        $data['lang'] = $this->lang;
        $data = [...$data,...$this->iRefreshSalaryItemRepo->display($request)];
        $view = View::make('admin.pages.data-library.salary.group.crud.modal.refresh-salary-item._modal', compact('data'))->render();
        $response = ['extraData' => ['inflate' => pxLang($data['lang'],'','common.response_success')],'view' => $view];
        return $this->response(['type' => 'success', 'data' => $response]);
    }
    //vpx_attach

    /**
     * Refresh salary items
     *
     * @param ValidateRefreshLibSalaryGroup $request
     * @return JsonResponse
     */
    public function refresh(ValidateRefreshLibSalaryGroup $request) : JsonResponse
    {
        return $this->iRefreshSalaryItemRepo->refresh($request);
    }

    /**
     * Bulk update salary items
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function bulkUpdate(ValidateRefreshLibSalaryGroup  $request) : JsonResponse
    {
        return $this->iRefreshSalaryItemRepo->bulkUpdate($request);
    }

    /**
     * Delete single salary item
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request) : JsonResponse
    {
        return $this->iRefreshSalaryItemRepo->delete($request);

    }

}
