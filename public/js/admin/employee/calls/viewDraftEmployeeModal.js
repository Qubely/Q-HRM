$(document).ready(function(){

});
function viewEmployeeModal(op){
    //vpx_attach
    if($("#frmStartEmployee").length > 0) {
        PX?.utils?.dp();
        if ($('#frmStartEmployee').length > 0) {
            let rules = {
                joining_date: {
                    required: true,
                },
            };
            PX?.ajaxRequest({
                element: 'frmStartEmployee',
                validation: true,
                script: 'admin/employee/draft/crud/view-draft-employee/entry',
                rules,
                afterSuccess: {
                    type: 'inflate_redirect_response_data',
                }
            });
        }
    }
}
