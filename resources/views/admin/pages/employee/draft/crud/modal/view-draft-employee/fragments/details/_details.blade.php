<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
         {{pxLang($data['lang'],'tabs.details.sections.personal.name')}}
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
            @include('admin.pages.employee.draft.crud.modal.view-draft-employee.fragments.details._personal-info')
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        {{pxLang($data['lang'],'tabs.details.sections.leave.name')}}
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
         @include('admin.pages.employee.draft.crud.modal.view-draft-employee.fragments.details._leaves')
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        {{pxLang($data['lang'],'tabs.details.sections.education.name')}}
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
            @include('admin.pages.employee.draft.crud.modal.view-draft-employee.fragments.details._education')
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFour">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        {{pxLang($data['lang'],'tabs.details.sections.bank.name')}}
      </button>
    </h2>
    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
      <div class="accordion-body">
         <table class="table table-bordered dataTable">
            <tbody>
                <tr>
                    <th>{{pxLang($data['lang'],'tabs.details.sections.bank.fileds.bank_name')}}</th>
                    <td>{{ $data['item']?->bank_name }}</td>
                </tr>
                <tr>
                    <th>{{pxLang($data['lang'],'tabs.details.sections.bank.fileds.branch')}}</th>
                    <td>{{ $data['item']?->branch }}</td>
                </tr>
                <tr>
                    <th>{{pxLang($data['lang'],'tabs.details.sections.bank.fileds.ac_name')}}</th>
                    <td>{{ $data['item']?->ac_name }}</td>
                </tr>
                <tr>
                    <th>{{pxLang($data['lang'],'tabs.details.sections.bank.fileds.ac_number')}}</th>
                    <td>{{ $data['item']?->ac_number }}</td>
                </tr>
            </tbody>
         </table>
      </div>
    </div>
  </div>
   <div class="accordion-item">
    <h2 class="accordion-header" id="headingFive">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
        {{pxLang($data['lang'],'tabs.details.sections.salary.name')}}
      </button>
    </h2>
    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        @include('admin.pages.employee.draft.crud.modal.view-draft-employee.fragments.details._salary_structer')
      </div>
    </div>
  </div>
</div>
