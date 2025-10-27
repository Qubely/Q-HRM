$(document).ready(function(){
    if ($('#frmEmployeeSalarySalarySetupUpdate').length > 0) {
        let rules = {
            lib_salary_group_id: {
                required: true,
            }
        };
        PX.ajaxRequest({
            element: 'frmEmployeeSalarySalarySetupUpdate',
            validation: true,
            script: 'admin/employee/draft/crud/salary-setup/update',
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }
});
