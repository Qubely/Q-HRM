<?php

namespace App\Http\Controllers\Employee\Attendance\Entry\Form\Store;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\Attendance\Entry\Form\Store\ValidateEmployeeAttendanceEntryStore;
use App\Repositories\Employee\Attendance\Entry\Form\Store\IEmployeeAttendanceEntryStoreRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeAttendanceEntryStoreController extends Controller {

    use BaseTrait;
    public function __construct(private IEmployeeAttendanceEntryStoreRepository $iEmployeeAttendanceEntryStoreRepo) {
        $this->middleware(['auth:employee','HasEmployeePassword','HasEmployeeAuth']);
        $this->lang= 'employee.attendance.entry.form.store';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
    }

    /**
     * View employeeattendance store form
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iEmployeeAttendanceEntryStoreRepo->index($request);
        $data['lang'] = $this->lang;
        return view('employee.pages.attendance.entry.form.store.index')->with('data',$data);
    }

    /**
     * Store employeeattendance form
     *
     * @param Request $request
     * @return void
     */
    public function store(ValidateEmployeeAttendanceEntryStore $request)
    {
       return $this->iEmployeeAttendanceEntryStoreRepo->store($request);
    }

     /**
     * Update employeeattendance form
     *
     * @param Request $request
     * @return void
     */
    public function update(ValidateEmployeeAttendanceEntryStore $request)
    {
       return $this->iEmployeeAttendanceEntryStoreRepo->update($request);
    }
}

