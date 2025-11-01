@if ($data['item'] != null)
    @if($data['item']?->reqRequest == null)
    <form id="frmAddReconRequest" autocomplete="off">
        <input type="hidden"  value="{{$data['item']?->id}}" name="id"/>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group text-left mb-3">
                            <label class="form-label"> <b>{{ pxLang($data['lang'],'fields.in_time')}}</b> <em class="required">*</em> <span id="in_time_error"></span></label>
                            <div class="input-group">
                                <input type="text" class="form-control dp" name="in_time" id="in_time">
                            </div>
                        </div>
                        <div class="form-group text-left mb-3">
                            <label class="form-label"> <b>{{ pxLang($data['lang'],'fields.out_time')}} </b> <em class="required">*</em> <span id="out_time_error"></span></label>
                            <div class="input-group">
                                <input type="text" class="form-control dp" name="out_time" id="out_time">
                            </div>
                        </div>
                        <div class="form-group text-left mb-3">
                            <label class="form-label"> <b>{{ pxLang($data['lang'],'fields.reason')}} </b> <em class="required">*</em> <span id="reason_error"></span></label>
                            <div class="input-group">
                                <textarea class="form-control" name="reason" id="reason" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 mt-3 text-end">
                            <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> <span class="ms-2">{{ pxLang($data['lang'],'btns.send_req')  }}</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
        <p class="text-center"> You have pending request, please wait for confirmation </p>
    @endif
@else
    <p>{{pxLang($data['lang'],'text.no_emp')}}</p>
@endif
