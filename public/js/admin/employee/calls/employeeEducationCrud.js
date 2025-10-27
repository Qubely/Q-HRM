$(document).ready(function(){

    if ($('#frmStoreEmployeeEducation').length > 0) {
        let rules = {
            employee_id: {
                required: true,
                digits: true
            },
            dgree_name: {
                required: true,
                maxlength: 100
            },
            board: {
                required: true,
                maxlength: 100
            },
            passing_year: {
                required: true,
                digits: true,
                minlength: 4,
                maxlength: 4
            },
            result: {
                required: true,
                maxlength: 50
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreEmployeeEducation',
            validation: true,
            script: 'admin/employee/draft/crud/education',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateEmployeeEducation').length > 0) {
        let rules = {
            employee_id: {
                required: true,
                digits: true
            },
            dgree_name: {
                required: true,
                maxlength: 100
            },
            board: {
                required: true,
                maxlength: 100
            },
            passing_year: {
                required: true,
                digits: true,
                minlength: 4,
                maxlength: 4
            },
            result: {
                required: true,
                maxlength: 50
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateEmployeeEducation',
            validation: true,
            script: 'admin/employee/draft/crud/education/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtEmployeeEducation").length > 0) {
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
                data: 'dgree_name',
                title: table?.dgree_name
            },
            {
                data: 'board',
                title: table?.board
            },
            {
                data: 'passing_year',
                title: table?.passing_year
            },
            {
                data: 'result',
                title: table?.result
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
                    return `<a href="${baseurl}admin/employee/draft/crud/education/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtEmployeeEducation', {
            select: true,
            url: 'admin/employee/draft/crud/education/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtEmployeeEducation(table, api, op) {
    PX.deleteAll({
        element: "deleteAllEmployeeEducation",
        script: "admin/employee/draft/crud/education/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllEmployeeEducation",
        script: "admin/employee/draft/crud/education/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadEmployeeEducationPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadEmployeeEducationExcel", dataTable: "yes" })
}
