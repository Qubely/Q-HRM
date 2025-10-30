<h4>{{pxLang($data['lang'],'module.out_time.name')}}</h4>
<div class="time-card">
    <i class="fa-solid fa-clock"></i>
    <h1 id="time-in" class="time-title"> {{ ($data['att'] && $data['att']->out_time != null) ? date('h:i A', strtotime($data['att']->out_time)) : '-:-' }}</h1>
    <p>{{pxLang($data['lang'],'text.out_time')}}</p>
</div>
 <form id="frmEmployeeAttendanceSignOut" autocomplete="off">
    <input type="hidden" value="{{Auth::user()->id}}" id="employee_id" name="employee_id"/>
    <div class="mt-3">
        <div class="card p-2 shadow-card card-border">
            <div class="form-group text-left mb-3 mt-4">
                <label class="form-label"> <b>{{pxLang($data['lang'],'module.out_time.image')}}</b> <em class="required"></em> <span id="out_image_error"></span></label>
                <div class="input-group">
                    <input type="file" class="form-control" name="out_image" id="out_image" accept="*">
                </div>
            </div>
            <div class="mb-3 mt-3 text-end">
                <button class="btn btn-warning btn-sm w-100" type="submit">{{pxLang($data['lang'],'module.out_time.btn_entry')}} </button>
            </div>
        </div>
    </div>
</form>
