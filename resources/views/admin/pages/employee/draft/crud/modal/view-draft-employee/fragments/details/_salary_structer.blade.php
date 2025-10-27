<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.salary.fileds.type')}}</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.salary.fileds.decription')}}</th>
            <th>{{pxLang($data['lang'],'tabs.details.sections.salary.fileds.amount')}}</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalAmount = 0;
        @endphp

        @foreach ($data['item']?->salary?->salaryGroup?->salaryItems ?? [] as $index => $item )
            @php
                $amt = $item?->amount ?? 0;
                if ($item?->type === 'deduction') {
                    $totalAmount -= $amt;
                } else {
                    $totalAmount += $amt;
                }
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item?->type }}</td>
                <td>{{ $item?->description }}</td>
                <td>{{ number_format($item?->amount, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="text-right">{{pxLang($data['lang'],'tabs.details.sections.salary.fileds.total_amount')}}</th>
            <th>{{ number_format($totalAmount, 2) }}</th>
        </tr>
    </tfoot>
</table>
