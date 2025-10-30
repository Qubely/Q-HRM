@if($data['item'] != null)
<div class="card rounded page-block p-3" id="print">
    <div class="d-flex flex-row justify-content-start">
        <h4 class="me-auto"> Attendace Report for  {{$data['item']?->name}} | Date: {{$data['from_date']}} - {{$data['to_date']}}</h4>
    </div>
    <hr>
    <div class="row">
        @foreach ($data['dates'] as $item)
            <div class="col-md-2">
                <div class="text-start card p-2 fs-12 fix-att-card mb-2">
                    <h6 class="p-1">{{$item['view']}}</h6>
                    @if($item['has'])
                        <div class="">
                            In: <span class="text-success">{{$item['in_time']}}</span>
                        </div>
                        <div class="">
                            Out: <span class="">{{$item['out_time']}}</span>
                        </div>
                        <div class="">
                            Hours: <span>{{$item['working']}}</span>
                        </div>
                        @if(in_array($item['att_date'],$data['lastSevenDays']))
                            <div class="d-flex flex-row justify-content-end mb-3">
                                <span class="badge bg-info p-1 cursor-pointer"><i class="fa fa-refresh"></i></span>
                            </div>
                        @endif
                    @else
                        -
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@else
<p class=""> No employee found</p>
@endif
