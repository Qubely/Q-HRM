$(document).ready(function(){
    if($("#frmEmployeeLogin").length > 0) {
        let rules = {
            email: {
                required: true,
                email: true,
            },
            password:{
                required: true,
                minlength: 8,
            },
        };
        PX?.ajaxRequest({
            element: "frmEmployeeLogin",
            validation: true,
            script: "employee/login",
            rules,
            afterSuccess: {
                type: "inflate_redirect_response_data",
            }
        });
        //vpx_attach
    }
})