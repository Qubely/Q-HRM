<div class="bg-info pl-2 page-fragment-bar">
    <span class="text-light"> <a href=""><span class="badge badge-info cursor-pointer"> <i class='fa-solid fa-arrow-left fs-16'></i></span></a> <span class="pt-1">{{pxLang($data['lang'],'add')}}  </span> </span>
</div>
<div class="mt-4 p-3">
    @can('employee_leave_crud_store')
        <form id="frmStoreEmployeeLeave" autocomplete="off">
            <input type="hidden"  value="{{$data['employee']?->id}}" name="employee_id"/>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-2 shadow-card card-border">
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.lib_leave_id')}}</b> <em class="required">*</em> <span id="lib_leave_id_error"></span></label>
                                    <div class="input-group">
                                        <select  class="form-control" name="lib_leave_id" id="lib_leave_id">
                                            <option data-count="" value=""> -- {{pxLang($data['lang'],'','common.text.option_select')}} --</option>
                                            @foreach ($data['leaves'] as $item)
                                                <option data-count="{{$item?->count}}" value="{{$item?->id}}">{{$item?->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.count')}}</b> <em class="required">*</em> <span id="count_error"></span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="count" id="count">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3 text-end">
                                    <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-plus"></i> {{pxLang($data['lang'],'','common.btns.crud_action_add')}} </button>
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

