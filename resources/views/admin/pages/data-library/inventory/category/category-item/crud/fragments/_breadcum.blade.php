 @section('breadCum')
    <h4 class="mb-0"><a href="{{url('admin/data-library/inventory/category')}}"><i class="fa fa-arrow-alt-circle-left"></i></a> <span class="ms-2">{{$data['category']?->name}}</span> >>  {{pxLang($data['lang'],'breadCum.title')}}</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">{{pxLang($data['lang'],'breadCum.b1')}}</a></li>
            <li class="breadcrumb-item"> {{pxLang($data['lang'],'breadCum.b2')}} </li>
        </ol>
    </div>
@endsection
