@extends('admin.layouts.main-layout',["tabTitle" => config('i.service_name')." | ".pxLang($data['lang'],'breadCum.title') ])
@section('page')
    <div class="row">
        <div class="col-md-12">
            @can('employee_salary_salary_setup_update_view')
                @if( $data['employee'] != null && $data['item'] != null)
                    <div class="">
                        @include('admin.pages.employee.draft.crud.salary-setup.form.update.fragments._breadcum')
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
                                @can('employee_salary_salary_setup_update_update')
                                    <form id="frmEmployeeSalarySalarySetupUpdate" autocomplete="off">
                                        <input type="hidden" name="id" value="{{$data['item']?->id}}" />
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="card p-2 shadow-card card-border">
                                                            <div class="form-group text-left mb-3">
                                                                <label class="form-label"> <b>{{pxLang($data['lang'],'fields.lib_salary_group_id')}}</b> <em class="required">*</em> <span id="lib_salary_group_id_error"></span></label>
                                                                <div class="input-group">
                                                                    <select class="form-control" name="lib_salary_group_id" id="lib_salary_group_id">
                                                                        <option value=""> -- {{pxLang($data['lang'],'','common.text.option_select')}} --</option>
                                                                        @foreach ($data['groups'] as $item)
                                                                            <option {{($data['item']?->lib_salary_group_id == $item?->id) ? 'selected':''}} value="{{$item?->id}}">{{$item?->name}} - {{ number_format($item?->salaryItems?->sum('amount')) }} /-</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 mt-3 text-end">
                                                                <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-save"></i> {{pxLang($data['lang'],'','common.btns.crud_action_update')}} </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

