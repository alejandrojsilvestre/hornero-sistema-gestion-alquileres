//== Class definition

$.fn.datetimepicker.dates['en'] = { ...$.fn.datetimepicker.dates['en'],
    days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    daysShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
    daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthsShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
    today: "Hoy",
    clear: "Borrar",
};

var BootstrapDatetimepicker = function () {
    
    //== Private functions
    var datesTimes = function () {
        // minimal setup
        $('.m_datetimepicker_1').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'dd-mm-yyyy hh:ii'
        });

        $('#m_datetimepicker_1_modal').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy-mm-dd hh:ii'
        });

        // input group demo
        $('#m_datetimepicker_2, #m_datetimepicker_1_validate, #m_datetimepicker_2_validate, #m_datetimepicker_3_validate').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            format: 'yyyy-mm-dd hh:ii'
        });
        $('#m_datetimepicker_2_modal').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            format: 'yyyy/mm/dd hh:ii'
        });

        // today button
        $('#m_datetimepicker_3').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            todayBtn: true,
            format: 'yyyy/mm/dd hh:ii'
        });
        $('#m_datetimepicker_3_modal').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            todayBtn: true,
            format: 'yyyy/mm/dd hh:ii'
        });

        // orientation
        $('#m_datetimepicker_4_1').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            format: 'yyyy.mm.dd hh:ii'
        });

        $('#m_datetimepicker_4_2').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-right',
            format: 'yyyy/mm/dd hh:ii'
        });

        $('#m_datetimepicker_4_3').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'top-left',
            format: 'yyyy-mm-dd hh:ii'
        });

        $('#m_datetimepicker_4_4').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'top-right',
            format: 'yyyy-mm-dd hh:ii'
        });

        $('#m_datetimepicker_5').datetimepicker({
            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left'
        });

        $('#m_datetimepicker_6').datetimepicker({
            format: "yyyy/mm/dd",
            todayHighlight: true,
            autoclose: true,
            startView: 2,
            minView: 2,
            forceParse: 0,
            pickerPosition: 'bottom-left'
        });

        $('#m_datetimepicker_7').datetimepicker({
            format: "hh:ii",
            showMeridian: true,
            todayHighlight: true,
            autoclose: true,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 0,
            pickerPosition: 'bottom-left'
        });
    }

    return {
        // public functions
        init: function() {
            datesTimes(); 
        }
    };
}();

jQuery(document).ready(function() {    
    BootstrapDatetimepicker.init();
});