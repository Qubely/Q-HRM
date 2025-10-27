<table class="table table-bordered datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.education.fileds.dgree_name')}}</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.education.fileds.board')}}</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.education.fileds.passing_year')}}</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.education.fileds.result')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['item']?->education ?? [] as $index => $edu)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $edu?->dgree_name }}</td>
                <td>{{ $edu?->board }}</td>
                <td>{{ $edu?->passing_year }}</td>
                <td>{{ $edu?->result }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
