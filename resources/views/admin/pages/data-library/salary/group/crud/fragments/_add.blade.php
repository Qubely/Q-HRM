<div class="bg-info pl-2 page-fragment-bar">
    <span class="text-light"> <a href=""><span class="badge badge-info cursor-pointer"> <i class='fa-solid fa-arrow-left fs-16'></i></span></a> <span class="pt-1">{{pxLang($data['lang'],'add')}}  </span> </span>
</div>
<div class="mt-4 p-3">
    @can('lib_salary_group_crud_store')
        <form id="frmStoreLibSalaryGroup" autocomplete="off">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card p-2 shadow-card card-border">
                                <div class="form-group text-left mb-3">
                                    <label class="form-label" > <b> {{pxLang($data['lang'],'fields.name')}} </b> <em class="required">*</em> <span id="name_error"> </span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <span class="cursor-pointer pointer badge rounded-pill bg-primary p-2 pointer addMore" id="addMore">
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
                                                <label class="form-label"> <b>  {{pxLang($data['lang'],'fields.description')}}  </b> <em class="required" >*</em> <span  class="description" id="description.0_error"></span></label>
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
                                                <label class="form-label"> <b>  {{pxLang($data['lang'],'fields.amount')}}  </b> <em class="required">*</em> <span  class="amount" id="amount.0_error"></span></label>
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
                                <div id="paste"></div>
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

