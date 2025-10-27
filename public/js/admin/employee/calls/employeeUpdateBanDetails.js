$(document).ready(function(){
    if ($('#frmEmployeeBankDetailsUpdate').length > 0) {
        let rules = {
            bank_name: {
                required: true,
                maxlength: 253
            },
            branch: {
                required: true,
                maxlength: 253
            },
            ac_name: {
                required: true,
                maxlength: 253
            },
            ac_number: {
                required: true,
                maxlength: 253
            }
        };
        PX.ajaxRequest({
            element: 'frmEmployeeBankDetailsUpdate',
            validation: true,
            script: 'admin/employee/draft/crud/bank-details/update',
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }
});
