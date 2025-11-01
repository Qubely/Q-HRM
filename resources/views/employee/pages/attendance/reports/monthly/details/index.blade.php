@extends('employee.layouts.main-layout',["tabTitle" => config('i.service_name')." | ".pxLang($data['lang'],'breadCum.title') ])
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="">
                @include('employee.pages.attendance.reports.monthly.details.fragments._breadcum')
                <div class="card rounded page-block">
                    <div class="p-3">
                        @include('employee.pages.attendance.reports.monthly.details.fragments._display')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



