$(document).ready(function(){

    if ($("#dtEmployeeRecon").length > 0) {
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
                    let str = ``;
                    if(data?.status_raw == 'Pending') {
                        str += `<span data-id='${data?.id}' class="btn btn-outline-success btn-sm edit approveRecon" title="Approve">
                            <i class="fas fa-check"></i>
                        </span>
                        <span data-id='${data?.id}' class="btn btn-outline-danger btn-sm edit banRecon" title="Approve">
                            <i class="fas fa-ban"></i>
                        </span>`;
                    }
                    return str;
                }
            },
        ];
        PX.renderDataTable('dtEmployeeRecon', {
            select: true,
            url: 'admin/attendance/reconciliation/employee-recon/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtEmployeeRecon(table, api, op) {

    $(".banRecon").on("click",function(){
        let id = $(this).attr('data-id');
        PX?.ajaxRequest({
               element: 'banRecon',
               dataType: 'json',
               body: {id},
               confirm: true,
               type: 'request',
               script: 'admin/attendance/reconciliation/employee-recon/list/ban',
               afterSuccess: {
                   type: 'inflate_redirect_response_data',
               }
        });
    });

    $(".approveRecon").on("click",function(){
        let id = $(this).attr('data-id');
        PX?.ajaxRequest({
               element: 'approveRecon',
               dataType: 'json',
               body: {id},
               confirm: true,
               type: 'request',
               script: 'admin/attendance/reconciliation/employee-recon/list/aprove',
               afterSuccess: {
                   type: 'inflate_redirect_response_data',
               }
        });
    })
}
