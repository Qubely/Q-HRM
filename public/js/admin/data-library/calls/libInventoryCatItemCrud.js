$(document).ready(function(){

    $('#image').imageCropper({
        outputWidth: 400,
        outputHeight: 400,
        mimeType: 'image/jpeg',
        boundingBox: { width: 250, height: 250 },
        quality: 1
    });

    if ($('#frmStoreLibInventoryCatItem').length > 0) {
        let rules = {
            tag_name: {
                required: true,
                maxlength: 253
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreLibInventoryCatItem',
            validation: true,
            script: 'admin/data-library/inventory/category/category-item',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateLibInventoryCatItem').length > 0) {
        let rules = {
            tag_name: {
                required: true,
                maxlength: 253
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateLibInventoryCatItem',
            validation: true,
            script: 'admin/data-library/inventory/category/category-item/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtLibInventoryCatItem").length > 0) {
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
                data: 'image',
                title: table?.image
            },
            {
                data: 'name',
                title: table?.name
            },
            {
                data: 'tag_name',
                title: table?.tag_name
            },
            {
                data: 'model',
                title: table?.model
            },
            {
                data: 'assigned.name',
                title: table?.assigned
            },
            {
                data: null,
                title: table?.action,
                class: 'text-end',
                render: function (data, type, row) {
                    return `<a href="${baseurl}admin/data-library/inventory/category/category-item/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtLibInventoryCatItem', {
            select: true,
            url: 'admin/data-library/inventory/category/category-item/list',
            columns: col_draft,
            body: {lib_inventory_cat_id: $("#lib_inventory_cat_id").val()},
            pdf: [1, 2]
        });
    }
})

function dtLibInventoryCatItem(table, api, op) {
    PX.deleteAll({
        element: "deleteAllLibInventoryCatItem",
        script: "admin/data-library/inventory/category/category-item/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllLibInventoryCatItem",
        script: "admin/data-library/inventory/category/category-item/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadLibInventoryCatItemPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadLibInventoryCatItemExcel", dataTable: "yes" })
}
