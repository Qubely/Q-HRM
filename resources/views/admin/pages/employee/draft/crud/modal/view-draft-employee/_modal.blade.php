@if($data['item'] != null)
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">{{pxLang($data['lang'],'tabs.details.tab')}}</button>
        </li>
        @if($data['item']?->status == "Draft")
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="confirm-tab" data-bs-toggle="tab" data-bs-target="#confirm" type="button" role="tab" aria-controls="confirm" aria-selected="false">{{pxLang($data['lang'],'tabs.confirm.tab')}}</button>
        </li>
        @endif
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
            @include('admin.pages.employee.draft.crud.modal.view-draft-employee.fragments.details._details')
        </div>
        @if($data['item']?->status == "Draft")
        <div class="tab-pane fade" id="confirm" role="tabpanel" aria-labelledby="confirm-tab">
            <div class="p-3">
                @include('admin.pages.employee.draft.crud.modal.view-draft-employee.fragments.confirm._confirm')
            </div>
        </div>
        @endif
    </div>
@else
    @include('common.view.fragments.-item-404')
@endif
