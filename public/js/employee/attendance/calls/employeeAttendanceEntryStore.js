$(document).ready(function(){

    if ($('#frmEmployeeAttendanceEntryStore').length > 0) {
       sendTiming('frmEmployeeAttendanceEntryStore', 'in')
    }

    if ($('#frmEmployeeAttendanceSignOutStore').length > 0) {
       sendTiming('frmEmployeeAttendanceEntryStore', 'out')
    }

});

function sendTiming(frm, type){
    let rules = {};
    PX?.ajaxRequest({
        element: frm,
        validation: true,
        beforeSend: function(op, callback) {
            if (!navigator.geolocation) {
                showAlert("Location Error", "Geolocation is not supported by this browser.");
                return 0;
            }
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lati = position.coords.latitude;
                    const lang = position.coords.longitude;
                    let newbody = op.body;
                    newbody.append('lati', lati);
                    newbody.append('lang', lang);
                    callback({ ...op, body: newbody });
                },
                function(error) {
                    let newbody = op.body;
                    newbody.append('lati', 23.785495);
                    newbody.append('lang', 90.3291017);
                    callback({ ...op, body: newbody });
                },
                {
                    enableHighAccuracy: false,
                    timeout: 5000,
                    maximumAge: 60000
                }
            );

        },
        script:  type === 'in' ? 'employee/attendance/entry/store' : 'employee/attendance/entry/update',
        rules,
        afterSuccess: {
            type: 'inflate_redirect_response_data',
        }
    });
}
