$(document).ready(function(){

});
function addReconciliation(op){

    //vpx_attach
    PX?.utils?.dp({
        timepicker: true,
        datepicker: false,
        format: 'h:i A',
        formatTime: 'h:i A',
        validateOnBlur: false,
        step: 2,
        scrollInput: false,
        onShow: function(ct, $input) {
            $input.val($input.val());
        }
    });

    if ($('#frmAddReconRequest').length > 0) {
        let rules = {
            in_time: {
                required: true,
                maxlength: 253,
            },
            out_time:  {
                required: true,
                maxlength: 253,
            },
            reason:  {
                required: true,
                maxlength: 253,
            },
        };
        PX?.ajaxRequest({
            element: 'frmAddReconRequest',
            validation: true,
            script: 'employee/attendance/reports/monthly/details/add-reconciliation/send',
            rules,
            afterSuccess: {
                type: 'inflate_redirect_response_data',
            }
        });
    }
}
