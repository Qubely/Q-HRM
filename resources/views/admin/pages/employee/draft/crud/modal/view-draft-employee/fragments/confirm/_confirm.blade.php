<div class="row">
    <div class="col-md-4">
        <div class="card p-2 shadow-card card-border">
            <form id="frmStartEmployee" autocomplete="off">
                <input type="hidden" value="{{$data['item']?->id}}" name="id" />
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'tabs.confirm.fileds.employee_id')}}</b> <em class="required">*</em> <span id="employee_id_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="employee_id" id="employee_id" value="{{ $data['lastId']}}" disabled>
                                    </div>
                                </div>
                                 <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{pxLang($data['lang'],'tabs.confirm.fileds.joining_date')}}</b> <em class="required">*</em> <span id="joining_date_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control dp" name="joining_date" id="joining_date">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3 text-end">
                                    <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> {{pxLang($data['lang'],'tabs.confirm.btn.employee_entry')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
