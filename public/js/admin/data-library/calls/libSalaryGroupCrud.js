$(document).ready(function(){

    PX?.utils?.dynamicDom({
        clickId: 'addMore',
        domId: 'copy',
        cloneId: 'paste',
        addRemoveclass: "remove",
        replaceClass: ['type', 'description','amount']
    });

    if ($('#frmStoreLibSalaryGroup').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            type: {
                required: true,
                maxlength: 253
            },
            description: {
                required: true,
                maxlength: 253
            },
            amount: {
                required: true,
                number: true,
                minlength: 1
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreLibSalaryGroup',
            validation: true,
            script: 'admin/data-library/salary/group',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateLibSalaryGroup').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            type: {
                required: true,
                maxlength: 253
            },
            description: {
                required: true,
                maxlength: 253
            },
            amount: {
                required: true,
                number: true,
                minlength: 1
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateLibSalaryGroup',
            validation: true,
            script: 'admin/data-library/salary/group/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtLibSalaryGroup").length > 0) {
        const {pageLang={}} = PX?.config;
        const {table={}} = pageLang;
        let trigRefreshItem = {
            body: {},
            modalCallback: 'refreshSalaryItem',
            element: 'refreshSalaryItem',
            script: 'admin/data-library/salary/group/crud/refresh-salary-item/display',
            title: 'Refresh Salary Group',
            globLoader: false
        };
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
                    trigRefreshItem = {
                        ...trigRefreshItem,
                        body: {id: data?.id},
                        title: `Upate ${data?.name} Items`
                    };
                    return `
                     <span data-bs-toggle='modal' data-bs-target='.editmodal' data-edit-prop='${JSON.stringify(trigRefreshItem)}' href="${baseurl}admin/data-library/salary/group/${data.id}/edit" class="btn btn-outline-secondary btn-sm" title="Refresh">
                        <i class="fas fa-refresh"></i>
                    </span>
                    <a href="${baseurl}admin/data-library/salary/group/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtLibSalaryGroup', {
            select: true,
            url: 'admin/data-library/salary/group/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtLibSalaryGroup(table, api, op) {
    PX.deleteAll({
        element: "deleteAllLibSalaryGroup",
        script: "admin/data-library/salary/group/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllLibSalaryGroup",
        script: "admin/data-library/salary/group/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadLibSalaryGroupPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadLibSalaryGroupExcel", dataTable: "yes" })
}
