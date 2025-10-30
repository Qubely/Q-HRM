$(document).ready(function(){

    if ($('#frmLoadMonthWise').length > 0) {
        PX?.utils?.dp('dp',{format: 'Y-m-d'});
        let rules = {
            // from_date: {
            //     required: true,
            // },
            // to_date: {
            //     required: true,
            // },
            // employee_id: {
            //     required: true,
            // }
        };
        PX.ajaxRequest({
            element: 'frmLoadMonthWise',
            validation: true,
            script: 'admin/attendance/report/employee/month-wise/display',
            rules,
            afterSuccess: {
                type: 'load_html',
                target: 'month-wise',
                afterLoad: (req,res) => {
                    PX?.utils?.fixHeight('fix-att-card','fix-att-card',0,7);
                    $("#trigPrint").on("click",function(){
                        PX?.utils?.DirectPrintElem('print');
                    })
                }
            }
        });
    }
});
