<table class="table table-bordered dataTable">
    <tbody>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.image')}}</th>
            <td>
               <img src="{{ getRowImage($data['item']) }}" alt="User Image" width="80">
            </td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.name')}}</th>
            <td>{{ $data['item']?->name }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.email')}}</th>
            <td>{{ $data['item']?->email }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.mobile_number')}}</th>
            <td>{{ $data['item']?->mobile_number }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.lib_department_id')}}</th>
            <td>{{ $data['item']?->depertment?->name }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.lib_designation_id')}}</th>
            <td>{{ $data['item']?->designation?->name }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.father_name')}}</th>
            <td>{{ $data['item']?->father_name }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.mother_name')}}</th>
            <td>{{ $data['item']?->mother_name }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.present_address')}}</th>
            <td>{{ $data['item']?->present_address }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.permanent_address')}}</th>
            <td>{{ $data['item']?->permanent_address }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.gender')}}</th>
            <td>{{ $data['item']?->gender }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.date_of_birth')}}</th>
            <td>{{ \Carbon\Carbon::parse($data['item']?->date_of_birth)->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.nid')}}</th>
            <td>{{ $data['item']?->nid }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.emergency_contact')}}</th>
            <td>{{ $data['item']?->emergency_contact }}</td>
        </tr>
        <tr>
            <th>{{pxLang($data['lang'],'tabs.details.sections.personal.fileds.maritual_status')}}</th>
            <td>{{ $data['item']?->maritual_status }}</td>
        </tr>
    </tbody>
</table>
