<?php

namespace App\Repositories\Admin\Attendance\Report\Employee\Load\MonthWise;

use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class MonthWiseLoadRepository extends BaseRepository implements IMonthWiseLoadRepository {

    use BaseTrait;
    public function __construct() {
    }

    /**
     * Get the page default resource
     *
     * @param Request $request
     * @param integer|string $id
     * @return array
     */
    public function index($request) : array
    {
       return [];
    }


    /**
     * Load view data
     *
     * @param Request $request
     * @return array
     */
    public function display($request) : array
    {
        $from_date = Carbon::parse($request->from_date)->format('Y-m-d');
        $to_date = Carbon::parse($request->to_date)->format('Y-m-d');
        $data['from_date'] = Carbon::parse($from_date)->format('d M Y');
        $data['to_date'] = Carbon::parse($to_date)->format('d M Y');
        $data['item'] = Employee::with(['attendances' => function($q)use($from_date,$to_date) {
            $q->where([['att_date','>=',$from_date],['att_date','<=',$to_date]])->select(['id','employee_id','att_date','in_time','out_time']);
        }])->select(['id','name','employee_id'])->find($request->employee_id);
        $data['dates'] = $this->createPriod($from_date,$to_date, $data['item']?->attendances);
        $data['lastSevenDays'] = [];
        for ($i = 6; $i >= 0; $i--) {
           $data['lastSevenDays'][]  = Carbon::now()->subDays($i)->format('Y-m-d');
        }
        return $data;
    }

    /**
     * Return attendance date
     *
     * @param Date $from_date
     * @param Date $to_date
     * @return array
     */
    private function createPriod($from_date,$to_date,$attendances=null) : array
    {
        $period = CarbonPeriod::create($from_date, $to_date);
        $dates = [];
        foreach ($period as $date) {
            $att_date = $date->format('Y-m-d');
            $att = $attendances?->where('att_date',$att_date)->first();
            $dates[] = [
                'view' => $date->format('d M')." (".$date->format('D').")",
                'att_date' => $att_date,
                'has' => ($att == null) ? false : true,
                'in_time' =>  ($att != null &&  $att?->in_time != null) ? Carbon::parse($att?->in_time)->format('h:i A') : '-',
                'out_time' =>  ($att != null &&  $att?->out_time != null) ? Carbon::parse($att?->out_time)->format('h:i A') : '-',
                'working' => $this->totalWorkingHours($att)
            ];
        }
        return $dates;
    }

    /**
     * Get total workign hours
     *
     * @param Time $att
     * @return string
     */
    private function totalWorkingHours($att) : string
    {
        if ($att && $att?->in_time && $att?->out_time) {
            $in  = Carbon::parse($att->in_time);
            $out = Carbon::parse($att->out_time);

            $diffInMinutes = $in->diffInMinutes($out);
            $hours = floor($diffInMinutes / 60);
            $minutes = $diffInMinutes % 60;

            $total_work = sprintf('%02dh %02dm', $hours, $minutes); // 08h 30m
        } else {
            $total_work = '-';
        }

        return $total_work;
    }
}
