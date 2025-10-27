<div class="row">
    <div class="col-md-12">
        @if($data['item'] != null)
        <div class="mb-3 p-2">
            <form id="frmRefreshSalaryItems" autocomplete="off">
                <input type="hidden"  value="{{$data['item']->id}}" name="id"/>
                <fieldset class="fieldset">
                    <legend class="legend"> {{pxLang($data['lang'],'text.modal_title')}} </legend>
                    <div class="mt-4">
                        <div class="row mt-2 mb-2">
                            <div class="col-md-12 text-end">
                                <span class="cursor-pointer badge rounded-pill bg-primary p-2 pointer" id="addMore">
                                    <i class="fa fa-plus text-white cursor-pointer"></i>
                                </span>
                            </div>
                        </div>
                        <div id="copy">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group text-start mb-3">
                                        <label class="form-label"> <b> {{pxLang($data['lang'],'fields.type')}} </b> <em class="required">*</em> <span class="type" id="type.0_error"></span></label>
                                        <div class="input-group">
                                            <select class="form-control" name="type[]">
                                                <option value="">-- Select -- </option>
                                                <option value="addition"> Addition </option>
                                                <option value="deduction"> Deduction </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group text-start mb-3">
                                        <label class="form-label"> <b> {{pxLang($data['lang'],'fields.description')}}  </b> <em class="required" >*</em> <span  class="description" id="description.0_error"></span></label>
                                        <div class="input-group">
                                            <select  class="form-control" name="description[]">
                                                <option value="">-- Select -- </option>
                                                @foreach ($data['heads'] as $item)
                                                    <option value="{{$item?->name}}">{{$item?->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group text-start mb-3">
                                        <label class="form-label"> <b> {{pxLang($data['lang'],'fields.amount')}}  </b> <em class="required">*</em> <span  class="amount" id="amount.0_error"></span></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="amount[]">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="remove text-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="paste">
                    </div>
                    <div class="mb-3 mt-3 text-end">
                        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-refresh"></i>   {{pxLang($data['lang'],'text.refresh')}}  </button>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="mb-3 p-2">
            <fieldset class="fieldset">
                <legend class="legend"> {{pxLang($data['lang'],'text.available')}} </legend>
                <form id="frmUpdateSalaryAmount" autocomplete="off">
                    <input type="hidden"  value="{{$data['item']->id}}" name="id"/>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                       {{pxLang($data['lang'],'table.serial')}}
                                    </th>
                                    <th>
                                       {{pxLang($data['lang'],'table.type')}}
                                    </th>
                                    <th>
                                        {{pxLang($data['lang'],'table.description')}}
                                    </th>
                                    <th>
                                        {{pxLang($data['lang'],'table.amount')}}
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['items'] as $key => $item)
                                    <tr id="row_{{$item?->id}}">
                                        <td>
                                            {{$key+1}}
                                            <input type="hidden"  value="{{$item->id}}" name="ids[{{$item->id}}]"/>
                                        </td>
                                        <td>
                                            <select class="form-control" name="type[{{$item->id}}]">
                                                <option value="">-- Select -- </option>
                                                <option {{($item?->type == "addition") ? 'selected' : ''}} value="addition"> Addition </option>
                                                <option {{($item?->type == "deduction") ? 'selected' : ''}}  value="deduction"> Deduction </option>
                                            </select>
                                            <span id="type.{{$item?->id}}_error"></span>
                                        </td>
                                        <td>
                                           <select  class="form-control"  name="description[{{$item->id}}]">
                                                <option value="">-- Select -- </option>
                                                @foreach ($data['heads'] as $salary)
                                                    <option {{($item?->description == $salary?->name) ? 'selected':''}} value="{{$salary?->name}}">{{$salary?->name}}</option>
                                                @endforeach
                                            </select>
                                            <span id="description.{{$item?->id}}_error"></span>
                                        </td>
                                        <td>
                                            <input  class="form-control"  type="number" value="{{$item?->amount}}" name="amount[{{$item->id}}]"/>
                                            <span id="amount.{{$item?->id}}_error"></span>
                                        </td>
                                        <td class="text-end">
                                            <span data-prop='{"id":"{{$item?->id}}","lib_salary_group_id": "{{$item?->lib_salary_group_id}}"}' class="badge badge-pill bg-danger p-2 cursor-pointer deleteSalaryItems"><i  class="fa fa-trash"></i></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mb-3 mt-3 text-end">
                            <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i>  {{pxLang($data['lang'],'','common.btns.crud_action_update')}} </button>
                        </div>
                    </div>
               </form>
            </fieldset>
        </div>
        @else
            <p class="text-center"> {{pxLang($data['lang'],'','common.errors.no_data_title')}} </p>
        @endif
    </div>
</div>
