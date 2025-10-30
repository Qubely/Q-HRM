<?php

namespace App\Http\Controllers\Employee\Attendance\Reports\Mothly\Details;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Attendance\Report\Employee\Load\MonthWise\IMonthWiseLoadRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
class AttendanceDetailsController extends Controller
{
    use BaseTrait;
    public function __construct(private IMonthWiseLoadRepository $iMonthWiseLoadRepo) {
        $this->middleware(['auth:employee','HasEmployeePassword','HasEmployeeAuth']);
        $this->lang= 'employee.attendance.report.monthly.details';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $request->merge([
            'from_date'   => Carbon::now()->startOfMonth()->format('Y-m-d'),
            'to_date'     => Carbon::now()->endOfMonth()->format('Y-m-d'),
            'employee_id' => Auth::user()->id,
        ]);
        $data = $this->iMonthWiseLoadRepo->display($request);
        $data['lang'] = $this->lang;
        return view('employee.pages.attendance.report.monthly.details.index')->with('data',$data);
    }
}
