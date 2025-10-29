<div class="mt-4 p-3">
    @can('month_wise_load_view_load')
        <form id="frmLoadMonthWise" autocomplete="off">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="card p-2 shadow-card card-border">
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.from_date')}}</b> <em class="required">*</em> <span id="from_date_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control dp" name="from_date" id="from_date">
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.to_date')}}</b> <em class="required">*</em> <span id="to_date_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control dp" name="to_date" id="to_date">
                                    </div>
                                </div>
                                 <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'fields.employee_id')}}</b> <em class="required">*</em> <span id="employee_id_error"></span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="employee_id" id="employee_id">
                                            <option value=""> -- {{pxLang($data['lang'],'','common.text.option_select')}} </option>
                                            @foreach ($data['employee'] as $item)
                                                <option value="{{$item?->id}}">{{$item?->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3 text-end">
                                    <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-arrow-down"></i> {{pxLang($data['lang'],'','common.btns.crud_load')}} </button>
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

