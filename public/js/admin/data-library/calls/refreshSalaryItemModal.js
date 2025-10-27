$(document).ready(function(){

});
function refreshSalaryItem(op){

    PX?.utils?.dynamicDom({
        clickId: 'addMore',
        domId: 'copy',
        cloneId: 'paste',
        addRemoveclass: "remove",
        replaceClass: ['type', 'description','amount']
    });

    if ($('#frmRefreshSalaryItems').length > 0) {
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
        PX?.ajaxRequest({
            element: 'frmRefreshSalaryItems',
            validation: true,
            script: 'admin/data-library/salary/group/crud/refresh-salary-item/refresh',
            rules,
            afterSuccess: {
                type: 'inflate_redirect_response_data',
            }
        });
    }

    $(".deleteSalaryItems").on("click",function(){
        let body = JSON.parse($(this).attr('data-prop'));
        PX?.ajaxRequest({
            element: 'deleteSalaryItems',
            dataType: 'json',
            body,
            confirm: true,
            type: 'request',
            script: 'admin/data-library/salary/group/crud/refresh-salary-item/delete',
            afterSuccess: {
                type: 'inflate_response_data',
                afterLoad: (req,res) => {
                    $("#row_"+res?.extraData?.id).remove();
                }
            }
        });
    });

    if ($('#frmUpdateSalaryAmount').length > 0) {
        let rules = {
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
        PX?.ajaxRequest({
            element: 'frmUpdateSalaryAmount',
            validation: true,
            script: 'admin/data-library/salary/group/crud/refresh-salary-item/update-bulk',
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }
}
