<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.leave.fileds.lib_leave_id')}}</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.leave.fileds.count')}}</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.leave.fileds.spent')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['item']?->leaves ?? [] as $index => $leave)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $leave?->leave?->name }}</td>
                <td>{{ $leave?->count }}</td>
                <td>{{ $leave?->spent }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
