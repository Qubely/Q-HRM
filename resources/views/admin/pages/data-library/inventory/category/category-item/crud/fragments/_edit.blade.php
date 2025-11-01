<div class="bg-info pl-2 page-fragment-bar">
    <span class="text-light"> <a href="{{url('admin/data-library/inventory/category/category-item/'.$data['category']?->id)}}"><span class="badge badge-info cursor-pointer"> <i class='fa-solid fa-arrow-left fs-16'></i></span></a> <span class="pt-1"> {{pxLang($data['lang'],'update')}}   </span> </span>
</div>
<div class="mt-4 p-3">
    @can('lib_inventory_cat_item_crud_edit')
        <form id="frmUpdateLibInventoryCatItem" autocomplete="off">
            @method('PATCH')
            <input type="hidden" id="patch_id" value="{{$data['item']?->id}}" />
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-2 shadow-card card-border">
                               <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{ pxLang($data['lang'],'fields.name') }}</b> <em class="required"></em> <span id="name_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" id="name" value="{{$data['item']?->name}}">
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{ pxLang($data['lang'],'fields.tag_name') }}</b> <em class="required">*</em> <span id="tag_name_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="tag_name" id="tag_name" value="{{$data['item']?->tag_name}}">
                                    </div>
                                </div>
                                 <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{ pxLang($data['lang'],'fields.image') }}</b> <em class="required"></em> <span id="image_error"></span></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
                                </div>
                                <div>
                                    <img src="{{getRowImage($data['item'],'80X80')}}" class="img-fluid" />
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{ pxLang($data['lang'],'fields.model') }}</b> <em class="required"></em> <span id="model_error"></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="model" id="model" value="{{$data['item']?->model}}">
                                    </div>
                                </div>
                                <div class="form-group text-left mb-3">
                                    <label class="form-label"> <b>{{ pxLang($data['lang'],'fields.description') }}</b> <em class="required"></em> <span id="description_error"></span></label>
                                    <div class="input-group">
                                        <textarea class="form-control" rows="4" name="description" id="description">{{$data['item']?->description}}</textarea>
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
