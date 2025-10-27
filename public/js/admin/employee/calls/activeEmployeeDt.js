$(document).ready(function(){

    if ($("#dtActiveEmployee").length > 0) {
        const {pageLang={}} = PX?.config;
        const {table={}} = pageLang;
        let col_draft = [
            {
                data: 'id',
                title: table?.id
            },
            {
                data: 'employee_id',
                title: table?.employee_id
            },
             {
                data: 'image',
                title: table?.avatar
            },
            {
                data: 'depertment.name',
                title: table?.lib_department_id
            },
            {
                data: 'designation.name',
                title: table?.lib_designation_id
            },
            {
                data: 'name',
                title: table?.name
            },
            {
                data: 'email',
                title: table?.email
            },
            {
                data: 'mobile_number',
                title: table?.mobile_number
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
                    return `<span class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </span>`;
                }
            },
        ];
        PX.renderDataTable('dtActiveEmployee', {
            select: true,
            url: 'admin/employee/active/active-employee/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtActiveEmployee(table, api, op) {
}
