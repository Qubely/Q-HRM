$(document).ready(function(){
    if ($('#frmEmployeeUpdate').length > 0) {
        PX?.utils?.dp('dp');
        let rules = {
        };
        PX.ajaxRequest({
            element: 'frmEmployeeUpdate',
            validation: true,
            script: 'admin/employee/draft/crud/update-basic/update',
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }
});
