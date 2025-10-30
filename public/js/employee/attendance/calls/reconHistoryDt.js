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
                data: 'name',
                title: table?.name
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
                    return `<span class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </span>`;
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
