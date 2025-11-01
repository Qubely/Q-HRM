$(document).ready(function(){

    if ($("#dtReconHistory").length > 0) {
        const {pageLang={}} = PX?.config;
        const {table={}} = pageLang;
        let col_draft = [
            {
                data: 'id',
                title: table?.id
            },
            {
                data: 'att.in_time',
                title: table?.in_time
            },
            {
                data: 'att.out_time',
                title: table?.out_time
            },
            {
                data: 'in_time',
                title: table?.in_time_recon
            },
            {
                data: 'out_time',
                title: table?.out_time_recon
            },
            {
                data: 'reason',
                title: table?.reason
            },
            {
                data: 'status',
                title: table?.status
            },
            {
                data: 'created_at',
                title: table?.created
            },

            {
                data: null,
                title: table?.action,
                class: 'text-end',
                render: function (data, type, row) {
                    return ``;
                }
            },
        ];
        PX.renderDataTable('dtReconHistory', {
            select: true,
            url: 'employee/attendance/reconciliation/recon-history/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtReconHistory(table, api, op) {
}
