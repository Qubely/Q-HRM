$(document).ready(function(){
     $('#image').imageCropper({
        outputWidth: 400,
        outputHeight: 400,
        mimeType: 'image/jpeg',
        boundingBox: { width: 250, height: 250 },
        quality: 1
    });
    if($("#frmUpdateEmployeeSetupProfile").length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            mobile_number: {
                required: true,
            },
            email: {
                required: true,
                maxlength: 253,
                email: true,
            },
            new_password: {
                required: true,
                minlength: 8
            },
            confim_password: {
                required: true,
                minlength: 8
            },
        };
        if($("#img_uploaded").val() == "no") {
            rules.image = {
                required: true,
            }
        }
        PX?.ajaxRequest({
            element: "frmUpdateEmployeeSetupProfile",
            validation: true,
            script: "employee/setup/profile",
            rules,
            afterSuccess: {
                type: "inflate_redirect_response_data"
            }
        });
    }

     if($("#frmEmployeeUpdateProfile").length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            mobile_number: {
                required: true,
            },
            email: {
                required: true,
                maxlength: 253,
                email: true,
            }
        };
        if($("#img_uploaded").val() == "no") {
            rules.image = {
                required: true,
            }
        }
        PX?.ajaxRequest({
            element: "frmEmployeeUpdateProfile",
            validation: true,
            script: "employee/setup/profile-update",
            rules,
            afterSuccess: {
                type: "inflate_redirect_response_data"
            }
        });
    }

    if($("#frmUpdateEmployeePasssword").length > 0) {
        let rules = {
            old_password: {
                required: true,
            },
            password: {
                required: true,
                minlength: 8,
            },
            confirm_password: {
                required: true,
                minlength: 8,
            },
        };
        PX?.ajaxRequest({
            element: "frmUpdateEmployeePasssword",
            validation: true,
            script: "employee/setup/password-update",
            rules,
            afterSuccess: {
                type: "inflate_redirect_response_data"
            }
        });

    }

    //vpx_attach
})
