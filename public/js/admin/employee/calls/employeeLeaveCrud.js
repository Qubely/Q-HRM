$(document).ready(function(){

    if ($('#frmStoreEmployeeLeave').length > 0) {
        $("#lib_leave_id").on("change",function(){
            let value = $("#lib_leave_id option:selected").attr('data-count');
            $("#count").attr('value',value);
        })
        let rules = {
            employee_id: {
                required: true,
                digits: true
            },
            lib_leave_id: {
                required: true,
                digits: true
            },
            count: {
                required: true,
                number: true,
                min: 1
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreEmployeeLeave',
            validation: true,
            script: 'admin/employee/draft/crud/leave',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateEmployeeLeave').length > 0) {
        let rules = {
            employee_id: {
                required: true,
                digits: true
            },
            lib_leave_id: {
                required: true,
                digits: true
            },
            count: {
                required: true,
                number: true,
                min: 1
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateEmployeeLeave',
            validation: true,
            script: 'admin/employee/draft/crud/leave/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtEmployeeLeave").length > 0) {
        const {pageLang={}} = PX?.config;
        const {table={}} = pageLang;
        let col_draft = [
            {
                data: 'id',
                title: table?.id
            },
            {
                data: null,
                title: table?.serial,
                class: 'text-center',
                width: '200px',
                render: function (data, type, row) {
                    return `<input type="number" value="` + data.serial + `" class="form-control serial"><input type="hidden" value="` + data.id + `" class="form-control ids">`;
                }
            },
            {
                data: 'leave.name',
                title: table?.lib_leave_id
            },
            {
                data: 'count',
                title: table?.count
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
                    return `<a href="${baseurl}admin/employee/draft/crud/leave/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtEmployeeLeave', {
            select: true,
            url: 'admin/employee/draft/crud/leave/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtEmployeeLeave(table, api, op) {
    PX.deleteAll({
        element: "deleteAllEmployeeLeave",
        script: "admin/employee/draft/crud/leave/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllEmployeeLeave",
        script: "admin/employee/draft/crud/leave/update-list",
        confirm: true,
        dataCols: {
            key: "ids",
            items: [
                {
                    index: 1,
                    name: "ids",
                    type: "input",
                    data: [],
                },
                {
                    index: 1,
                    name: "serial",
                    type: "input",
                    data: []
                }
            ]
        },
        api,
        afterSuccess: {
            type: "inflate_response_data"
        }
    });
    PX?.dowloadPdf({ ...op, btn: "downloadEmployeeLeavePdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadEmployeeLeaveExcel", dataTable: "yes" })
}
