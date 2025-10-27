@extends('admin.layouts.main-layout',["tabTitle" => config('i.service_name')." | ".pxLang($data['lang'],'breadCum.title') ])
@section('page')
    <div class="row">
        <div class="col-md-12">
            @can('employee_form_update_view')
                @if($data['employee'] != null)
                    <div class="">
                        @include('admin.pages.employee.draft.crud.update-basic.form.update.fragments._breadcum')
                        <div id="pageSideBar" class="pageSideBar">
                            <a href="javascript:void(0)" class="closebtn closeNav">×</a>
                            @include('admin.pages.employee.draft.crud.navs.nav')
                        </div>
                        <div class="card rounded page-block">
                            <div class="d-none d-md-block mb-4">
                                @include('admin.pages.employee.draft.crud.navs.nav')
                            </div>
                            <div class="d-block d-md-none">
                                <div class="d-flex flex-row justify-content-end align-items-center p-2">
                                    <span class="fs-18 openNav" style="cursor:pointer">&#9776;</span>
                                </div>
                            </div>
                            <div class="mt-4 p-3">
                                @can('employee_form_update_update')
                                    @include('admin.pages.employee.draft.crud.update-basic.form.update.fragments._update')
                                @else
                                    @include('common.view.fragments.-item-403')
                                @endcan
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card rounded page-block">
                        @include('common.view.fragments.-item-404')
                    </div>
                @endif
            @else
                @include('common.view.fragments.-item-403')
            @endcan
        </div>
    </div>
@endsection

