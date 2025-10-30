<h4>{{pxLang($data['lang'],'module.in_time.name')}}</h4>
<span id="lang_error"></span>
<span id="lati_error"></span>
<div class="time-card">
    <i class="fa-solid fa-clock"></i>
    <h1 id="time-in" class="time-title"> {{ ($data['att'] && $data['att']->in_time != null) ? date('h:i A', strtotime($data['att']->in_time)) : '-:-' }}</h1>
    <p>{{pxLang($data['lang'],'text.in_time')}}</p>
</div>
<div class="mt-3">
    <form id="frmEmployeeAttendanceEntryStore" autocomplete="off">
        <input type="hidden" value="{{Auth::user()->id}}" id="employee_id" name="employee_id"/>
        <div class="card p-2 shadow-card card-border">
            <div class="form-group text-left mb-3 mt-4">
                <label class="form-label"> <b>{{pxLang($data['lang'],'module.in_time.image')}}</b> <em class="required"></em> <span id="image_error"></span></label>
                <div class="input-group">
                    <input type="file" class="form-control" name="image" id="image" accept="*">
                </div>
            </div>
            @if($data['att'] == null)
            <div class="mb-3 mt-3 text-end">
                <button class="btn btn-primary btn-sm w-100" type="submit">{{pxLang($data['lang'],'module.in_time.btn_entry')}} </button>
            </div>
            @endif
        </div>
    </form>
</div>
